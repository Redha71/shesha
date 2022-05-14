@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br />
                    <img class="card-img-top" style="border-radius: 50% "
                        src="{{ !empty($user->profile_photo_path)
                            ? url('upload/user_images/' . $user->profile_photo_path)
                            : url('upload/no_image.jpg') }}"
                        height="100%" width="100%">
                    <ul class="list-group list-group-flush">
                        <br /><br />
                        <a href="{{route('user.dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                        <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi....</span><strong></strong>{{ Auth::user()->name }} Update your
                            profile</h3>
                        <div class="card-body">
                            <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title">Name</label>
                                    <input type="text" name="name"  class="form-control" value="{{$user->name}}" required >
                                </div>
                                <div class="form-group">
                                    <label class="info-title">Email</label>
                                    <input type="email" name="email"  class="form-control" value="{{$user->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="info-title">Phone</label>
                                    <input type="text" name="phone"  class="form-control" value="{{$user->phone}}"  >
                                </div>
                                <div class="form-group">
                                    <label class="info-title">User Image</label>
                                    <input type="file" name="profile_photo_path" id="image"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <img src="{{ !empty($user->profile_photo_path)
                                        ? url('upload/user_images/' . $user->profile_photo_path)
                                        : url('upload/no_image.jpg') }}" style="width: 100px;height:100px;" id="show_image">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
