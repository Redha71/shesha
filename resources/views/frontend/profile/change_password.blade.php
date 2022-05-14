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
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change
                            Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Change your password</h3>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.password.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title">Current Password</label>
                                    <input id="current_password" type="password" name="oldpassword" class="form-control"
                                    wire:model.defer="state.current_password" autocomplete="current-password">
                                    @error('oldpassword')
                                    <span class="invalid-feedback text-danger" role="alert"><string>* {{$message}}</string></span>
                                @enderror</div>
                                </div>
                                <div class="form-group">
                                    <label class="info-title">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                    wire:model.defer="state.password" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback text-danger" role="alert"><string>* {{$message}}</string></span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" wire:model.defer="state.password_confirmation" autocomplete="new-password">

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
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);

                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
