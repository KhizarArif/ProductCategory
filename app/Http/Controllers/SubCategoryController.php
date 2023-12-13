<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::get();

        return view('subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        return view("subcategory.create");
    }

    public function store(Request $request, $id)
    {
        $category = Category::find($id);
        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->cat_id = $request->cat_id;
        $subcategory->status = $request->status;
        $subcategory->save();
        $category->subcategory()->save($subcategory);

        return redirect()->route("subcategory.index")->with("success");
    }
}
