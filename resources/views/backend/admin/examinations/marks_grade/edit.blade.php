@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Marks Grade</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/examinations/marks_grade/list') }}" class="btn btn-primary">Marks Grade List</a></li>
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
                    <label>Grade Name</label>
                    <input type="text" value="{{ old('name', $getRecord->name) }}" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Percent From</label>
                    <input type="number" value="{{ old('percent_from',$getRecord->percent_from) }}" name="percent_from" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Percent To</label>
                    <input type="number" value="{{ old('percent_to', $getRecord->percent_to) }}" name="percent_to" required class="form-control">
                </div>

                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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