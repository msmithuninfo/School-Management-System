<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('backend.admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Student";
        return view('backend.admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'weight' => 'max:10',
            'height' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:11',
        ]);


        $teacher = new User();
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->mobile_number = trim($request->mobile_number);
    
        $teacher->blood_group = trim($request->blood_group);
        $teacher->height = trim($request->height);
        $teacher->weight = trim($request->weight);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('backend/admin/teacher/list')->with('success', 'Teacher Created Successfully');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        

        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Student";
            return view('backend.admin.teacher.edit', $data);
        }
        else
        {
            abort(404);
        }
        
    }


    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'height' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:11',
        ]);


        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($teacher->getProfile()))
            {
                unlink('upload/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $teacher->profile_pic = $filename;
        }

      
        $teacher->mobile_number = trim($request->mobile_number);
       
        $teacher->blood_group = trim($request->blood_group);
        $teacher->height = trim($request->height);
        $teacher->weight = trim($request->weight);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('backend/admin/teacher/list')->with('success', 'Teacher Update Successfully');
    }

    public function delete($id)
    {
        
        $user = User::getSingle($id);
        if(!empty($user))
        {
            $user->is_delete = 1;
            $user->save();
            return redirect('backend/admin/teacher/list')->with('success', 'Teacher Deleted Successfully');
        }
        else
        {
            abort(404);
        }
        
       
    }

}
