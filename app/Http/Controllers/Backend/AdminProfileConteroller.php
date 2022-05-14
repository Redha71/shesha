<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileConteroller extends Controller
{
    public function adminProfile()
    {
        $adminId =Auth::guard('admin')->id();
        $adminData = Admin::find($adminId);
        return view('admin.admin_profile_view',compact('adminData'));
    }//end method
    public function adminProfileEdit()
    {
        $adminId =Auth::guard('admin')->id();
        $adminData = Admin::find($adminId);
        return view('admin.admin_profile_edit',compact('adminData'));
    }//end method
    public function adminProfileStore(Request $request)
    {
        $adminId =Auth::guard('admin')->id();
        $data = Admin::find($adminId);
        $data->name = $request->name;
        $data->email=$request->email;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $fileName =date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$fileName);
            $data['profile_photo_path']=$fileName;
          }

        $data->save();
        $notification=array(
            'message'=> 'Admin Profile Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }//end method
    public function adminChangePassword()
    {
        return view('admin.admin_Change_password');
    }
    public function adminUpdateChangePassword(Request $request)
    {
        $validateData= $request->validate([
            'oldpassword' =>'required',
            'password'=>'required|confirmed'
        ]);
        $adminId =Auth::guard('admin')->id();
        $hashedPassword = Admin::find($adminId)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find($adminId);
            $admin->password =Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }
    }
}
