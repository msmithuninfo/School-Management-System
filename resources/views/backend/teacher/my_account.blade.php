@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Account</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('backend/admin/teacher/list') }}" class="btn btn-primary">Teacher List</a></li>
          </ol>
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
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name <span style="color: red;">*</span></label>
                        <input type="text" value="{{ old('name', $getRecord->name) }}" name="name" required class="form-control" placeholder="First Name">
                        <div style="color: red;">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <span style="color: red;">*</span></label>
                        <input type="text" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required class="form-control" placeholder="Last Name">
                        <div style="color: red;">{{ $errors->first('last_name') }}</div>
                    </div>

                  
                    <div class="form-group col-md-6">
                        <label>Gender <span style="color: red;">*</span></label>
                        <select name="gender" required class="form-control">
                            <option value="">Select Gender</option>
                            <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                            <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                            <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                        </select>
                        <div style="color: red;">{{ $errors->first('gender') }}</div>

                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Birth <span style="color: red;">*</span></label>
                        <input type="date" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" name="date_of_birth" required class="form-control">
                        <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>

                    </div>
                   
                    <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="text" value="{{ old('mobile_number', $getRecord->mobile_number) }}" name="mobile_number" class="form-control" placeholder="Mobile Number">
                        <div style="color: red;">{{ $errors->first('mobile_number') }}</div>

                    </div>
                  
                    
                    <div class="form-group col-md-6">
                        <label>Profile Pic</label>
                        <input type="file" class="form-control" name="profile_pic">
                        <div style="color: red;">{{ $errors->first('profile_pic') }}</div>
                      @if (!empty($getRecord->getProfile()))

                        <img src="{{ $getRecord->getProfile() }}" style="width: 100px;" alt="">

                      @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Blood Group</label>
                        <input type="text" value="{{ old('blood_group', $getRecord->blood_group) }}" name="blood_group" class="form-control" placeholder="Blood Group">
                        <div style="color: red;">{{ $errors->first('blood_group') }}</div>

                    </div>
                    <div class="form-group col-md-6">
                      <label>Height</label>
                      <input type="text" value="{{ old('height', $getRecord->height) }}" name="height" class="form-control" placeholder="Height">
                      <div style="color: red;">{{ $errors->first('height') }}</div>

                  </div>
                  <div class="form-group col-md-6">
                    <label>Weight</label>
                    <input type="text" value="{{ old('weight', $getRecord->weight) }}" name="weight" class="form-control" placeholder="Weight">
                    <div style="color: red;">{{ $errors->first('weight') }}</div>

                </div>
                <div class="form-group col-md-6">
                    <label>Email address <span style="color: red;">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $getRecord->email) }}" required class="form-control" placeholder="Enter email">
                    <div style="color:red;">{{ $errors->first('email') }}</div>
                  </div>
                    
                </div>
                

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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