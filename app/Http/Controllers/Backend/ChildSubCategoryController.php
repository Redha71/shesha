<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildSubCategory;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class ChildSubCategoryController extends Controller
{
    public function childsubcategoryView()
    {
        $category = Category::orderBy('category_name_en', 'DESC')->get();
        $childsubcategories = SubSubCategory::latest()->get();
        return view('backend.childsubcategory.childsubcategory_view', compact('childsubcategories', 'category'));
    }

    public function childsubcategoryStore(Request $request)
    {

        $request->validate(
            [
                'childsubcategory_name_en' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
            ],
            [
                'childsubcategory_name_en.required' => 'Input Category English Name',
                'category_id.required' => 'Please Select Any Option',
                'subcategory_id.required' => 'Please Select Any Option'
            ]
        );

        SubSubCategory::updateOrInsert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childsubcategory_name_en' => $request->childsubcategory_name_en,
            'childsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->childsubcategory_name_en)),
        ]);
        $notification = array(
            'message' => 'Child SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function childsubcategoryEdit($id)
    {
        $subsubcategories = SubSubCategory::findOrFail($id);
        $category = Category::orderBy('category_name_en', 'DESC')->get();
        $subcategory = SubCategory::where('category_id', $subsubcategories->category_id)->orderBy('subcategory_name_en', 'DESC')->get();

        return view('backend.childsubcategory.childsubcategory_edit', compact('subsubcategories', 'subcategory', 'category'));
    }
    public function childsubcategoryUpdate(Request $request)
    {
        $request->validate(
            [
                'childsubcategory_name_en' => 'required',
            ],
            [
                'childsubcategory_name_en.required' => 'Input child Sub category English Name',
            ]
        );
        $subsubcategoryId = $request->id;
        SubSubCategory::findOrFail($subsubcategoryId)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childsubcategory_name_en' => $request->childsubcategory_name_en,
            'childsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->childsubcategory_name_en)),

        ]);
        $notification = array(
            'message' => 'ChildSubCategory Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.childsubcategory')->with($notification);
    }
    public function childsubcategoryDelete($id)
    {  
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'ChildSubCategory Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
