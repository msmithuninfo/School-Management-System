<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function list()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = "Homework";
        return view('backend.admin.homework.list', $data);
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add Homework";
        return view('backend.admin.homework.add', $data);
    }
    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value=""> Select Subject </option>';
        foreach($getSubject as $value)
        {
            $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.' </option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }
    public function insert(Request $request)
    {
        $homework = new HomeworkModel();
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/',$filename);
            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect('backend/admin/homework/homework/list')->with('success', 'Homework successfully created');
    }
    
    public function edit($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Edit Homework";
        return view('backend.admin.homework.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        
        if(!empty($request->file('document_file')))
        {
            if(!empty($homework->getDocument()))
            {
                unlink('upload/homework/'.$homework->document_file);
            }
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/',$filename);
            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect('backend/admin/homework/homework/list')->with('success', 'Homework successfully Updated');
    }

    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();
        return redirect()->back()->with('success', 'Homework successfully Deleted');
    }

    // Admin
    public function submitted($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Homework";
            return view('backend.admin.homework.submitted', $data);
        }
    }
    
    public function homework_report()
    {
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();
        $data['header_title'] = "Homework Report";
        return view('backend.admin.homework.report', $data);
    }
    // Teacher 
    public function TeacherList()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = "Homework";
        return view('backend.teacher.homework.list', $data);
    }
    public function TeacherAdd()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Add Homework";
        return view('backend.teacher.homework.add', $data);
    }
    
    public function TeacherInsert(Request $request)
    {
        $homework = new HomeworkModel();
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/',$filename);
            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect('backend/teacher/homework/homework/list')->with('success', 'Homework successfully created');
    }
    

    public function TeacherEdit($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Edit Homework";
        return view('backend.teacher.homework.edit', $data);
    }

    public function TeacherUpdate(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        
        if(!empty($request->file('document_file')))
        {
            if(!empty($homework->getDocument()))
            {
                unlink('upload/homework/'.$homework->document_file);
            }
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/',$filename);
            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect('backend/teacher/homework/homework/list')->with('success', 'Homework successfully Updated');
    }

    
    public function SubmittedTeacher($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Homework";
            return view('backend.teacher.homework.submitted', $data);
        }
    }
    // Student Homework
    
    public function HomeworkStudent()
    {

        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "My Homework";
        return view('backend.student.homework.list', $data);
    }

    public function SubmitHomework($homework_id)
    {

        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = "Submit Homework";
        return view('backend.student.homework.submit_homework', $data);
    }

    
    public function SubmitHomeworkInsert(Request $request, $homework_id)
    {

        $homework = new HomeworkSubmitModel();
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/',$filename);
            $homework->document_file = $filename;
        }

        $homework->save();
        return redirect('backend/student/my_homework')->with('success', 'Homework successfully Submitted');
    
    }
    public function HomeworkSubmittedStudent()
    {
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Submitted Homework";
        return view('backend.student.homework.my_submitted_homework', $data);
    }

    // Parent homework
    
    public function HomeworkStudentParent($student_id)
    {

        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id, $getStudent->id);
        $data['header_title'] = "My Student Homework";
        $data['getStudent'] = $getStudent;
        return view('backend.parent.homework.list', $data);
    }

    
    public function SubmittedHomeworkStudentParent($student_id)
    {

        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($getStudent->id);
        $data['header_title'] = "Submitted Student Homework";
        $data['getStudent'] = $getStudent;
        return view('backend.parent.homework.submitted_list', $data);
    }
}
