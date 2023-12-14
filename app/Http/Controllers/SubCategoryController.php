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

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'status' => 'required|in:draft,publish',
        ]);

        $category = Category::findOrFail($request->category_id);

        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;

        $category->subcategories()->save($subcategory);

        return redirect()->route("subcategory.index")->with("success", "Subcategory created successfully!");
    }
}
