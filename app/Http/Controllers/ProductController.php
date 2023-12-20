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
        dd($request);
        $request->validate([
            "name" => 'required|unique:products|max:255'
        ]);
        $product = Product::create();

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $key => $file) {
                $imageName = time() . '.' . $file->extension();
                $imagePath = $file->store('images', 'public');
                if ($file->isValid()) {
                    $product->productImages()->create([
                        'name' => $imageName,
                        'path' => $imagePath
                    ]);
                }
            }
        }
        dd($product);
        // return redirect()->route("products.index")->with("success", "Product created Successfully!");
        return $product;
    }

    public function GetSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('cat_id', $request->id)->get();
        return response()->json($subcategories);
    }
}



// $imageName = time().'.'.$request->image->extension(); 
// $imagePath = $request->file('image')->store('images', 'public');
// $imagePath = $request->image->move(public_path('images'), $imageName);
// $product->productImages()->create([
//     'name' => $request->name,
//     'path' => $imagePath,
// ]); 