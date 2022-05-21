@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!-- /.col -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('category.update') }}" enctype="multipart/form-data">
                                    @csrf
                                  <input type="hidden" name="id" value="{{$category->id}}">
                                  <input type="hidden" name="old_image" value="{{$category->category_image}}">
                                            <div class="form-group">
                                                <h5>Category Name Englash <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_name_en" class="form-control" value="{{$category->category_name_en}}">
                                                    @error('category_name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="category_image" id="image" class="form-control" >
                                                </div>
                                            </div>
                                            <br/>
                                            <br/>
                                            <div class="col-md-6">
                                                <img src="{{ !empty($category->category_image)
                                                    ? url($category->category_image)
                                                    : url('upload/no_image.jpg') }}" style="width: 100px;height:100px;" id="show_image">
                                            </div>
                                            <br/>
                                            <div class="text-xs-right">
                                                 <input type="submit" class="btn btn-rounded btn-primary" value="Update Category">
                                            </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload=function(e){
                    $('#show_image').attr('src',e.target.result);

                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
