@extends('backend.layouts.app')
@section('content')  
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Submitted Homework</h1>
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
                      <h3 class="card-title">Search Student Submitted Homework</h3>
                    </div>
                    <form action="" method="get">
                      <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label>Class</label>
                            <input type="text" value="{{ Request::get('class_name') }}" name="class_name" class="form-control" placeholder="Class Name">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Subject</label>
                            <input type="text" value="{{ Request::get('subject_name') }}" name="subject_name" class="form-control" placeholder="Subject Name">
                          </div>

                          <div class="form-group col-md-3">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" placeholder="Date">
                          </div>
      
                          <div class="form-group col-md-3">
                            <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                            <a href="{{ url('backend/parent/my_student/submitted_homework/'.$getStudent->id) }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                                <h3 class="card-title">Student Submitted Homework List</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <td>#</td>
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