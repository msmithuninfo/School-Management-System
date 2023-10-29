<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ClassSubjectModel::getClassSubject();
        $data['header_title'] = "Assign Subject List";
        return view('backend.admin.assign_subject.list', $data);
    }

    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClassForAssign();
        $data['getSubject'] = SubjectModel::getSubjectForAssign();
        $data['header_title'] = "Assign Subject Add";
        return view('backend.admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        if(!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else 
                {
                    $save = new ClassSubjectModel();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('backend/admin/assign_subject/list')->with('success', 'Subject Successfully Assign to Class');
        }
        else 
        {
            return redirect()->back()->with('error', 'Due to some error pls try again.');
        }
    }

    public function edit($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClassForAssign();
            $data['getSubject'] = SubjectModel::getSubjectForAssign();
            $data['header_title'] = "Edit Assign Subject";
            return view('backend.admin.assign_subject.edit', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function update($id, Request $request)
    {
        ClassSubjectModel::deleteSubject($request->class_id);

        if(!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst))
                {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }
                else 
                {
                    $save = new ClassSubjectModel();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('backend/admin/assign_subject/list')->with('success', 'Subject Update Successfully Assign to Class');
        }
        else 
        {
            return redirect()->back()->with('error', 'Due to some error pls try again.');
        }
    }

    public function delete($id)
    {
        
        $subject = ClassSubjectModel::getSingle($id);
        $subject->is_delete = 1;
        $subject->save();
        return redirect('backend/admin/assign_subject/list')->with('success', 'Assign Subject Deleted Successfully');
    }

    public function edit_single($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if(!empty($getRecord))
        {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClassForAssign();
            $data['getSubject'] = SubjectModel::getSubjectForAssign();
            $data['header_title'] = "Edit Assign Subject";
            return view('backend.admin.assign_subject.edit_single', $data);
        }
        else
        {
            abort(404);
        } 
    }

    public function update_single($id, Request $request)
    {
        
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);
        if(!empty($getAlreadyFirst))
        {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('backend/admin/assign_subject/list')->with('success', 'Status Successfully Updated');
        }
        else 
        {
            $save = ClassSubjectModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();

            return redirect('backend/admin/assign_subject/list')->with('success', 'Subject Update Successfully Assign to Class');
        }
    }

}
