@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Class & Subject</h1>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Class & Subject</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Class Name</th>
                            <th>Subject Name</th>
                            <th>Subject Type</th>
                            <th>My Class Timetable</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                            <tr>
                              <td>{{ $value->id }}</td>
                              <td>{{ $value->class_name }}</td>
                              <td>{{ $value->subject_name }}</td>
                              <td>{{ $value->subject_type }}</td>
                              <td>
                                @php
                                  $ClassSubject = $value->getMyTimeTable($value->class_id,$value->subject_id)
                                @endphp
                                @if (!empty($ClassSubject))
                                    {{ date('h:i A',strtotime($ClassSubject->start_time)) }} to {{ date('h:i A',strtotime($ClassSubject->end_time)) }}
                                    ({{ $ClassSubject->room_number }})
                                @endif
                              </td>
                              <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                              <td>
                                <a class="btn btn-primary" href="{{ url('backend/teacher/my_timetable/'.$value->class_id.'/'.$value->subject_id) }}">My Class Timetable</a>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
  </div>

@endsection