<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //session
         Session::put('admin_page','customer');
         //
        $customer = Customer::all();
        return view('admin.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page','customer');
        //
        return view('admin.customer.create');
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
            'name' => 'required',
            'number' => 'required|min:10|numeric',
            'image' => 'required | image',
            'email' => 'required |email'
        ]);
        $customer = new Customer();
        $customer->name = $data['name'];
        $customer->number = $data['number'];
        $customer->email = $data['email'];
        //upload customer image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/customer');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $customer->image = $filename;
        }
        $status =  $customer->save();
        if ($status) {
            Session::flash('success_message', 'Customer Has Been Added Successfully');
        } else
            Session::flash('error_message', 'Customer could not be added');
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
        Session::put('admin_page','customer');
        //
        $customer = Customer::findorfail($id);
        return view('admin.customer.edit', compact('customer'));
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
            'name' => 'required',
            'number' => 'required|min:10|numeric',
            'image' => 'image',
            'email' => 'required |email'
        ]);
        $customer = Customer::findorfail($id);
        $customer->name = $data['name'];
        $customer->number = $data['number'];
        $customer->email = $data['email'];
        //upload customer image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();
            $destinationPath = public_path('/uploads/customer');
            $img = Image::make($image->path());
            $img->resize(600, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $customer->image = $filename;

            //delete previous image from folder
            $image_path = 'uploads/customer/';
            if (!empty($data['current_image'])) {
                if (file_exists($image_path . $data['current_image'])) {
                    unlink($image_path . $data['current_image']);
                }
            }
        }
        $status =  $customer->save();
        if ($status) {
            Session::flash('success_message', 'Customer Has Been updated Successfully');
        } else
            Session::flash('error_message', 'Customer could not be updated');
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
        $customer = Customer::findorfail($id);
        $image_path = 'uploads/customer/';
        if (!empty($customer->image)) {
            if (file_exists($image_path . $customer->image)) {
                unlink($image_path . $customer->image);
            }
        }
        $status = $customer->delete();
        if ($status) {
            Session::flash('success_message', 'Customer Has Been deleted Successfully');
        } else {
            Session::flash('error_message', 'Customer could not be Been deleted');
        }
        return redirect()->back();
    }
}
