@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Collect Fees <span style="color: blue;">({{ $getStudent->name }} {{ $getStudent->last_name }})</span></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button type="button" id="AddFees" class="btn btn-primary">Add Fees</button>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
              @include('message.message')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment Details</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Remaining Amount</th>
                                <th>Payment Type</th>
                                <th>Remark</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse ($getFees as $value)
                              <tr>
                                <td>{{ $value->class_name }}</td>
                                <td>${{ number_format($value->total_amount, 2) }}</td>
                                <td>${{ number_format($value->paid_amount, 2) }}</td>
                                <td>${{ number_format($value->remaining_amount, 2) }}</td>
                                <td>{{ $value->payment_type }}</td>
                                <td>{{ $value->remark }}</td>
                                <td>{{ $value->created_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                              </tr>
                          @empty
                              <tr>
                                <td colspan="100%">Record Not Found</td>
                              </tr>
                          @endforelse
                        </tbody>
                        </table>
                       
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
</div>

{{-- Modal --}}
<div class="modal fade" id="AddFeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label">Class Name : {{ $getStudent->class_name }}</label>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Total Amount : ${{ number_format($getStudent->amount, 2) }}</label>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Paid Amount : ${{ number_format($paid_amount, 2) }}</label>
                </div>
                <div class="form-group">
                    @php
                        $RemainingAmount = $getStudent->amount - $paid_amount;
                    @endphp
                    <label class="col-form-label">Remaining Amount : ${{ number_format($RemainingAmount, 2) }}</label>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Amount <span style="color: red;">*</span></label>
                    <input type="number" class="form-control" name="amount">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Payment Type <span style="color: red;">*</span></label>
                    <select name="payment_type" required class="form-control">
                        <option value="">Select</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Remark</label>
                    <textarea class="form-control" name="remark"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- End Modal --}}
@endsection

@section('script')
<script type="text/javascript">
    $('#AddFees').click(function() {
        $('#AddFeesModal').modal('show');
    });
</script>
@endsection