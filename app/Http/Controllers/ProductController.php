<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view("product.index");
    }

    public function create()
    {
        $categories = Category::where("status", "publish")->get();
        $subcategories = Subcategory::where("status", "publish")->get();
        return view("product.create", compact("categories", "subcategories"));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('cat_id', $categoryId)->get();

        return response()->json(['subcategories' => $subcategories]);
    }
}
