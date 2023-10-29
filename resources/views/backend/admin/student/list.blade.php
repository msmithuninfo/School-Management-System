@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student List (Total: {{ $getRecord->total() }})</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/student/add') }}" class="btn btn-primary">Add New Student</a></li>
          </ol>
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
                <h3 class="card-title">Search Student</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>First Name</label>
                      <input type="text" value="{{ Request::get('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Last Name</label>
                      <input type="text" value="{{ Request::get('last_name') }}" name="last_name" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Email</label>
                      <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Admission Number</label>
                      <input type="text" name="admission_number" value="{{ Request::get('admission_number') }}" class="form-control" placeholder="Admission Number">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Roll Number</label>
                      <input type="text" name="roll_number" value="{{ Request::get('roll_number') }}" class="form-control" placeholder="Roll Number">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Class Name</label>
                      <input type="text" name="class_name" value="{{ Request::get('class_name') }}" class="form-control" placeholder="Roll Number">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Gender</label>
                      <select name="gender" class="form-control">
                          <option value="">Select Gender</option>
                          <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                          <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                          <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Caste</label>
                    <input type="text" name="caste" value="{{ Request::get('caste') }}" class="form-control" placeholder="Caste">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Religion</label>
                    <input type="text" name="religion" value="{{ Request::get('religion') }}" class="form-control" placeholder="Religion">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_number" value="{{ Request::get('mobile_number') }}" class="form-control" placeholder="Mobile Number">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Blood Group</label>
                    <input type="text" name="blood_group" value="{{ Request::get('blood_group') }}" class="form-control" placeholder="Blood Group">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select Gender</option>
                        <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                        <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                      </select>
                  </div>

                    <div class="form-group col-md-2">
                      <label>Admission Date</label>
                      <input type="date" name="admission_date" value="{{ Request::get('admission_date') }}" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Created Date</label>
                      <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/student/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student List</h3>
                        {{-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                        </div> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Email</th>
                            <th>Admission Number</th>
                            <th>Roll Number</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Date Of Birth</th>
                            <th>Caste</th>
                            <th>Religion</th>
                            <th>Mobile Number</th>
                            <th>Admission Date</th>
                            <th>Blood Group</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getRecord as $value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                              @if (!empty($value->getProfileDirect()))
                                <img src="{{ $value->getProfileDirect() }}" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
                              @endif
                            </td>
                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                            <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->admission_number }}</td>
                            <td>{{ $value->roll_number }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>
                              @if(!empty($value->date_of_birth))
                              {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                              @endif
                            </td>
                            <td>{{ $value->caste }}</td>
                            <td>{{ $value->religion }}</td>
                            <td>{{ $value->mobile_number }}</td>
                            <td>
                              @if(!empty($value->admission_date))
                              {{ date('d-m-Y', strtotime($value->admission_date)) }}
                              @endif
                            </td>
                            <td>{{ $value->blood_group }}</td>
                            <td>{{ $value->height }}</td>
                            <td>{{ $value->weight }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{ url('backend/admin/student/edit/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ url('backend/admin/student/delete/'.$value->id) }}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                              </a>
                              <a href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class="btn btn-primary">
                                Send Message
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        </table>
                        <div style="padding: 10px; float: right;">
                          {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                       
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