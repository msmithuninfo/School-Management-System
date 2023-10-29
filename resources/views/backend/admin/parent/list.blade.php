@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Parent List (Total: {{ $getRecord->total() }})</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/parent/add') }}" class="btn btn-primary">Add New Admin</a></li>
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
                <h3 class="card-title">Search Parent</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Name</label>
                      <input type="text" value="{{ Request::get('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Email</label>
                      <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/parent/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                        <h3 class="card-title">Parent List</h3>
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
                            <th>Profile Pic</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Mobile Number</th>
                            <th>Occupation</th>
                            <th>Address</th>
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
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->mobile_number }}</td>
                            <td>{{ $value->occupation }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{ url('backend/admin/parent/edit/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ url('backend/admin/parent/delete/'.$value->id) }}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                              </a>
                              <a href="{{ url('backend/admin/parent/my-student/'.$value->id) }}" class="btn btn-primary">
                                My Student
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