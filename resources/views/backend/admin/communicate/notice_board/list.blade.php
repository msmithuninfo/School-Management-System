@extends('backend.layouts.app')
@section('content')  
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notice Board</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('backend/admin/communicate/notice_board/add') }}" class="btn btn-primary">Add New Notice Board</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Search Notice Board</h3>
                    </div>
                    <form action="" method="get">
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Title</label>
                            <input type="text" value="{{ Request::get('title') }}" name="title" class="form-control" placeholder="Title">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Notice Date From</label>
                            <input type="date" name="notice_date_from" value="{{ Request::get('notice_date_from') }}" class="form-control">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Notice Date TO</label>
                            <input type="date" name="notice_date_to" value="{{ Request::get('notice_date_to') }}" class="form-control" >
                          </div>

                          <div class="form-group col-md-3">
                            <label>Publish Date From</label>
                            <input type="date" name="publish_date_from" value="{{ Request::get('publish_date_from') }}" class="form-control">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Publish Date TO</label>
                            <input type="date" name="publish_date_to" value="{{ Request::get('publish_date_to') }}" class="form-control" >
                          </div>
                   
                          <div class="form-group col-md-3">
                            <label>Message To</label>
                            <select name="message_to" id="" class="form-control">
                                <option value="">Select</option>
                                <option {{ (Request::get('message_to') ==  3) ? 'selected' : '' }} value="3">Student</option>
                                <option {{ (Request::get('message_to') ==  4) ? 'selected' : '' }} value="4">Parent</option>
                                <option {{ (Request::get('message_to') ==  2) ? 'selected' : '' }} value="2">Teacher</option>
                            </select>
                          </div>
      
                          <div class="form-group col-md-3">
                            <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                            <a href="{{ url('backend/admin/communicate/notice_board') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('message.message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Notice Board List</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Title</td>
                                        <td>Notice Date</td>
                                        <td>Publish Date</td>
                                        <td>Message To</td>
                                        <td>Created By</td>
                                        <td>Created Date</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->notice_date)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->publish_date)) }}</td>
                                            <td>
                                                @foreach ($value->getMessage as $message)
                                                    @if ($message->message_to == 2)
                                                        <span style="color: rgb(21, 127, 233);">Teacher</span>
                                                    @elseif($message->message_to == 3)
                                                        <span style="color: rgb(28, 233, 21);">Student</span>
                                                    @elseif($message->message_to == 4)
                                                        <span style="color: rgb(233, 70, 21);">Parent</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('backend/admin/communicate/notice_board/edit/'.$value->id) }}" class="btn btn-info">
                                                  <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('backend/admin/communicate/notice_board/delete/'.$value->id) }}" class="btn btn-danger">
                                                  <i class="fa fa-trash"></i>
                                                </a>
                                              </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection