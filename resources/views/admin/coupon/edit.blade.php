@extends('admin.layouts.layout')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Coupons</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Coupons</li>
              <li class="breadcrumb-item active">Edit Coupon</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
   <!-- Container-fluid starts-->
   <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Edit Coupon</h5>
          </div> 
          @include('admin.includes.message')
          <form class="form theme-form" method="post" action="{{route('admin.coupons.update',$coupon->id)}}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="coupon_code">Coupon code</label>
                    <input class="form-control" name="coupon_code" type="text" placeholder="Coupon Code" value="{{$coupon->coupon_code}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="discount">Coupon Discount</label>
                    <input class="form-control" name="discount" type="number" min="0" step="0.1" max="100" placeholder="Coupon discount in percentage" value="{{$coupon->discount}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="expiry_date">Expiry Date</label>
                    <input class="form-control" name="expiry_date" type="date" data-language="en" placeholder="Enter expiry date"  min="{{date("Y-m-d")}}" value="{{$coupon->expiry_date}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="description">Coupon Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter Description..." rows="3">{{$coupon->description}}</textarea>
                  </div>
                </div>
              </div>
              <div class="but-button-wrapper">
                  <div class="mb-3 but-button">
                    <label class="form-label" for="status">Coupon Status</label>
                    <div class="media-body icon-state switch-outline">
                        <label class="switch" style="margin-left: 20px;">
                          <input type="checkbox" name="status" value="1" @if($coupon->status == 1) checked @endif><span class="switch-state bg-success"></span>
                        </label>
                      </div>
                  </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" type="submit">Submit</button>
              <input class="btn btn-light" type="reset" value="Cancel">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
@endsection



    

