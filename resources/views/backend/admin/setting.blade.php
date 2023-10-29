@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Setting</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container">
        @include('message.message')
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <form action="" method="POST"  enctype="multipart/form-data">
                @csrf

              <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Paypal Business Email</label>
                        <input type="email" value="{{ $getRecord->paypal_email }}" name="paypal_email" required class="form-control" placeholder="Paypal Business Email">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Stripe Public Key</label>
                      <input type="text" value="{{ $getRecord->stripe_key }}" name="stripe_key" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Stripe Secret Key</label>
                      <input type="text" value="{{ $getRecord->stripe_secret }}" name="stripe_secret" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Logo</label>
                      <input type="file" class="form-control" name="logo">
                      {{-- <div style="color: red;">{{ $errors->first('profile_pic') }}</div> --}}
                      @if (!empty($getRecord->getLogo()))
                        <img src="{{ $getRecord->getLogo() }}" style="width: 100px;" alt="">
                      @endif
                    </div>
                    <div class="form-group col-md-12">
                      <label>Fevicon Icon</label>
                      <input type="file" class="form-control" name="fevicon_icon">
                      {{-- <div style="color: red;">{{ $errors->first('profile_pic') }}</div> --}}
                      @if (!empty($getRecord->getFevicon()))
                        <img src="{{ $getRecord->getFevicon() }}" style="width: 100px;" alt="">
                      @endif
                    </div>

                    <div class="form-group col-md-12">
                      <label>School Name</label>
                      <input type="text" value="{{ $getRecord->school_name }}" name="school_name" class="form-control">
                    </div>

                    <div class="form-group col-md-12">
                      <label>Exam Description</label>
                      <textarea name="exam_description" class="form-control">{{ $getRecord->exam_description }}</textarea>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  </div>

@endsection