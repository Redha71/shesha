<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }
    public function userLogout()
    {
        Auth::logout();
        return Redirect()->route('home');
    }
    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }
    public function userProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            if (public_path('upload/user_images/' . $data->profile_photo_path)) {
                @unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            }
            $fileName = date('Ymdhi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }

        $data->save();
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.dashboard')->with($notification);
    }
    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    }
    public function userPasswordUpdate(Request $request)
    {
        $validateData= $request->validate([
            'oldpassword' =>'required',
            'password'=>'required|confirmed'
        ]);
        $hashedPassword =Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = User::find(Auth::user()->id);
            $admin->password =Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }
}
