@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Class Timetable </h1>
          {{-- (Total: {{ $getRecord->total() }}) --}}
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $getClass->name }} - {{ $getSubject->name }} <span style="color: blue;">({{ $getStudent->name }})</span></h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>Week</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Room Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $valueW)
                                <tr>
                                    <td>{{ $valueW['week_name'] }}</td>
                                    <td>{{ !empty($valueW['start_time']) ? date('h:i A',strtotime($valueW['start_time'])) : '' }}</td>
                                    <td>{{ !empty($valueW['end_time']) ? date('h:i A',strtotime($valueW['end_time'])) : '' }}</td>
                                    <td>{{ $valueW['room_number'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>

                       
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
  </div>

@endsection
