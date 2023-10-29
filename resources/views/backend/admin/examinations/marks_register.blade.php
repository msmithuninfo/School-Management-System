@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Marks Register </h1>
        
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Marks Register</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Exam Name</label>
                      <select class="form-control " name="exam_id" required>
                        <option value="">Select</option>
                        @foreach ($getExam as $exam)
                              <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Class</label>
                      <select class="form-control" name="class_id" required>
                        <option value="">Select</option>
                          @foreach ($getClass as $class)
                              <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/examinations/marks_register') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
  <section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
              @include('message.message')
              @if (!empty($getSubject) && !empty($getSubject->count()))
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Marks Register </h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                              <th>Student Name</th>
                              @foreach ($getSubject as $subject)
                                <th>
                                  {{ $subject->subject_name }} <br>

                                  ({{ $subject->subject_type }} : 
                                  {{ $subject->passing_marks }} / 
                                  {{ $subject->full_marks }}) 
                                </th>
                              @endforeach
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if (!empty($getStudent) && !empty($getStudent->count()))
                            @foreach ($getStudent as $student)
                            <form name="post" class="SubmitForm">
                              {{ csrf_field() }}
                              <input type="hidden" name="student_id" value="{{ $student->id }}">
                              <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                              <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                              <tr>
                                <td>{{ $student->name }} {{ $student->last_name }}</td>
                                @php
                                  $i = 1;
                                  $totalStudentMark = 0;
                                  $totalFullMark = 0;
                                  $totalPassingMark = 0;
                                  $pass_fail_vali = 0;
                                @endphp
                                @foreach ($getSubject as $subject)

                                  @php
                                    $totalMark = 0;
                                    $totalFullMark = $totalFullMark + $subject->full_marks;
                                    $totalPassingMark = $totalPassingMark + $subject->passing_marks;

                                    $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);

                                    if(!empty($getMark))
                                    {
                                      $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam;
                                    }
                                    $totalStudentMark = $totalStudentMark + $totalMark;
                                  @endphp

                                  

                                 <td>
                                  <div>
                                    Class Work
                                    <input type="hidden" name="mark[{{ $i }}][full_marks]" value="{{ $subject->full_marks }}">
                                    <input type="hidden" name="mark[{{ $i }}][passing_marks]" value="{{ $subject->passing_marks }}">

                                    <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                    <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                                    <input type="text" name="mark[{{ $i }}][class_work]" id="class_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" class="form-control">
                                  </div>
                                  <div>
                                    Home Work
                                    <input type="text" name="mark[{{ $i }}][home_work]" id="home_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" class="form-control">
                                  </div>
                                  <div>
                                    Test Work
                                    <input type="text" name="mark[{{ $i }}][test_work]" id="test_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" class="form-control">
                                  </div>
                                  <div>
                                    Exam
                                    <input type="text" name="mark[{{ $i }}][exam]" id="exam_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" class="form-control">
                                  </div>
                                  <div style="margin-top: 5px; display: flex;">
                                    <div>
                                      <button type="button" class="btn btn-primary SaveSingleSubject" data-schedule="{{ $subject->id }}" id="{{ $student->id }}" data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" data-class="{{ Request::get('class_id') }}">Save</button>
                                    </div>
                                    @if(!empty($getMark))
                                    <div style="margin-left: auto; margin-top: 5px; margin-right: 5px; background: deepskyblue; border-radius: 5px; padding: 3px;">
                                      TM: {{ $totalMark }}
                                      PM: {{ $subject->passing_marks }}
                                      FM: {{ $subject->full_marks }}
                                      @php
                                        $getLoopGrade = App\Models\MarksGradeModel::getGrade($totalMark);
                                      @endphp
                                      @if (!empty($getLoopGrade))
                                        <span>Grade: {{ $getLoopGrade }}</span>
                                      @endif
                                      @if($totalMark >= $subject->passing_marks)
                                        <span>Pass</span>
                                      @else
                                        <span>Fail</span>
                                        @php
                                          $pass_fail_vali = 1;
                                        @endphp
                                      @endif

                                    </div>
                                    @endif
                                  </div>
                                  </td> 
                                  @php
                                  $i++;
                                  @endphp
                                @endforeach
                                
                                <td>
                                  <button type="submit" class="btn btn-success">Save</button>
                                  <a href="{{ url('backend/admin/my_exam_result/print?exam_id='.Request::get('exam_id').'&student_id='.$student->id) }}" target="_blank" class="btn-sm float-right btn btn-primary">Print</a>
                                  @if(!empty($totalStudentMark))
                                    <span>TM{{ $totalStudentMark }}</span>
                                    <span>FM{{ $totalFullMark }}</span>
                                    <span>PM{{ $totalPassingMark }}</span>
                                    @php
                                      $percentage = ($totalStudentMark * 100 ) / $totalFullMark;
                                      $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                    @endphp
                                    <span>{{ round($percentage,2) }}%</span>
                                    @if (!empty($getGrade))
                                      <span style="color: blue;">{{ $getGrade }}</span>
                                    @endif
                                    @if ($pass_fail_vali == 0)
                                      <span style="color: green;">Pass</span>
                                    @else
                                      <span style="color: red;">Fail</span>
                                    @endif
                                  @endif
                                  
                                </td>
                              </tr>
                              
                            </form>
                            @endforeach
                          @endif
                        </tbody>
                        </table>                    
                    </div>
                </div>
                
              @endif
            </div>
        </div>
    </div>
</section>
  </div>

@endsection

@section('script').

<script type="text/javascript">
  $('.SubmitForm').submit(function(e){
  e.preventDefault();
      $.ajax({
        type: "POST",
        url: "{{ url('backend/admin/examinations/submit_marks_register') }}",
        data : $(this).serialize(),
        dataType : "json",
        success: function(data){
          alert(data.message);
        }
      });
  })

  $('.SaveSingleSubject').click(function(e){
    var student_id = $(this).attr('id');
    var subject_id = $(this).attr('data-val');
    var exam_id = $(this).attr('data-exam');
    var class_id = $(this).attr('data-class');
    var id = $(this).attr('data-schedule');
    var class_work = $('#class_work_'+student_id+subject_id).val();
    var home_work = $('#home_work_'+student_id+subject_id).val();
    var test_work = $('#test_work_'+student_id+subject_id).val();
    var exam = $('#exam_'+student_id+subject_id).val();

    $.ajax({
        type: "POST",
        url: "{{ url('backend/admin/examinations/single_submit_marks_register') }}",
        data : {
          "_token": "{{ csrf_token() }}",
          id : id,
          student_id : student_id,
          subject_id : subject_id,
          exam_id : exam_id,
          class_id : class_id,
          class_work : class_work,
          home_work : home_work,
          test_work : test_work,
          exam : exam,
        },
        dataType : "json",
        success: function(data){
          alert(data.message);
        }
    });
  })
</script>

@endsection