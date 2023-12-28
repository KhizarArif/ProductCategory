<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
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

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|unique:products|max:255',
            "price" => "required",
            "qty" => "required",
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->price  = $request->price;
        $product->qty  = $request->qty;
        $product->status  = $request->status;
        $product->save();
        $files = $request->file('files');
        foreach ($files as $file) {
            $destinationPath = storage_path("app\public\upload");
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalName . '-' . uniqid() . "." . $extension;
            $file->move($destinationPath, $fileName);
            ProductImage::create([
                "name" => $fileName,
                "path" => "upload" . "/" . $fileName,
                "products_id" => $product->id,
            ]);
        }
        return redirect()->back()->with('message', 'File uploaded.');
    }

    public function GetSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('cat_id', $request->id)->get();
        return response()->json($subcategories);
    }

    public function edit(string $id)
    {
        $product = Product::with('productImages')->find($id);
        return view('product.edit', compact("product"));
    }

    public function update(Request $request, $id)
    {   
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->status = $request->status;
        $product->save();


        if (isset($request->files)) {
        
            foreach ($request->files->get('files') as $img_id => $file) {
               
                $productImage = ProductImage::find($img_id);
                if ($productImage) {
                    $destinationPath = storage_path("app\public\upload");
                    $extension = $file->getClientOriginalExtension();
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $originalName . '-' . uniqid() . "." . $extension;
                    $file->move($destinationPath, $fileName);
                    $productImage->update([
                        "name" => $fileName,
                        "path" => "upload" . "/" . $fileName,
                    ]);
                }
            }
            return redirect()->route('products.index')->with('message', 'Updated Successfully!');
        }
    }
}
