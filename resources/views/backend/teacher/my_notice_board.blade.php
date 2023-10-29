@extends('backend.layouts.app')
@section('content')  
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Notice Board</h1>
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
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/teacher/my_notice_board') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
        @foreach ($getRecord as $value)
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>{{ $value->title }}</h5>
                <h6>
                  <span style="font-size: 15px; font-weight: bold; color: blue; margin-top: -20px;" 
                  class="mailbox-read-time float-right">Publish Date: {{ date('d-m-Y l', strtotime($value->publish_date)) }}
                  </span>
                  <span class="mailbox-read-time float-right">Notice Date: {{ date('d-m-Y l', strtotime($value->notice_date)) }}
                  </span>
                </h6>
              </div>
              <div class="mailbox-read-message">
                {!! $value->message !!}
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <div class="col-md-12">
          <div style="padding: 10px; float: right;">
            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
        </div>
        </div>  
      </div>
      </div>
    </section>
  </div>

@endsection