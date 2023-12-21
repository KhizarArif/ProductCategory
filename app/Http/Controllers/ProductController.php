<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where("status", "publish")->with('productImages', 'category', 'subcategory')->get();
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
}



// $imageName = time().'.'.$request->image->extension(); 
// $imagePath = $request->file('image')->store('images', 'public');
// $imagePath = $request->image->move(public_path('images'), $imageName);
// $product->productImages()->create([
//     'name' => $request->name,
//     'path' => $imagePath,
// ]); 



// $files = $request->file('files');
//             foreach ($files as $key => $file) {
//                 if($file->isValid()) {
//                     $destinationPath = storage_path('uploads');
//                     $extension       = $file->getClientOriginalExtension();
//                     $originalName    = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//                     $fileName        = $originalName . '-' . uniqid() . '.' . $extension;
//                     $file->move($destinationPath, $fileName);
//                     ProductImage::create([
//                         "name" => $fileName ,
//                         "path" => "uploads" . "/" . $fileName,
//                         "products_id" => $product->id
//                     ]);
//                 }
//             }