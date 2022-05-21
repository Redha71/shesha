<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildSubCategory;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function subcategoryView()
    {
        $category = Category::orderBy('category_name_en','DESC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_view', compact('subcategories','category'));
    }
    public function subcategoryStore(Request $request)
    {
        $request->validate(
            [
                'subcategory_name_en' => 'required',
                'category_id'=>'required',
            ],
            [
                'subcategory_name_en.required' => 'Input Category English Name',
                'category_id.required'=>'Please Seklect Any Option'
            ]
        );
        SubCategory::insert([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'category_id'=>$request->category_id,
        ]);
        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function subcategoryEdit($id)
    {
        $category = Category::orderBy('category_name_en','DESC')->get();
        $subcategories = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('subcategories','category'));
    }
    public function subcategoryUpdate(Request $request)
    {
        $request->validate(
            [
                'subcategory_name_en' => 'required',
            ],
            [
                'subcategory_name_en.required' => 'Input Sub category English Name',
            ]
        );
        $subcategoryId = $request->id;
// dd($request->category_id);
// exit;
        SubCategory::findOrFail($subcategoryId)->update([
            'category_id' => intval($request->category_id),
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            
        ]);
        $notification = array(
            'message' => 'SubCategory Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
        
    }
    public function subcategoryDelete($id)
    {  
        SubCategory::findOrFail($id)->delete();
        $childSub=DB::table('child_sub_categories')->where('subcategory_id',$id)->delete();
        $notification = array(
            'message' => 'SubCategory Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function childsubcategoryView()
    {
        $category = Category::orderBy('category_name_en','DESC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_view', compact('subcategories','category'));
    }
    public function getSubCategory($category_id)
    {
        $childSub=DB::table('child_sub_categories')->where('category_id',$category_id)->delete();
        $subcat=SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','DESC')->get();
        return json_encode($subcat);
    }

   
}
