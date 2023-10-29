@extends('backend.layouts.app')
@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Subject </h1>
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
              @include('message.message')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Subject</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($getRecord as $value)
                          <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->subject_name }}</td>
                            <td>{{ $value->subject_type }}</td>
                            
                          </tr>
                          @endforeach
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

@endsection