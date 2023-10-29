@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/list') }}" class="btn btn-primary">Admin List</a></li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            @include('message.message')
          <!-- general form elements -->
          <div class="card card-primary">
            <form action="" method="POST">
                @csrf

              <div class="card-body">
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="password" name="old_password" required class="form-control" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required class="form-control" placeholder="New Password">
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