@extends('backend.layouts.app')
@section('content')  
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Homework Report</h1>
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
                      <h3 class="card-title">Search Homework Report</h3>
                    </div>
                    <form action="" method="get">
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Student First Name</label>
                            <input type="text" value="{{ Request::get('first_name') }}" name="first_name" class="form-control" placeholder="Student First Name">
                          </div>
                          <div class="form-group col-md-3">
                            <label>Student Last Name</label>
                            <input type="text" value="{{ Request::get('last_name') }}" name="last_name" class="form-control" placeholder="Student Last Name">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Class</label>
                            <input type="text" value="{{ Request::get('class_name') }}" name="class_name" class="form-control" placeholder="Class Name">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Subject</label>
                            <input type="text" value="{{ Request::get('subject_name') }}" name="subject_name" class="form-control" placeholder="Subject Name">
                          </div>

                          <div class="form-group col-md-3">
                            <label>From Homework Date</label>
                            <input type="date" name="from_homework_date" value="{{ Request::get('from_homework_date') }}" class="form-control">
                          </div>
                          <div class="form-group col-md-3">
                            <label>To Homework Date</label>
                            <input type="date" name="to_homework_date" value="{{ Request::get('to_homework_date') }}" class="form-control">
                          </div>

                          <div class="form-group col-md-3">
                            <label>From Submission Date</label>
                            <input type="date" name="from_submission_date" value="{{ Request::get('from_submission_date') }}" class="form-control">
                          </div>
                          <div class="form-group col-md-3">
                            <label>To Submission Date</label>
                            <input type="date" name="to_submission_date" value="{{ Request::get('to_submission_date') }}" class="form-control">
                          </div>

                          <div class="form-group col-md-3">
                            <label>From Created Date</label>
                            <input type="date" name="from_created_date" value="{{ Request::get('from_created_date') }}" class="form-control">
                          </div>
                          <div class="form-group col-md-3">
                            <label>To Created Date</label>
                            <input type="date" name="to_created_date" value="{{ Request::get('to_created_date') }}" class="form-control">
                          </div>
      
                          <div class="form-group col-md-3">
                            <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                            <a href="{{ url('backend/admin/homework/homework_report') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                <div class="row">
                    <div class="col-12">
                        @include('message.message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Homework Report List</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Student Name</td>
                                        <td>Class</td>
                                        <td>Subject</td>
                                        <td>Homework Date</td>
                                        <td>Submission Date</td>
                                        <td>Document</td>
                                        <td>Description</td>
                                        <td>Created Date</td>

                                        <td>Submitted Document</td>
                                        <td>Submitted Description</td>
                                        <td>Submitted Created Date</td>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                        <td>{{ $value->class_name }}</td>
                                        <td>{{ $value->subject_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->getHomework->homework_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->getHomework->submission_date)) }}</td>
                                        <td>
                                            @if(!empty($value->getHomework->getDocument()))
                                                <a href="{{ $value->getHomework->getDocument() }}" class="btn btn-primary" download="">Download</a>
                                            @endif
                                        </td>
                                        <td>{!! $value->getHomework->description !!}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->getHomework->created_at)) }}</td>

                                        <td>
                                            @if(!empty($value->getDocument()))
                                                <a href="{{ $value->getDocument() }}" class="btn btn-primary" download="">Download</a>
                                            @endif
                                        </td>
                                        <td>{!! $value->description !!}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
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