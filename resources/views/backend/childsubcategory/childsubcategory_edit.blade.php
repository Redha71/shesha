@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

          
                <!-- /.col -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Child Sub Categories </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('childsubcategory.update') }}" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subsubcategories->id }}">
                                    <div class="form-group">
                                        <h5>Select Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control" >
                                                <option value="" selected="" disabled="">Select Your Category</option>
                                                @foreach ($category as $item)
                                                <option value="{{$item->id}}" {{$subsubcategories->category_id == $item->id ? 'selected':''}} >{{$item->category_name_en}}</option>
                                                @endforeach
                                            </select>
                                            
                                            @error('category_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Select Sub Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id"  class="form-control" >
                                                <option value="" selected="" disabled="">Select Your SubCategory</option>
                                                @foreach ($subcategory as $item)
                                                <option value="{{$item->id}}" {{$subsubcategories->subcategory_id == $item->id ? 'selected':''}} >{{$item->subcategory_name_en}}</option>
                                                @endforeach
                                            </select>
                                            
                                            @error('subcategory_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                       </div>
                                    </div>

                                            <div class="form-group">
                                                <h5>Child Sub Category Name Englash <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="childsubcategory_name_en" value="{{$subsubcategories->childsubcategory_name_en}}" class="form-control">
                                                    @error('childsubcategory_name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                          
                            
                                            <br/>
                                        


                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-primary" value="Update">
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
     $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                       var subsubcategory_id="<?php echo $subsubcategories->category_id; ?>";
                          $.each(data, function(key, value){
                              if(subsubcategory_id==value.id){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'" selected>' + value.subcategory_name_en + '</option>');
                              }else{
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'" >' + value.subcategory_name_en + '</option>');
                              }
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>
@endsection
