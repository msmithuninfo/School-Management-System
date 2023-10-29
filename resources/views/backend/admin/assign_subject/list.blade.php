@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Assign Subject List </h1>
          {{-- (Total: {{ $getRecord->total() }}) --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/assign_subject/add') }}" class="btn btn-primary">Add New Assign Subject</a></li>
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
                <h3 class="card-title">Search Assign Subject</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Class Name</label>
                      <input type="text" value="{{ Request::get('class_name') }}" name="class_name" class="form-control" placeholder="Class Name">
                    </div>

                    <div class="form-group col-md-3">
                      <label>Subject Name</label>
                      <input type="text" value="{{ Request::get('subject_name') }}" name="subject_name" class="form-control" placeholder="Subject Name">
                    </div>

                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/assign_subject/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                        <h3 class="card-title">Assign Subject List</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Class Name</th>
                            <th>Subject Name</th>
                            <th>Status</th>
                            <th>Created By</th>
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
                            <td>
                                @if($value->status == 0 )
                                Active
                                @else
                                Inactive
                                @endif

                            </td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{ url('backend/admin/assign_subject/edit/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ url('backend/admin/assign_subject/edit_single/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>Single
                              </a>
                              <a href="{{ url('backend/admin/assign_subject/delete/'.$value->id) }}" class="btn btn-danger">
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