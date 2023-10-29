@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Exam Timetable </h1>
          {{-- (Total: {{ $getRecord->total() }}) --}}
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
              @include('message.message')
                @foreach($getRecord as $value)
                  <div class="card-header">
                    <h4 class=""> <span style="color: blue;"> Class: {{ $value['class_name'] }}</span> </h4>
                  </div>
                  @foreach ($value['exam'] as $exam)
                  <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> <b>Exam Name: {{ $exam['exam_name'] }}</b> </h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Day</th>
                                <th>Exam Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room Number</th>
                                <th>Full Marks</th>
                                <th>Passing Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($exam['subject'] as $valueS)
                          <tr>
                              <td>{{ $valueS['subject_name'] }}</td>
                              <td>{{ date('l', strtotime($valueS['exam_date'])) }}</td>
                              <td>{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>
                              <td>{{ date('h:i A', strtotime($valueS['start_time'])) }}</td>
                              <td>{{ date('h:i A', strtotime($valueS['end_time'])) }}</td>
                              <td>{{ $valueS['room_number'] }}</td>
                              <td>{{ $valueS['full_marks'] }}</td>
                              <td>{{ $valueS['passing_marks'] }}</td>
                          </tr>
                      @endforeach
                        </tbody>
                        </table>
                    </div>
                  </div>
                  @endforeach

                @endforeach
            </div>
        </div>
    </div>
</section>
  </div>

@endsection
