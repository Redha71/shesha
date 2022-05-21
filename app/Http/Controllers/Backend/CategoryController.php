<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{

    public function categoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }
    public function categoryStore(Request $request)
    {
        $request->validate(
            [
                'category_name_en' => 'required',
                'category_image' => 'required',
            ],
            [
                'category_name_en.required' => 'Input Category English Name',
            ]
        );
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/category_images/' . $name_gen);
        $save_url = 'upload/category_images/' . $name_gen;
        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_image' =>$save_url
        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }
    public function categoryUpdate(Request $request)
    {
        $request->validate(
            [
                'category_name_en' => 'required',
            ],
            [
                'category_name_en.required' => 'Input category English Name',
            ]
        );
        $categoryId = $request->id;
        $categoryOldImage = $request->old_image;
        if ($request->file('category_image')) {
           unlink($categoryOldImage);
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/category_images/' . $name_gen);
            $save_url = 'upload/category_images/' . $name_gen;
            Category::findOrFail($categoryId)->update([
                'category_name_en' => $request->category_name_en,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($categoryId)->update([
                'category_name_en' => $request->category_name_en,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            ]);
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
        
    }
    public function categoryDelete($id)
    {   $category = Category::findOrFail($id);
        $childSub=DB::table('child_sub_categories')->where('category_id',$id)->delete();
        $subcategory= DB::table('sub_categories')->where('category_id',$id)->delete();
        $img = $category->category_image;
        unlink($img);
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
