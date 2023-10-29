@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject List </h1>
          {{-- (Total: {{ $getRecord->total() }}) --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/subject/add') }}" class="btn btn-primary">Add New Subject</a></li>
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
                <h3 class="card-title">Search Subject</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Name</label>
                      <input type="text" value="{{ Request::get('name') }}" name="name" class="form-control" placeholder="Name">
                    </div>

                    <div class="form-group col-md-3">
                      <label>Subject Type</label>
                      <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                        <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Practical</option>
                      </select>
                    </div>


                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/subject/list') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                        <h3 class="card-title">Subject List</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getRecord as $value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->type }}</td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>
                                @if($value->status == 0 )
                                Active
                                @else
                                Inactive
                                @endif

                            </td>
                            
                            
                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{ url('backend/admin/subject/edit/'.$value->id) }}" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ url('backend/admin/subject/delete/'.$value->id) }}" class="btn btn-danger">
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