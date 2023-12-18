<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::where("status", "publish")->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view("category.create");
    }

    public function store(Request $request)
    {
        $request->validate([ 
            "name" => 'required|unique:categories|max:255'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route("category.index")->with("success");
    }
}
