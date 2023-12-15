<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::get();
        $category = Category::find($products->cat_id)->name;
        return view("product.index", compact("products", "category"));
    }

    public function create()
    {
        $categories = Category::where("status", "publish")->get();
        $subcategories = Subcategory::where("status", "publish")->get();
        return view("product.create", compact("categories", "subcategories"));
    }

    public function store(Request $request)
    {
        $abc = Products::create($request->all());
        dd($abc);
        return redirect()->route("products.index")->with("success", "Product created Successfully!");
    }




    public function GetSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('cat_id', $request->id)->get();

        return response()->json($subcategories);
    }
}
