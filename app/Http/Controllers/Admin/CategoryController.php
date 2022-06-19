<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session
        Session::put('admin_page', 'category');
        //
        $category = Category::where('parent_id', null)->orderby('category_name', 'asc')->get();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page', 'category');
        //
        $categories = Category::where('parent_id', null)->where('status', 1)->orderby('category_name', 'asc')->get();
        return view('admin.category.create', compact('categories'));
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
        $validator = $request->validate([
            'category_name' => 'required ',
            'parent_id' => 'nullable|numeric'
        ]);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        $category->description = $data['description'];
        $category->parent_id = $data['parent_id'];
        if (empty($data['status'])) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        //upload category image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/category');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $category->image = $filename;
        }
        $status =  $category->save();
        if ($status) {
            Session::flash('success_message', 'Category Has Been Added Successfully');
        } else
            Session::flash('error_message', 'Category could not be added');
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
        Session::put('admin_page', 'category');
        //
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->where('status', 1)->orderby('category_name', 'asc')->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function categorystatusupdate($subcategories):void
     {
        foreach($subcategories as $subcat)
        {
            $subcat->status = 0;
            $subcat->save();
            //product of subcategory status update
            if($subcat->product)
            {
                $subproduct = $subcat->product;
                foreach($subproduct as $subproduct)
                {
                $subproduct->status = 0;
                $subproduct->save();
                }
            }
            if(count($subcat->subcategory))
            {
                $childcat = $subcat->subcategory;
                self::categorystatusupdate($childcat);
            }
        }

     }
    public function update(Request $request, $id)
    {
        //
        $validator = $request->validate([
            'category_name' => 'required ',
            'parent_id' => 'nullable|numeric'
        ]);
        $category = Category::findOrFail($id);
        if ($request->category_name != $category->category_name || $request->parent_id != $category->parent_id) {
            if (isset($request->parent_id)) {
                $checkDuplicate = Category::where('category_name', $request->category_name)->where('parent_id', $request->parent_id)->first();
                if ($checkDuplicate) {
                    Session::flash('error_message', 'Category already exist in this parent.');
                    return redirect()->back();
                }
            } else {
                $checkDuplicate = Category::where('category_name', $request->category_name)->where('parent_id', null)->first();
                if ($checkDuplicate) {
                    Session::flash('error_message', 'Category already exist with this name.');
                    return redirect()->back();
                }
            }
        }
        $data = $request->all();
        $category->category_name = $data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        $category->description = $data['description'];
        $category->parent_id = $data['parent_id'];
        if (empty($data['status'])) {
            $category->status = 0;
            //update status of product
            if(count($category->product))
            {
                $products = $category->product;
                foreach ($products as $product) {
                    $product->status = 0;
                    $product->save();
                }
            }
            //update status of subcategory
            if (count($category->subcategory)) {
                $subcategories = $category->subcategory;
                $this->categorystatusupdate($subcategories); 

            }
        }
         else {
            $category->status = 1;
        }
        //upload category image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/category');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $category->image = $filename;
            //delete previous image from folder
            $image_path = 'uploads/category/';
            if (!empty($data['current_image'])) {
                if (file_exists($image_path . $data['current_image'])) {
                    unlink($image_path . $data['current_image']);
                }
            }
        }
        $status =  $category->save();
        if ($status) {
            Session::flash('success_message', 'Category Has Been updated Successfully');
        } else
            Session::flash('error_message', 'Category could not be updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete subcategory image 
    public static function deletesubcategory($subcategories):void
    {
      foreach ($subcategories as $cat)
      {
         //delete sub category image cause subcategory also deletes
         $image_path = 'uploads/category/';
         if (!empty($cat->image)) {
             if (file_exists($image_path . $cat->image)) {
                 unlink($image_path . $cat->image);
             }
         }
         if(count($cat->subcategory))
                {
                    $category = $cat->subcategory;
                     self::deletesubcategory($category);
                }        
      }
    } 
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
    //subcateory image delete if exists
        if (count($category->subcategory))
         {
            $subcategories = $category->subcategory;
            $this->deletesubcategory($subcategories);
        }
          //delete image
          $image_path = 'uploads/category/';
          if (!empty($category->image)) {
              if (file_exists($image_path . $category->image)) {
                  unlink($image_path . $category->image);
              }
          }
        $status =  $category->delete();
        if ($status) {
            Session::flash('success_message', 'Category has been deleted successfully');
        } else
            Session::flash('error_message', 'Category could not be deleted');
        return redirect()->back();
    }
}
