<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    //
    public function addAttribute($id)
    {
        $product = Product::findorfail($id);
        $productDetails = Product::with('productattribute')->where(['id' => $id])->first();
        return view('admin.product.addattribute',compact('product','productDetails'));
    }
    public function storeattribute(Request $request)
    {
        // $validateData = $request->validate([
        //     'sku[]' => 'required|max:40|min:4',
        //     'price[]' => 'required | numeric | digits_between:1,10 ',
        //     'stock[]' => 'required|numeric',
        //     'low_stock[]' => 'required|numeric'

        // ]);
        $data = $request->all();
        foreach($data['sku'] as $key => $val){
            if(!empty($val)){
                // Checking if SKU Duplication Exists or Not
                $attrCountSKU = ProductAttribute::where('sku', $val)->count();
                if($attrCountSKU > 0){
                    return redirect()->back()->with('error_message', 'Product SKU Already Exist in our Database');
                }
                $attribute = new ProductAttribute();
                $attribute->product_id = $data['product_id'];
                $attribute->sku = $val;
                $attribute->size = $data['size'][$key];
                $attribute->color = $data['color'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->low_stock = $data['low_stock'][$key];
                $attribute->save();
            }
        }
        Session::flash('success_message', 'Product Attribute Has Been Added Successfully');
        return redirect()->back();

    }

    public function updateAttribute(Request $request, $id)
    {
        $data = $request->all();
        foreach($data['idAttr'] as $key => $attr){
            ProductAttribute::where('id', $data['idAttr'][$key])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key], 'sku' => $data['sku'][$key] ,  'size' => $data['size'][$key],  'color' => $data['color'][$key],'low_stock' => $data['low_stock'][$key]]);
        }
        Session::flash('success_message', 'Product Attribute Has Been updated Successfully');
        return redirect()->back();
    }
    public function deleteAttribute($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->delete();
        Session::flash('success_message', 'Product Attribute Has Been deleted Successfully');
        return redirect()->back();
    }

    //for images
    public function addImage($id)
    {
        $product = Product::findorfail($id);
        $productImages = Product::with('productImage')->where(['id'=> $id])->first();
        return view('admin.product.addImage',compact('product','productImages'));

    }

    public function storeImage(Request $request)
    {
        $data = $request->all();
         //upload product images
         if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach($files as $file)
            {
            $productimage = new ProductImage();
            $filename = rand(11,9999) . '.' . $file->extension();
            $destinationPath = public_path('uploads/product/gallery');
            $img = Image::make($file->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $productimage->image = $filename;
            $productimage->product_id =$data['product_id'];
            $productimage->save();
        }
        }
        Session::flash('success_message', 'Product Images Has Been Added Successfully');
        return redirect()->back();

    }
    public function deleteImage($id)
    {
        $product_image = ProductImage::findorfail($id);
        $image_path = 'uploads/product/gallery/';
        if (!empty($product_image->image)) {
            if (file_exists($image_path . $product_image->image)) {
                unlink($image_path . $product_image->image);
            }
        }
        $product_image->delete();
        Session::flash('success_message', 'Product Image Has Been deleted Successfully');
        return redirect()->back();
    }
}
