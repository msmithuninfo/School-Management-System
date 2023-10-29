@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Exam List (Total: {{ $getRecord->total() }})</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/examinations/exam/add') }}" class="btn btn-primary">Add New Exam</a></li>
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
                <h3 class="card-title">Search Exam</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Exam Name</label>
                      <input type="text" value="{{ Request::get('name') }}" name="name" class="form-control" placeholder="Exam Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Date">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/examinations/exam/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                        <h3 class="card-title">Exam List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Exam Name</th>
                            <th>Note</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getRecord as $value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->note }}</td>
                            <td>{{ $value->created_name }}</td>
                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{ url('backend/admin/examinations/exam/edit/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ url('backend/admin/examinations/exam/delete/'.$value->id) }}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
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