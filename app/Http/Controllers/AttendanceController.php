<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\StudentAttendanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function AttendanceStudent(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        
        $data['header_title'] = "Student Attendance";
        return view('backend.admin.attendance.student', $data);
    }

    public function AttendanceStudentSubmit(Request $request)
    {
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance($request->student_id, $request->class_id, $request->attendance_date);
        if(!empty($check_attendance))
        {
            $attendance = $check_attendance;
        }
        else
        {
            $attendance = new StudentAttendanceModel();
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message'] = "Attendance Successfully Saved";
        echo json_encode($json);
    }

    
    public function AttendanceReport(Request $request)
    {   
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAttendanceModel::getRecord();
        $data['header_title'] = "Attendance Report";
        return view('backend.admin.attendance.report', $data);
    }

    // Attendance Student Teacher
    public function AttendanceStudentTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date')))
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        
        $data['header_title'] = "Student Attendance";
        return view('backend.teacher.attendance.student', $data);
    }

    public function AttendanceReportTeacher(Request $request)
    {   
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classArray = array();
        foreach($getClass as $value)
        {
            $classArray[] = $value->class_id;
        }
        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classArray);
        $data['header_title'] = "Attendance Report";
        return view('backend.teacher.attendance.report', $data);
    }
    // Student Attendance
    
    public function MyAttendanceStudent()
    {
        $data['getClass'] = StudentAttendanceModel::getClassStudent(Auth::user()->id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);

        $data['header_title'] = "My Attendance";
        return view('backend.student.my_attendance', $data);
    }

    public function MyAttendanceParent($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = StudentAttendanceModel::getClassStudent($student_id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent($student_id);

        $data['header_title'] = "Student Attendance";
        return view('backend.parent.my_attendance', $data);
    }

}
