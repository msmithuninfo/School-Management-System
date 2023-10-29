<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getSubject();
        $data['header_title'] = "Subject List";
        return view('backend.admin.subject.list', $data);
    }
    
    public function add()
    {
        
        $data['header_title'] = "Add New Subject";
        return view('backend.admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        // request()->validate([
        //     'email' => 'required|email|unique:users',
        // ]);

        $subject = new SubjectModel();
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        $subject->created_by = Auth::user()->id;
        $subject->save();
        
        return redirect('backend/admin/subject/list')->with('success', 'Subject Created Successfully');
    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Subject";
            return view('backend.admin.subject.edit', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function update($id, Request $request)
    {
        // request()->validate([
        //     'email' => 'required|email|unique:users,email,'.$id,
        // ]);
        
        $subject = SubjectModel::getSingle($id);
        $subject->name = trim($request->name);
        $subject->type = trim($request->type);
        $subject->status = trim($request->status);
        // $class->created_by = Auth::user()->id;
        $subject->save();
        return redirect('backend/admin/subject/list')->with('success', 'Subject Updated Successfully');
    }

    public function delete($id)
    {
        
        $subject = SubjectModel::getSingle($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('backend/admin/subject/list')->with('success', 'Subject Deleted Successfully');
    }


    public function MySubject()
    {
        
        $data['getRecord'] = ClassSubjectModel::MySubject(Auth::user()->class_id);
        $data['header_title'] = "My Subject";
        return view('backend.student.my_subject', $data);
    }

    public function ParentStudentSubject($student_id)
    {
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;
        $data['getRecord'] = ClassSubjectModel::MySubject($user->class_id);
        $data['header_title'] = "Student Subject";
        return view('backend.parent.my_student_subject', $data);
    }
    

}
