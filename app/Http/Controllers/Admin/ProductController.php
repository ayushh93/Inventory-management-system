<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session
        Session::put('admin_page', 'product');
        //
        $product = Product::all();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page', 'product');
        //
        $categories = Category::where('parent_id', null)->where('status', 1)->orderby('category_name', 'asc')->get();
        $brands = Brand::where('status', 1)->orderby('brand_name', 'asc')->get();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $validateData = $request->validate([
            'product_name' => 'required|max:40|min:4',
            'price' => 'required | numeric | digits_between:1,10 ',
        ]);
        $product = new Product();
        if (empty($data['category_id'])) {
            $product->category_id = NULL;
        } else {
            $product->category_id = $data['category_id'];
        }
        if (empty($data['brand_id'])) {
            $product->brand_id = NULL;
        } else {
            $product->brand_id = $data['brand_id'];
        }
        $product->product_name = $data['product_name'];
        $product->slug = Str::slug($data['product_name']);
        $product->price = $data['price'];
        //upload featured product image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('uploads/product');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $product->featured_image = $filename;
        }
        $product->excerpt = $data['excerpt'];
        $product->description = $data['description'];
        if (empty($data['status'])) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        if (empty($data['featured_product'])) {
            $product->featured_product = 0;
        } else {
            $product->featured_product = 1;
        }

        $status =  $product->save();
        if ($status) {
            Session::flash('success_message', 'Product Has Been Added Successfully');
        } else
            Session::flash('error_message', 'Product could not be added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //session
        Session::put('admin_page', 'product');
        //
        $product = Product::findorfail($id);
        $productDetails = Product::with('productattribute')->where(['id' => $id])->first();
        $productImages = Product::with('productImage')->where(['id' => $id])->first();
        return view('admin.product.show', compact('product', 'productDetails', 'productImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //session
        Session::put('admin_page', 'product');
        //
        $categories = Category::where('parent_id', null)->where('status', 1)->orderby('category_name', 'asc')->get();
        $brands = Brand::where('status', 1)->orderby('brand_name', 'asc')->get();
        $product = Product::findorfail($id);
        return view('admin.product.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $validateData = $request->validate([
            'product_name' => 'required|max:40|min:4',
            'price' => 'required | numeric | digits_between:1,10 ',
        ]);
        $product = Product::findorfail($id);
        if (empty($data['category_id'])) {
            $product->category_id = NULL;
        } else {
            $product->category_id = $data['category_id'];
        }
        if (empty($data['brand_id'])) {
            $product->brand_id = NULL;
        } else {
            $product->brand_id = $data['brand_id'];
        }
        $product->product_name = $data['product_name'];
        $product->slug = Str::slug($data['product_name']);
        $product->price = $data['price'];
        //upload featured product image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('uploads/product');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $product->featured_image = $filename;
            //delete previous image from folder
            $image_path = 'uploads/product/';
            if (!empty($data['current_image'])) {
                if (file_exists($image_path . $data['current_image'])) {
                    unlink($image_path . $data['current_image']);
                }
            }
        }
        $product->excerpt = $data['excerpt'];
        $product->description = $data['description'];
        if (empty($data['status'])) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        if (empty($data['featured_product'])) {
            $product->featured_product = 0;
        } else {
            $product->featured_product = 1;
        }

        $status =  $product->save();
        if ($status) {
            Session::flash('success_message', 'Product Has Been updated Successfully');
        } else
            Session::flash('error_message', 'Product could not be updated');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findorfail($id);
        //delete previous image from folder
        $image_path = 'uploads/product/';
        if (!empty($product->featured_image)) {
            if (file_exists($image_path . $product->featured_image)) {
                unlink($image_path . $product->featured_image);
            }
        }
        //product gallery delete from folder
        $gallery_path = 'uploads/product/gallery/';
        if (count($product->productImage)) {
            $images = $product->productImage;
            foreach ($images as $image) {
                if (file_exists($gallery_path . $image->image)) {
                    unlink($gallery_path . $image->image);
                }
            }
        }


        $status =  $product->delete();
        if ($status) {
            Session::flash('success_message', 'Product Has Been deleted Successfully');
        } else
            Session::flash('error_message', 'Product could not be deleted');
        return redirect()->back();
    }

    public function productIn()
    {
         //session
         Session::put('admin_page', 'productIn');
         //
         $product = ProductAttribute::orderby('SKU', 'asc')->get();
        return view('admin.product.productIn',compact('product'));
    }
    public function addStock(Request $request, $id)
    {
        $product = ProductAttribute::findorfail($id);
        $validateData = $request->validate([
            'stock_add' => 'required|numeric',
        ]);
        $product->stock  =  $product->stock + $request->input('stock_add');
        $status = $product->save();
        if ($status) {
            Session::flash('success_message', 'Product stock Has Been updated Successfully');
        } else
            Session::flash('error_message', 'Product stock could not be updated');
        return redirect()->back();
    }
    public function productOut()
    {
         //session
         Session::put('admin_page', 'productOut');
         //
         $product = ProductAttribute::orderby('SKU', 'asc')->get();
        return view('admin.product.productOut',compact('product'));
    }
    public function removeStock(Request $request, $id)
    {
        $product = ProductAttribute::findorfail($id);
        $validateData = $request->validate([
            'stock_remove' => 'required|numeric',
        ]);
        $product->stock  =  $product->stock - $request->input('stock_remove');
        $status = $product->save();
        if ($status) {
            Session::flash('success_message', 'Product stock Has Been updated Successfully');
        } else
            Session::flash('error_message', 'Product stock could not be updated');
        return redirect()->back();
    }

}
