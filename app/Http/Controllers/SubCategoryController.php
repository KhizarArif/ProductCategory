<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where("status", "publish")->get();
        return view('subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::where("status", "publish")->get();
        // dd($categories);
        return view("subcategory.create", compact("categories"));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // $category = Category::find($request->cat_id);
        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;
        $subcategory->cat_id = $request->cat_id;
        $subcategory->save();
        // $category->subcategories()->save($subcategory);


        return redirect()->route("subcategory.index")->with("success");
    }
}