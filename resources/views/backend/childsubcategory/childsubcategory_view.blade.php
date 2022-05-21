@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Child Sub Category List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Category Name</th>
                                            <th  class="text-center">Sub Category Name</th>
                                            <th  class="text-center">Child Sub Category Name</th>
                                            <th  class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($childsubcategories as $item)
                                            <tr>
                                                <td  class="text-center">{{ $item['category']['category_name_en'] }}</td>
                                                <td  class="text-center">{{ $item['subcategory']['subcategory_name_en'] }}</td>
                                                <td  class="text-center">{{ $item->childsubcategory_name_en }}</td>
                                                <td class="text-center"  width="30%">
                                                    <a href="{{route('childsubcategory.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                    &nbsp;
                                                    <a href="{{route('childsubcategory.delete',$item->id)}}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Child Sub Categories </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('childsubcategory.store') }}" >
                                    @csrf
                                    <div class="form-group">
                                        <h5>Select Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control" >
                                                <option value="" selected="" disabled="">Select Your Category</option>
                                                @foreach ($category as $item)
                                                <option value="{{$item->id}}" >{{$item->category_name_en}}</option>
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
                                              
                                            </select>
                                            
                                            @error('subcategory_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                       </div>
                                    </div>

                                            <div class="form-group">
                                                <h5>Sub Category Name Englash <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="childsubcategory_name_en" class="form-control">
                                                    @error('childsubcategory_name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                          
                            
                                            <br/>
                                        


                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-primary" value="Add New">
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
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
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
