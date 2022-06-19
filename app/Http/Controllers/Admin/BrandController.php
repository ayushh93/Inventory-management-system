<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session
        Session::put('admin_page','brand');
        //
        $brand = Brand::all();
        return view('admin.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page','brand');
        //
        return view('admin.brand.create');

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
            'brand_name' => 'required',
            'image' => 'image',
        ]);
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->description = $data['description'];
        $brand->slug = Str::slug($data['brand_name']);
        if (empty($data['status']))
        {
            $brand->status = 0;
        }
        else
        {
            $brand->status = 1;
        } 
        //upload brand image
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/brand/');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $brand->image = $filename;
        }
        
        $status = $brand->save();
        if($status)
        Session::flash('success_message', 'Brands Has Been Added Successfully');
        else
        Session::flash('error_message', 'Brands could not be Been Added');
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
        //
      
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
        Session::put('admin_page','brand');
        //
        $brand = Brand::findorfail($id);
        return view ('admin.brand.edit', compact('brand'));
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
            'brand_name' => 'required',
            'image' => 'image',
        ]);
        $brand = Brand::findorfail($id);
        $brand->brand_name = $data['brand_name'];
        $brand->description = $data['description'];
        $brand->slug = Str::slug($data['brand_name']);
        if (empty($data['status']))
        {
            $brand->status = 0;
        }
        else
        {
            $brand->status = 1;
        } 
         //upload brand image
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/brand/');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $brand->image = $filename;
             //delete previous image from folder
             $image_path = 'uploads/brand/';
             if (!empty($data['current_image'])) {
                 if (file_exists($image_path . $data['current_image'])) {
                     unlink($image_path . $data['current_image']);
                 }
             }
        }
        $status = $brand->save();
        if($status)
        Session::flash('success_message', 'Brands Has Been Updated Successfully');
        else
        Session::flash('error_message', 'Brands could not be Been Updated');
        return redirect('/admin/brands');
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
        $brand = Brand::findorfail($id);
        $status = $brand->delete();
        //delete image
        $image_path = 'uploads/brand/';
        if (!empty($brand->image)) {
            if (file_exists($image_path . $brand->image)) {
                unlink($image_path . $brand->image);
            }
        }
        if ($status) {
            Session::flash('success_message', 'Brand Has Been deleted Successfully');
        } else {
            Session::flash('error_message', 'Brand could not be Been deleted');
        }
        return redirect()->back();

    }
    public function updateBrandStatus(Request $request, $id)
    {
        $brand = Brand::findOrFail($request->brand_id);
        $brand->status = $request->status;
        $brand->save();
    
        return response()->json(['message' => 'Brand status updated successfully.']);
    }
}
