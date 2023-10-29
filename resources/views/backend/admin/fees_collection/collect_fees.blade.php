@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Collect Fees </h1>
          {{-- (Total: {{ $getRecord->total() }}) --}}
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
                <h3 class="card-title">Search Class</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-3">
                      <label>Class Name</label>
                      <select name="class_id" id="" class="form-control">
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Student ID</label>
                      <input type="text" value="{{ Request::get('student_id') }}" name="student_id" class="form-control" placeholder="Student ID">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Student First Name</label>
                      <input type="text" value="{{ Request::get('first_name') }}" name="first_name" class="form-control" placeholder="Student First Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Student Last Name</label>
                      <input type="text" value="{{ Request::get('last_name') }}" name="last_name" class="form-control" placeholder="Student Last Name">
                    </div>


                    <div class="form-group col-md-3">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;" >Search</button>
                      <a href="{{ url('backend/admin/fees_collection/collect_fees') }}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                        <h3 class="card-title">Student List</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th> ID</th>
                            <th>Student Name</th>
                            <th>Class Name</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Remaining Amount</th>
                            <th>Created Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if (!empty($getRecord))
                            @forelse ($getRecord as $value)
                            @php
                              $paid_amount = $value->getPaidAmount($value->id, $value->class_id);
                              $RemainingAmount = $value->amount - $paid_amount;
                            @endphp
                              <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>${{ number_format($value->amount,2) }}</td>
                                <td>${{ number_format($paid_amount,2) }}</td>
                                <td>
                                  {{-- ${{ number_format($RemainingAmount,2) }} --}}
                                  @if ($RemainingAmount > 0)
                                    <span style="color: red;">${{ number_format($RemainingAmount,2) }}</span>
                                  @elseif ($RemainingAmount == 0)
                                    <span style="color: green;">${{ number_format($RemainingAmount,2) }}</span>
                                  @endif
                                </td>
                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                <td>
                                  <a href="{{ url('backend/admin/fees_collection/collect_fees/add_fees/'.$value->id) }}" class="btn btn-info">
                                    Collect Fees
                                  </a>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="100%">Record Not Found</td>
                              </tr>
                            @endforelse
                          @else
                            <tr>
                              <td colspan="100%">Record Not Found</td>
                            </tr>
                          @endif
                        </tbody>
                        </table>
                        <div style="padding: 10px; float: right;">
                          @if (!empty($getRecord))
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                          @endif
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