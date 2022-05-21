@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sub Category List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Category Name</th>
                                            <th  class="text-center">Sub Category Name</th>
                                            <th  class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $item)
                                            <tr>
                                                <td  class="text-center">{{ $item['category']['category_name_en'] }}</td>
                                                <td  class="text-center">{{ $item->subcategory_name_en }}</td>
                                                <td class="text-center"  width="30%">
                                                    <a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                    &nbsp;
                                                    <a href="{{route('subcategory.delete',$item->id)}}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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
                            <h3 class="box-title">Add Sub Categories </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('subcategory.store') }}" >
                                    @csrf
                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
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
                                                <h5>Sub Category Name Englash <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subcategory_name_en" class="form-control">
                                                    @error('subcategory_name_en')
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
