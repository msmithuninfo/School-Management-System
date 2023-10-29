@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create New Subject</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/subject/list') }}" class="btn btn-primary">Subject List</a></li>
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
            <form action="" method="POST">
                @csrf

              <div class="card-body">
                <div class="form-group">
                    <label>Subject Name</label>
                    <input type="text" name="name" required class="form-control" placeholder="Subject Name">
                </div>

                <div class="form-group">
                  <label>Subject Type</label>
                  <select name="type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Theory">Theory</option>
                    <option value="Practical">Practical</option>
                  </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
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