@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Attendance Report <span>(Total: {{ $getRecord->total() }})</span></h1>
        
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
                <h3 class="card-title">Search Attendance Report</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                        <label>Student ID</label>
                       <input type="text" class="form-control" value="{{ Request::get('student_id') }}" name="student_id" placeholder="Student ID">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Student Name</label>
                       <input type="text" class="form-control" value="{{ Request::get('student_name') }}" name="student_name" placeholder="Student Name">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Class</label>
                      <select class="form-control" name="class_id">
                        <option value="">Select</option>
                          @foreach ($getClass as $class)
                              <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Attendance Date</label>
                       <input type="date" class="form-control" value="{{ Request::get('attendance_date') }}" name="attendance_date">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Attendance Type</label>
                        <select name="attendance_type" class="form-control">
                            <option value="">Select</option>
                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                            <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Half Day</option>
                            <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Absent</option>
                        </select>
                    </div>


                    <div class="form-group col-md-2">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/attendance/report') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance List</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Class Name</th>
                                <th>Attendance</th>
                                <th>Attendance Date</th>
                                <th>Created Date</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->student_id }}</td>
                                    <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>
                                        @if ($value->attendance_type == 1)
                                            Present
                                        @elseif($value->attendance_type == 2)
                                            Late
                                        @elseif($value->attendance_type == 3)
                                            Half Day
                                        @elseif($value->attendance_type == 4)
                                            Absent
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                    <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->created_name }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">Record Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>     
                        <div style="padding: 10px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                          </div>               
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  </div>

@endsection

@section('script').


@endsection
