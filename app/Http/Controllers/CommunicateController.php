<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailUserMail;
use App\Models\NoticeBoardMessageModel;
use App\Models\NoticeBoardModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommunicateController extends Controller
{
    public function SendEmail()
    {
        $data['header_title'] = "Send Email";
        return view('backend.admin.communicate.send_email', $data);
    }

    public function SendEmailUser(Request $request)
    {
        if(!empty($request->user_id))
        {
            $user = User::getSingle($request->user_id);
            $user->send_message = $request->message;
            $user->send_subject = $request->subject;
            Mail::to($user->email)->send(new SendEmailUserMail($user));
        }

        if(!empty($request->message_to))
        {
            foreach($request->message_to as $user_type)
            {
                $getUser = User::getUser($user_type);
                foreach($getUser as $user)
                {
                    $user->send_message = $request->message;
                    $user->send_subject = $request->subject;
                    Mail::to($user->email)->send(new SendEmailUserMail($user));
                }
            }
        }


        return redirect()->back()->with('success', 'Mail Successfully Send');
    }
    
    public function SearchUser(Request $request)
    {
        $json = array();
        if(!empty($request->search))
        {
            $getUser = User::SearchUser($request->search);
            foreach($getUser as $value)
            {
                $type = '';
                if($value->user_type == 1)
                {
                    $type = 'Admin';
                }
                elseif($value->user_type == 2)
                {
                    $type = 'Teacher';
                }
                elseif($value->user_type == 3)
                {
                    $type = 'Student';
                }
                elseif($value->user_type == 4)
                {
                    $type = 'Parent';
                }
                $name = $value->name.' '.$value->last_name.' - '.$type;
                $json[] = ['id'=> $value->id, 'text'=>$name];
            }
        }
        echo json_encode($json);
    }

    public function NoticeBoard()
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        $data['header_title'] = "Notice Board";
        return view('backend.admin.communicate.notice_board.list', $data);
    }

    public function AddNoticeBoard()
    {
        $data['header_title'] = "Add Notice Board";
        return view('backend.admin.communicate.notice_board.add', $data);
    }

    public function InsertNoticeBoard(Request $request)
    {
        $save = new NoticeBoardModel();
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessageModel();
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('backend/admin/communicate/notice_board')->with('success', 'Notice Board Successfully created');
    }
    public function EditNoticeBoard($id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        $data['header_title'] = "Edit Notice Board";
        return view('backend.admin.communicate.notice_board.edit', $data);
    }

    public function UpdateNoticeBoard(Request $request, $id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->save();

        NoticeBoardMessageModel::DeleteRecord($id);
        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessageModel();
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }

        return redirect('backend/admin/communicate/notice_board')->with('success', 'Notice Board Successfully Updated');
    }
    public function DeleteNoticeBoard($id)
    {
        $save = NoticeBoardModel::getSingle($id);
        $save->delete();
        NoticeBoardMessageModel::DeleteRecord($id);
        return redirect('backend/admin/communicate/notice_board')->with('success', 'Notice Board Successfully Deleted');


    }

    // Student Notice Board
    public function MyNoticeBoardStudent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "My Notice Board";
        return view('backend.student.my_notice_board', $data);
    }

    // Teacher Notice Board
    public function MyNoticeBoardTeacher()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "My Notice Board";
        return view('backend.teacher.my_notice_board', $data);
    }

    // Parent Student Notice Board
    public function MyStudentNoticeBoardParent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(3);
        $data['header_title'] = "My Student Notice Board";
        return view('backend.parent.my_student_notice_board', $data);
    }

    // Parent Notice Board
    public function MyNoticeBoardParent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "My Notice Board";
        return view('backend.parent.my_notice_board', $data);
    }
}
