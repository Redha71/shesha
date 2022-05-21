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
                            <h3 class="box-title">Edit Sub Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('subcategory.update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $subcategories->id }}">
                                    <div class="form-group">
                                        <h5>Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control">
                                                <option value="" selected="" disabled="">Select Your Category</option>
                                                @foreach ($category as $item)
                                                    <option  value="{{ $item->id }}" {{ $item->id==$subcategories->category_id ? "selected": ""}} >{{ $item->category_name_en }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Sub Category Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" class="form-control"
                                                value="{{ $subcategories->subcategory_name_en }}">
                                            @error('subcategory_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br />
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary"
                                            value="Update Sub Category">
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
@endsection
