<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::where("status", "publish")->with('productImages', 'category', 'subcategory')->paginate(5);
        return view("product.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::where("status", "publish")->get();
        $subcategories = Subcategory::where("status", "publish")->get();
        return view("product.create", compact("categories", "subcategories"));
    }

    public function store(ProductRequest $request)
    {
        return $this->productService->store($request);
    }

    public function edit(string $id)
    {
        $product = Product::with('productImages')->find($id);
        return view('product.edit', compact("product"));
    }

    public function update(Request $request, $id)
    {
        return $this->productService->update($request, $id);
    }

    public function GetSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('cat_id', $request->id)->get();
        return response()->json($subcategories);
    }


}
