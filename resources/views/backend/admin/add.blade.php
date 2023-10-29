@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create New Admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/list') }}" class="btn btn-primary">Admin List</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" required class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Enter email">
                  <div style="color:red;">{{ $errors->first('email') }}</div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" required class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                  <label>Profile Pic</label>
                  <input type="file" class="form-control" name="profile_pic">
                  <div style="color: red;">{{ $errors->first('profile_pic') }}</div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  </div>

@endsection