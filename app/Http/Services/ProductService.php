<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductService
{
    public function store(Request $request)
    {
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

        return redirect()->route('products.index')->with('message', 'Product Added Successfully!. ');
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
