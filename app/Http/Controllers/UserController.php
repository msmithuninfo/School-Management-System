<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if(Auth::user()->user_type == 1)
        {
            return view('backend.admin.my_account', $data);
        }
        else if(Auth::user()->user_type == 2)
        {
            return view('backend.teacher.my_account', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            return view('backend.student.my_account', $data);
        }
        else if(Auth::user()->user_type == 4)
        {
            return view('backend.parent.my_account', $data);
        }
    }

    public function Setting()
    {
        $data['getRecord'] = SettingModel::getSingle();
        $data['header_title'] = "Setting";
        return view('backend.admin.setting', $data);
    }

    public function UpdateSetting(Request $request)
    {
        $setting = SettingModel::getSingle();
        $setting->paypal_email = trim($request->paypal_email);
        $setting->stripe_key = trim($request->stripe_key);
        $setting->stripe_secret = trim($request->stripe_secret);

        $setting->school_name = trim($request->school_name);
        $setting->exam_description = trim($request->exam_description);


        if(!empty($request->file('logo')))
        {
            if(!empty($setting->getLogo()))
            {
                unlink('upload/setting/'.$setting->logo);
            }
            $ext = $request->file('logo')->getClientOriginalExtension();
            $file = $request->file('logo');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/',$filename);
            $setting->logo = $filename;
        }

        if(!empty($request->file('fevicon_icon')))
        {
            if(!empty($setting->getFevicon()))
            {
                unlink('upload/setting/'.$setting->fevicon_icon);
            }
            $ext = $request->file('fevicon_icon')->getClientOriginalExtension();
            $file = $request->file('fevicon_icon');
            $randomStr = date('Ymdhis').Str::random(10);
            $fevicon_icon = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/',$fevicon_icon);
            $setting->fevicon_icon = $fevicon_icon;
        }

        $setting->save();
        return redirect()->back()->with('success', 'Setting Successfully Updated!');
    }
    
    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:11',
        ]);


        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->last_name = trim($request->last_name);
        $admin->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $admin->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($admin->getProfile()))
            {
                unlink('upload/profile/'.$admin->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $admin->profile_pic = $filename;
        }

      
        $admin->mobile_number = trim($request->mobile_number);
        $admin->occupation = trim($request->occupation);
        $admin->address = trim($request->address);
        $admin->blood_group = trim($request->blood_group);
        $admin->email = trim($request->email);
        $admin->save();

        return redirect()->back()->with('success', 'Account Update Successfully');
    }
    
    public function UpdateMyAccount(Request $request)
    {
        $id = Auth::user()->id;
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
        $teacher->email = trim($request->email);
        $teacher->save();

        return redirect()->back()->with('success', 'Account Update Successfully');
    }
    
    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'weight' => 'max:10',
            'height' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:11',
        ]);


        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic = $filename;
        }

      
        $student->mobile_number = trim($request->mobile_number);
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('success', 'Account Update Successfully');
    }


    public function UpdateMyAccountParent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:11',
        ]);


        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);

        if(!empty($request->date_of_birth))
        {
            $parent->date_of_birth = trim($request->date_of_birth);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($parent->getProfile()))
            {
                unlink('upload/profile/'.$parent->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $parent->profile_pic = $filename;
        }

      
        $parent->mobile_number = trim($request->mobile_number);
       
        $parent->blood_group = trim($request->blood_group);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->email = trim($request->email);
        $parent->save();

        return redirect()->back()->with('success', 'Account Update Successfully');
    }




    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('backend.profile.change_password', $data);
    }




    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            return redirect()->back()->with('success', 'Password Successfully Updated');
        }
        else
        {
            return redirect()->back()->with('error', 'Old Password is not Correct');
        }
    }
}
