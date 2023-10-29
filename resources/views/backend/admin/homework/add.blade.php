@extends('backend.layouts.app')
@section('style')
  
@endsection
@section('content')  
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Homework</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  @include('message.message')
                    <div class="card card-primary card-outline">
                      <form action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                              <label>Class <span style="color: red;">*</span></label>
                              <select name="class_id" id="getClass" required class="form-control">
                                <option value="">Select Class </option>
                                @foreach ($getClass as $class)
                                    <option value="{{ $class->id }}"> {{ $class->name }} </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label>Subject <span style="color: red;">*</span></label>
                                <select name="subject_id" id="getSubject" required class="form-control">
                                    <option value="">Select Subject </option>
                                  </select>
                              </div>
                              <div class="form-group">
                                <label>Homework Date  <span style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="homework_date" required>
                              </div>
                              <div class="form-group">
                                <label>Submission Date <span style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="submission_date" required>
                              </div>

                              <div class="form-group">
                                <label>Document <span style="color: red;">*</span></label>
                                <input type="file" class="form-control" name="document_file">
                              </div>


                              <div class="form-group">
                                    <label>Description <span style="color: red;">*</span></label>
                                  <textarea id="compose-textarea" required name="description" class="form-control" style="height: 300px">
                                    
                                  </textarea>
                              </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                          
                        </div>
                      </form>
                      </div>
                </div>
              </div>
            </div>
          </section>
    </div>

@endsection

@section('script')
<script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $(function () {

        $('#compose-textarea').summernote({
            height: 150,
            codemirror: {
                theme: 'monokai'
            }
        });

        $('#getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                type: 'post',
                url: '{{ url('backend/admin/ajax_get_subject') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    class_id: class_id,
                },
                dataType: 'json',
                success: function(data) {
                  $('#getSubject').html(data.success);
                }
            });
        });

  });
</script>
@endsection