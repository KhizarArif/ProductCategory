<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::get();
        // $category = Category::find($products->cat_id)->name;
        // return view("product.index", compact("products", "category"));

        $products = Product::with('productImages')->get();
        $categoryNames = [];

        foreach ($products as $product) {
            $category = Category::find($product->cat_id);
            $categoryNames[$product->id] = $category ?? $category->name;
        }

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
        $request->validate([ 
            "name" => 'required|unique:products|max:255'
        ]);
        $product = Product::create($request->except('image'));
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->productImages()->create([
                'name' => $imagePath,
                'path' => asset('storage/' . $imagePath),
            ]); 
        }
        return redirect()->route("products.index")->with("success", "Product created Successfully!");
    }

    public function GetSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('cat_id', $request->id)->get();

        return response()->json($subcategories);
    }
}
