<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addform()
    {
        return view('backend.admin.category.addform');
    }

    //insert category by ajax
    public function addcategory(Request $request)
    {
        Category::insert([
            'name'=>$request->categoryname
        ]);
        //return response('saved');

        return response()->json('saved');

        // return response()->json(array(
        //     'product' => $product,
        //     'color' => $product_color,
        //     'size' => $produt_size,
        // ));
    }
    //view category by ajax
    public function viewcategory()
    {
        $categories = Category::latest()->get();
        return response()->json($categories);
    }

    //edit category by ajax
    public function editcategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    //update category by ajax
    public function updatecategory(Request $request,$id)
    {
        Category::findOrFail($id)->update([
            'name'=>$request->categoryname,
        ]);
        return response()->json('updated');
    }

    //delete category by ajax
    public function deletecategory($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json('deleted');
    }



}
