<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\FeesCollectionController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

Route::group(['middleware' => 'common'], function () {
    Route::get('chat', [ChatController::class, 'chat']);
    Route::post('submit_message', [ChatController::class, 'submit_message']);
    Route::post('get_chat_windows', [ChatController::class, 'get_chat_windows']);
    Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user']);
    
});



// Middleware
Route::group(['middleware' => 'admin'], function () {
    Route::get('backend/admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('backend/admin/list', [AdminController::class, 'list']);
    Route::get('backend/admin/add', [AdminController::class, 'add']);
    Route::post('backend/admin/add', [AdminController::class, 'insert']);
    Route::get('backend/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('backend/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('backend/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('backend/admin/account', [UserController::class, 'MyAccount']);
    Route::post('backend/admin/account', [UserController::class, 'UpdateMyAccountAdmin']);

    // setting
    Route::get('backend/admin/setting', [UserController::class, 'Setting']);
    Route::post('backend/admin/setting', [UserController::class, 'UpdateSetting']);

    // Teacher for admin
    Route::get('backend/admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('backend/admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('backend/admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('backend/admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('backend/admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('backend/admin/teacher/delete/{id}', [TeacherController::class, 'delete']);


    // Student for admin
    Route::get('backend/admin/student/list', [StudentController::class, 'list']);
    Route::get('backend/admin/student/add', [StudentController::class, 'add']);
    Route::post('backend/admin/student/add', [StudentController::class, 'insert']);
    Route::get('backend/admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('backend/admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('backend/admin/student/delete/{id}', [StudentController::class, 'delete']);

    // Parent for admin
    Route::get('backend/admin/parent/list', [ParentController::class, 'list']);
    Route::get('backend/admin/parent/add', [ParentController::class, 'add']);
    Route::post('backend/admin/parent/add', [ParentController::class, 'insert']);
    Route::get('backend/admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('backend/admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('backend/admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('backend/admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    Route::get('backend/admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('backend/admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);

    // Class URL
    Route::get('backend/admin/class/list', [ClassController::class, 'list']);
    Route::get('backend/admin/class/add', [ClassController::class, 'add']);
    Route::post('backend/admin/class/add', [ClassController::class, 'insert']);
    Route::get('backend/admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('backend/admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('backend/admin/class/delete/{id}', [ClassController::class, 'delete']);

    // Subject URL
    Route::get('backend/admin/subject/list', [SubjectController::class, 'list']);
    Route::get('backend/admin/subject/add', [SubjectController::class, 'add']);
    Route::post('backend/admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('backend/admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('backend/admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('backend/admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // assign_subject

    Route::get('backend/admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('backend/admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('backend/admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('backend/admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('backend/admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('backend/admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);

    Route::get('backend/admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('backend/admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

    // change password
    Route::get('backend/admin/change_password', [UserController::class, 'change_password']);
    Route::post('backend/admin/change_password', [UserController::class, 'update_change_password']);

    // Assign Class Teacher
    Route::get('backend/admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('backend/admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']);
    Route::post('backend/admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']);
    Route::get('backend/admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('backend/admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('backend/admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('backend/admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('backend/admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);

    Route::get('backend/admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('backend/admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('backend/admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);
    
    // Exam 
    Route::get('backend/admin/examinations/exam/list', [ExaminationsController::class, 'exam_list']);
    Route::get('backend/admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']);
    Route::post('backend/admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']);
    Route::get('backend/admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']);
    Route::post('backend/admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']);
    Route::get('backend/admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']);

    Route::get('backend/admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']);
    Route::post('backend/admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']);

    Route::get('backend/admin/examinations/marks_register', [ExaminationsController::class, 'marks_register']);
    Route::post('backend/admin/examinations/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('backend/admin/examinations/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);
    
    // marks grade
    Route::get('backend/admin/examinations/marks_grade/list', [ExaminationsController::class, 'marks_grade_list']);
    Route::get('backend/admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_add']);
    Route::post('backend/admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_insert']);
    Route::get('backend/admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_edit']);
    Route::post('backend/admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_update']);
    Route::get('backend/admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class, 'marks_grade_delete']);
    Route::get('backend/admin/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    // Attendance
    Route::get('backend/admin/attendance/student', [AttendanceController::class, 'AttendanceStudent']);
    Route::post('backend/admin/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    // Attendance report
    Route::get('backend/admin/attendance/report', [AttendanceController::class, 'AttendanceReport']);

    // Communicate
    Route::get('backend/admin/communicate/notice_board', [CommunicateController::class, 'NoticeBoard']);
    Route::get('backend/admin/communicate/notice_board/add', [CommunicateController::class, 'AddNoticeBoard']);
    Route::post('backend/admin/communicate/notice_board/add', [CommunicateController::class, 'InsertNoticeBoard']);
    Route::get('backend/admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'EditNoticeBoard']);
    Route::post('backend/admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'UpdateNoticeBoard']);
    Route::get('backend/admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'DeleteNoticeBoard']);
    // Send Email
    Route::get('backend/admin/communicate/send_email', [CommunicateController::class, 'SendEmail']);
    Route::post('backend/admin/communicate/send_email', [CommunicateController::class, 'SendEmailUser']);
    Route::get('backend/admin/communicate/search_user', [CommunicateController::class, 'SearchUser']);

    // Homework
    Route::get('backend/admin/homework/homework/list', [HomeworkController::class, 'list']);
    Route::get('backend/admin/homework/homework/add', [HomeworkController::class, 'add']);
    Route::post('backend/admin/homework/homework/add', [HomeworkController::class, 'insert']);
    Route::post('backend/admin/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::get('backend/admin/homework/homework/edit/{id}', [HomeworkController::class, 'edit']);
    Route::post('backend/admin/homework/homework/edit/{id}', [HomeworkController::class, 'update']);
    Route::get('backend/admin/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);
    Route::get('backend/admin/homework/homework/submitted/{id}', [HomeworkController::class, 'submitted']);

    Route::get('backend/admin/homework/homework_report', [HomeworkController::class, 'homework_report']);


    // Fees Collection
    Route::get('backend/admin/fees_collection/collect_fees', [FeesCollectionController::class, 'collect_fees']);
    Route::get('backend/admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_add']);
    Route::post('backend/admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_insert']);
    Route::get('backend/admin/fees_collection/collect_fees_report', [FeesCollectionController::class, 'collect_fees_report']);





});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('backend/teacher/dashboard', [DashboardController::class, 'dashboard']);
    // change password
    Route::get('backend/teacher/change_password', [UserController::class, 'change_password']);
    Route::post('backend/teacher/change_password', [UserController::class, 'update_change_password']);

    Route::get('backend/teacher/account', [UserController::class, 'MyAccount']);
    Route::post('backend/teacher/account', [UserController::class, 'UpdateMyAccount']);

    Route::get('backend/teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject']);

    Route::get('backend/teacher/my_student', [StudentController::class, 'MyStudent']);
    Route::get('backend/teacher/my_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'MyTimetableTeacher']);
    Route::get('backend/teacher/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher']);

    Route::get('backend/teacher/my_calendar', [CalendarController::class, 'MyCalendarTeacher']);

    Route::get('backend/teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']);
    Route::post('backend/teacher/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('backend/teacher/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);

    Route::get('backend/teacher/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);


    // Attendance
    Route::get('backend/teacher/attendance/student', [AttendanceController::class, 'AttendanceStudentTeacher']);
    Route::post('backend/teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    // Attendance report
    Route::get('backend/teacher/attendance/report', [AttendanceController::class, 'AttendanceReportTeacher']);

    // Notice Board
    Route::get('backend/teacher/my_notice_board', [CommunicateController::class, 'MyNoticeBoardTeacher']);

    // Homework
    Route::get('backend/teacher/homework/homework/list', [HomeworkController::class, 'TeacherList']);
    Route::get('backend/teacher/homework/homework/add', [HomeworkController::class, 'TeacherAdd']);
    Route::post('backend/teacher/homework/homework/add', [HomeworkController::class, 'TeacherInsert']);
    Route::post('backend/teacher/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::get('backend/teacher/homework/homework/edit/{id}', [HomeworkController::class, 'TeacherEdit']);
    Route::post('backend/teacher/homework/homework/edit/{id}', [HomeworkController::class, 'TeacherUpdate']);
    Route::get('backend/teacher/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);

    Route::get('backend/teacher/homework/homework/submitted/{id}', [HomeworkController::class, 'SubmittedTeacher']);


});

Route::group(['middleware' => 'student'], function () {
    Route::get('backend/student/dashboard', [DashboardController::class, 'dashboard']);
    // change password
    Route::get('backend/student/change_password', [UserController::class, 'change_password']);
    Route::post('backend/student/change_password', [UserController::class, 'update_change_password']);

    Route::get('backend/student/account', [UserController::class, 'MyAccount']);
    Route::post('backend/student/account', [UserController::class, 'UpdateMyAccountStudent']);

    Route::get('backend/student/my_subject', [SubjectController::class, 'MySubject']);
    Route::get('backend/student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);
    Route::get('backend/student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']);
    Route::get('backend/student/my_calendar', [CalendarController::class, 'MyCalendar']);
    Route::get('backend/student/my_exam_result', [ExaminationsController::class, 'myExamResult']);
    Route::get('backend/student/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);
    
    Route::get('backend/student/my_attendance', [AttendanceController::class, 'MyAttendanceStudent']);
    // Notice Board
    Route::get('backend/student/my_notice_board', [CommunicateController::class, 'MyNoticeBoardStudent']);
    // Homework
    Route::get('backend/student/my_homework', [HomeworkController::class, 'HomeworkStudent']);

    Route::get('backend/student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework']);
    Route::post('backend/student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert']);
    Route::get('backend/student/my_submitted_homework', [HomeworkController::class, 'HomeworkSubmittedStudent']);

    // Fees Collection
    Route::get('backend/student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudent']);
    Route::post('backend/student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudentPayment']);
    
    // paypal
    Route::get('backend/student/paypal/payment-error', [FeesCollectionController::class, 'PaymentError']);
    Route::get('backend/student/paypal/payment-success', [FeesCollectionController::class, 'PaymentSuccess']);

    // Stripe
    Route::get('backend/student/stripe/payment-error', [FeesCollectionController::class, 'PaymentError']);
    Route::get('backend/student/stripe/payment-success', [FeesCollectionController::class, 'PaymentSuccessStripe']);


});

Route::group(['middleware' => 'parent'], function () {
    Route::get('backend/parent/dashboard', [DashboardController::class, 'dashboard']);
    // change password
    Route::get('backend/parent/change_password', [UserController::class, 'change_password']);
    Route::post('backend/parent/change_password', [UserController::class, 'update_change_password']);

    Route::get('backend/parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject']);

    Route::get('backend/parent/account', [UserController::class, 'MyAccount']);
    Route::post('backend/parent/account', [UserController::class, 'UpdateMyAccountParent']);

    Route::get('backend/parent/my_student', [ParentController::class, 'MyStudentParent']);

    Route::get('backend/parent/my_student/calendar/{student_id}', [CalendarController::class, 'MyCalendarParent']);

    Route::get('backend/parent/my_student_class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'MyTimetableParent']);

    Route::get('backend/parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class, 'ParentMyExamTimetable']);

    Route::get('backend/parent/my_student/exam_result/{student_id}', [ExaminationsController::class, 'ParentMyExamResult']);

    Route::get('backend/parent/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    Route::get('backend/parent/my_student/attendance/{student_id}', [AttendanceController::class, 'MyAttendanceParent']);

    // Notice Board
    Route::get('backend/parent/my_student_notice_board', [CommunicateController::class, 'MyStudentNoticeBoardParent']);
    Route::get('backend/parent/my_notice_board', [CommunicateController::class, 'MyNoticeBoardParent']);

    Route::get('backend/parent/my_student/homework/{id}', [HomeworkController::class, 'HomeworkStudentParent']);
    Route::get('backend/parent/my_student/submitted_homework/{id}', [HomeworkController::class, 'SubmittedHomeworkStudentParent']);
    

    Route::get('backend/parent/my_student/fees_collection/{student_id}', [FeesCollectionController::class, 'CollectFeesStudentParent']);
    Route::post('backend/parent/my_student/fees_collection/{student_id}', [FeesCollectionController::class, 'CollectFeesStudentPaymentParent']);
    // paypal
    Route::get('backend/parent/paypal/payment-error/{student_id}', [FeesCollectionController::class, 'PaymentErrorParent']);
    Route::get('backend/parent/paypal/payment-success/{student_id}', [FeesCollectionController::class, 'PaymentSuccessParent']);

    // Stripe
    Route::get('backend/parent/stripe/payment-error/{student_id}', [FeesCollectionController::class, 'PaymentErrorParent']);
    Route::get('backend/parent/stripe/payment-success/{student_id}', [FeesCollectionController::class, 'PaymentSuccessStripeParent']);

});