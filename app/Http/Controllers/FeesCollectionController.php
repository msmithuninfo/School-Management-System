<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\SettingModel;
use App\Models\StudentAddFeesModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

class FeesCollectionController extends Controller
{
    public function collect_fees(Request $request)
    {
        $data['getClass'] = ClassModel::getClassForAssign();
        if(!empty($request->all()))
        {
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        $data['header_title'] = 'Collect Fees';
        return view('backend.admin.fees_collection.collect_fees', $data);
    }

    public function collect_fees_report(Request $request)
    {
        $data['getClass'] = ClassModel::getClassForAssign();
        $data['getRecord'] = StudentAddFeesModel::getRecord();
        $data['header_title'] = 'Collect Fees Report';
        return view('backend.admin.fees_collection.collect_fees_report', $data);
    }
    
    
    public function collect_fees_add($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);


        $data['header_title'] = 'Add Collect Fees';
        return view('backend.admin.fees_collection.add_collect_fees', $data);
    }
    
    public function collect_fees_insert($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >=  $request->amount)
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;
    
                $payment = new StudentAddFeesModel();
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                
    
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();
                return redirect()->back()->with('success', 'Fees Successfully Add');
            }
            else
            {
                return redirect()->back()->with('error', 'Your Amount is greater than Remaining Amount!');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Your Remaining Amount is $0.00');
        }

        
    }

    // student fees collection
    
    
    public function CollectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        $data['header_title'] = 'Fees Collection';
        return view('backend.student.my_fees_collection', $data);
    }


    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);
        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >=  $request->amount)
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;
    
                $payment = new StudentAddFeesModel();
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                
    
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();
                $getSetting = SettingModel::getSingle();
                if($request->payment_type == 'Paypal')
                {
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = "_xclick";
                    $query['item_name'] = 'Student Fees';
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('backend/student/paypal/payment-error');
                    $query['return'] = url('backend/student/paypal/payment-success');

                    $query_string = http_build_query($query);
                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' .$query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query_string);
                    exit();
                }
                else if($request->payment_type == 'Stripe')
                {
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;

                    Stripe::setApiKey($setApiKey);
                    $final_price = $request->amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'name' => 'Student Fees',
                            'description' => 'Student Fees',
                            'images' => [ url('assets/dist/img/user2-160x160.jpg')],
                            'amount' => intval($final_price),
                            'currency' => 'usd',
                            'quantity' => 1,
                        ]],
                        'success_url' => url('backend/student/stripe/payment-success'),
                        'cancel_url' => url('backend/student/stripe/payment-error'),
                        ]);


                        $payment->stripe_session_id = $session['id'];
                        $payment->save();

                        $data['session_id'] = $session['id'];
                        Session::put('stripe_session_id', $session['id']);
                        $data['setPublicKey'] = $setPublicKey;

                        return view('backend.stripe_charge', $data);
                }
                
            }
            else
            {
                return redirect()->back()->with('error', 'Your Amount is greater than Remaining Amount!');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'You need add your amount at least $1');
        }

        
    }

    public function PaymentSuccessStripe(Request $request)
    {
        $getSetting = SettingModel::getSingle();
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first();

        \Stripe\Stripe::setApiKey($setApiKey);
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);
        
        if(!empty($getdata->id) && $getdata->id == $trans_id && !empty($getFee) && $getdata->status == 'complete' && $getdata->payment_status == 'paid')
        {
            $getFee->is_payment = 1;
            $getFee->payment_data = json_encode($getdata);
            $getFee->save();

            Session::forget('stripe_session_id');
            return redirect('backend/student/fees_collection')->with('success', 'Your Payment Successfully!');
        }
        else
        {
            return redirect('backend/student/fees_collection')->with('error', 'Due 2 to some error please try again!');
        }

    }

    public function PaymentError()
    {
        return redirect('backend/student/fees_collection')->with('error', 'Due to some error please try again!');
    }
    public function PaymentSuccess(Request $request)
    {
        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fess))
            {
                $fess->is_payment = 1;
                $fess->payment_data = json_encode($request->all());
                $fees->save();
                return redirect('backend/student/fees_collection')->with('success', 'Your Payment Successfully!');
            }
            else
            {
                return redirect('backend/student/fees_collection')->with('error', 'Due 2 to some error please try again!');
            }
        }
        else 
        {
        return redirect('backend/student/fees_collection')->with('error', 'Due 3 to some error please try again!');

        }
    }

    // Parent Side 
    public function CollectFeesStudentParent(Request $request, $student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        $data['header_title'] = 'Fees Collection';
        return view('backend.parent.my_fees_collection', $data);
    }

    public function CollectFeesStudentPaymentParent(Request $request, $student_id)
    {
        $getStudent = User::getSingleClass($student_id);

        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >=  $request->amount)
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;
    
                $payment = new StudentAddFeesModel();
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                
    
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->save();
                $getSetting = SettingModel::getSingle();
                if($request->payment_type == 'Paypal')
                {
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = "_xclick";
                    $query['item_name'] = 'Student Fees';
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('backend/parent/paypal/payment-error/'.$student_id);
                    $query['return']        = url('backend/parent/paypal/payment-success/'.$student_id);

                    $query_string = http_build_query($query);
                    // header('Location: https://www.paypal.com/cgi-bin/webscr?' .$query_string);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query_string);
                    exit();
                }
                else if($request->payment_type == 'Stripe')
                {
                    $setPublicKey = $getSetting->stripe_key;
                    $setApiKey = $getSetting->stripe_secret;

                    Stripe::setApiKey($setApiKey);
                    $final_price = $request->amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => Auth::user()->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'name' => 'Student Fees',
                            'description' => 'Student Fees',
                            'images' => [ url('assets/dist/img/user2-160x160.jpg')],
                            'amount' => intval($final_price),
                            'currency' => 'usd',
                            'quantity' => 1,
                        ]],
                        'success_url' => url('backend/parent/stripe/payment-success'),
                        'cancel_url' => url('backend/parent/stripe/payment-error'),
                        ]);


                        $payment->stripe_session_id = $session['id'];
                        $payment->save();

                        $data['session_id'] = $session['id'];
                        Session::put('stripe_session_id', $session['id']);
                        $data['setPublicKey'] = $setPublicKey;

                        return view('backend.stripe_charge', $data);
                }
                
            }
            else
            {
                return redirect()->back()->with('error', 'Your Amount is greater than Remaining Amount!');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'You need add your amount at least $1');
        }

        
    }

    public function PaymentErrorParent($student_id)
    {
        return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again!');
    }
    public function PaymentSuccessParent(Request $request, $student_id)
    {
        if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
        {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if(!empty($fess))
            {
                $fess->is_payment = 1;
                $fess->payment_data = json_encode($request->all());
                $fees->save();
                return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('success', 'Your Payment Successfully!');
            }
            else
            {
                return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('error', 'Due 2 to some error please try again!');
            }
        }
        else 
        {
        return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('error', 'Due 3 to some error please try again!');

        }
    }
    public function PaymentSuccessStripeParent(Request $request, $student_id)
    {
        $getSetting = SettingModel::getSingle();
        $setPublicKey = $getSetting->stripe_key;
        $setApiKey = $getSetting->stripe_secret;

        $trans_id = Session::get('stripe_session_id');
        $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first();

        \Stripe\Stripe::setApiKey($setApiKey);
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);
        
        if(!empty($getdata->id) && $getdata->id == $trans_id && !empty($getFee) && $getdata->status == 'complete' && $getdata->payment_status == 'paid')
        {
            $getFee->is_payment = 1;
            $getFee->payment_data = json_encode($getdata);
            $getFee->save();

            Session::forget('stripe_session_id');
            
            return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('success', 'Your Payment Successfully!');
        }
        else
        {
            return redirect('backend/parent/my_student/fees_collection/'.$student_id)->with('error', 'Due 3 to some error please try again!');
        }

    }

}
