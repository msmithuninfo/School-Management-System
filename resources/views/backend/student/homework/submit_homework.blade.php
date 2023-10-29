@extends('backend.layouts.app')
@section('style')
  
@endsection
@section('content')  
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Submit Homework</h1>
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

  });
</script>
@endsection