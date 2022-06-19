<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //session
         Session::put('admin_page','coupon');
         //
        $coupon = Coupon::all();
        return view('admin.coupon.index',compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page','coupon');
        //
        return view('admin.coupon.create');
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
            'coupon_code' => 'required|max:20|min:4',
            'discount' => 'required | numeric | max:100 | min:0',
            'expiry_date' => 'required'
        ]);
        $coupon = new Coupon();
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->discount = $data['discount'];
        $coupon->expiry_date = $data['expiry_date'];
        $coupon->description = $data['description'];
        if (empty($data['status']))
        {
            $coupon->status = 0;
        }
        else
        {
            $coupon->status = 1;
        } 
        $status = $coupon->save();
        if($status)
        Session::flash('success_message', 'Coupons Has Been Added Successfully');
        else
        Session::flash('error_message', 'Coupons could not be Been Added');
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
         Session::put('admin_page','coupon');
         //
        $coupon = Coupon::findorfail($id);
        return view('admin.coupon.edit',compact('coupon'));
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
            'coupon_code' => 'required|max:20|min:4',
            'discount' => 'required | numeric | max:100 | min:0',
            'expiry_date' => 'required'
        ]);
        $coupon = Coupon::findorfail($id);
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->discount = $data['discount'];
        $coupon->expiry_date = $data['expiry_date'];
        $coupon->description = $data['description'];
        if (empty($data['status']))
        {
            $coupon->status = 0;
        }
        else
        {
            $coupon->status = 1;
        } 
        $status = $coupon->save();
        if($status)
        Session::flash('success_message', 'Coupons Has Been updated Successfully');
        else
        Session::flash('error_message', 'Coupons could not be Been updated Successfully');
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
        $coupon=Coupon::findorfail($id);
       
        $status = $coupon->delete();
        if ($status) {
            Session::flash('success_message', 'Coupon Has Been deleted Successfully');
        }
        else{
            Session::flash('error_message', 'Coupon could not be Been deleted Successfully');
        }
            return redirect()->back();

    }
}
