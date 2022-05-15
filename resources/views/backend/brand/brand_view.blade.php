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
                            <h3 class="box-title">Brand List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th  class="text-center">Brand Name En</th>
                                            <th  class="text-center">Image</th>
                                            <th  class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $item)
                                            <tr>
                                                <td  class="text-center">{{ $item->brand_name_en }}</td>
                                                <td  class="text-center"><img src="{{ asset($item->brand_image) }}"
                                                        style="width: 70px;height:40px; ;"></td>
                                                <td class="text-center">
                                                    <a href="{{route('brand.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                    &nbsp;
                                                    <a href="{{route('brand.delete',$item->id)}}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
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
                            <h3 class="box-title">Add Brand </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                    @csrf
                                  

                                            <div class="form-group">
                                                <h5>Brand Name Englash <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="brand_name_en" class="form-control">
                                                    @error('brand_name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                          
                                            <div class="form-group">
                                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="brand_image" id="image" class="form-control">
                                                    @error('brand_image')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="col-md-6">
                                                <img src="{{  url('upload/no_image.jpg') }}" style="width: 100px;height:100px;" id="show_image">
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
