<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;
use App\Models\NoticeBoardModel;
use App\Models\StudentAddFeesModel;
use App\Models\StudentAttendanceModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if(Auth::user()->user_type == 1)
        {
            $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
            $data['getTotalTodayFees'] = StudentAddFeesModel::getTotalTodayFees();
            
            $data['TotalAdmin'] = User::getTotalUser(1);
            $data['TotalTeacher'] = User::getTotalUser(2);
            $data['TotalStudent'] = User::getTotalUser(3);
            $data['TotalParent'] = User::getTotalUser(4);

            $data['TotalExam'] = ExamModel::getTotalExam();
            $data['TotalClass'] = ClassModel::getTotalClass();
            $data['TotalSubject'] = SubjectModel::getTotalSubject();
            
            


            return view('backend.admin.dashboard', $data);
        }
        else if(Auth::user()->user_type == 2)
        {
            $data['TotalStudent'] = User::getTeacherStudentCount(Auth::user()->id);
            $data['TotalClass'] = AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
            $data['TotalSubject'] = AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
            $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);

            return view('backend.teacher.dashboard', $data);
        }
        else if(Auth::user()->user_type == 3)
        {
            $data['TotalPaidAmount'] = StudentAddFeesModel::TotalPaidAmountStudent(Auth::user()->id);
            $data['TotalSubject'] = ClassSubjectModel::MySubjectTotal(Auth::user()->class_id);
            $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);
            $data['TotalHomework'] = HomeworkModel::getRecordStudentCount(Auth::user()->class_id, Auth::user()->id);
            $data['TotalSubmittedHomework'] = HomeworkSubmitModel::getRecordStudentCount(Auth::user()->id);
            $data['TotalAttendance'] = StudentAttendanceModel::getRecordStudentCount(Auth::user()->id);
            $data['TotalPresent'] = StudentAttendanceModel::getRecordStudentPresent(Auth::user()->id);
            $data['TotalLate'] = StudentAttendanceModel::getRecordStudentLate(Auth::user()->id);
            $data['TotalHalfDay'] = StudentAttendanceModel::getRecordStudentHalfDay(Auth::user()->id);
            $data['TotalAbsent'] = StudentAttendanceModel::getRecordStudentAbsent(Auth::user()->id);
            
         

            return view('backend.student.dashboard', $data);
        }
        else if(Auth::user()->user_type == 4)
        {
            $student_ids = User::getMyStudentIds(Auth::user()->id);
            if(!empty($student_ids))
            {
                $data['TotalPaidAmount'] = StudentAddFeesModel::TotalPaidAmountStudentParent($student_ids);
                $data['TotalAttendance'] = StudentAttendanceModel::getRecordStudentParentCount($student_ids);
            }
            else
            {
                $data['TotalPaidAmount'] = 0;
                $data['TotalAttendance'] = 0;
            }

            $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
            $data['TotalStudent'] = User::getMyStudentCount(Auth::user()->id);
            $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);
            return view('backend.parent.dashboard', $data);
        }
    }
}
