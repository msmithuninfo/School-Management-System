@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Parent Student List </h1>
          {{-- ({{ $getParent->name }} {{ $getParent->last_name }}) --}}
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
                <h3 class="card-title">Search Parent</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                        <label>Student ID</label>
                        <input type="text" value="{{ Request::get('id') }}" name="id" class="form-control" placeholder="Student Name">
                      </div>
                    <div class="form-group col-md-2">
                      <label>Name</label>
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
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/parent/my-student/'.$parent_id) }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
            @if(!empty($getSearchStudent))    
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student List</h3>
                    
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Profile Pic</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Parent Name</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getSearchStudent as $value)
                            <tr>
                              <td>{{ $value->id }}</td>
                              <td>
                                @if (!empty($value->getProfile()))
                                  <img src="{{ $value->getProfile() }}" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
                                @endif
                              </td>
                              <td>{{ $value->name }} {{ $value->last_name }}</td>
                              <td>{{ $value->email }}</td>
                              <td>{{ $value->parent_name }}</td>
                              
                              <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                              <td>
                                <a href="{{ url('backend/admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id) }}" class="btn btn-info">
                                  Add Student to Parent
                                </a>
                                
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>

                       
                    </div>
                    <!-- /.card-body -->
                </div>
                @endif
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Parent Student List</h3>
                    
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Profile Pic</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Parent Name</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                            <tr>
                              <td>{{ $value->id }}</td>
                              <td>
                                @if (!empty($value->getProfile()))
                                  <img src="{{ $value->getProfile() }}" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
                                @endif
                              </td>
                              <td>{{ $value->name }} {{ $value->last_name }}</td>
                              <td>{{ $value->email }}</td>
                              <td>{{ $value->parent_name }}</td>
                              
                              <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                              <td>
                                <a href="{{ url('backend/admin/parent/assign_student_parent_delete/'.$value->id) }}" class="btn btn-danger">
                                  Delete
                                </a>
                                
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