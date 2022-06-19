@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Product Image</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Add Product Image</li>
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
                            <h5>Add Product Images</h5>
                            <div class="product-details d-flex justify-content-between pt-4">
                                <ul class="product-details-list">
                                    <li>Product Name: <span class="product-name">{{ $product->product_name }}</span></li>
                                    <li>Slug: <span class="slug-name">{{ $product->slug }}</span></li>
                                    <li>Brand: <span class="brand-name">
                                            @if (!empty($product->brand->brand_name))
                                                {{ $product->brand->brand_name }}
                                            @else
                                                None
                                            @endif
                                        </span></li>
                                    <li>Category: <span
                                            class="category-name"> @if (!empty($product->category->category_name))
                                            {{ $product->category->category_name }}
                                        @else
                                            Uncategorised
                                        @endif</span></li>
                                    <li>Price: <span class="category-name">{{ $product->price }}</span></li>

                                </ul>
                                <div class="product-image">
                                    @if (!empty($product->featured_image))
                                        <img src="{{ asset('uploads/product/' . $product->featured_image) }}"
                                            alt="Product Image" class="img-fluid">
                                    @else
                                        <img src="{{ asset('uploads/default/noimg.png') }}" alt="Product Image"
                                            class="img-fluid">
                                    @endif
                                </div>
                            </div>
                        </div>

                        @include('admin.includes.message')
                        <form class="form theme-form" method="post" action="{{route('admin.product.storeImage')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Image</label>
                                            <div class="inner-form">
                                                <input class="form-control w-50" id="image-input" name="image[]" type="file"
                                                    accept="image/*" multiple="multiple">
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <input class="btn btn-light" type="reset" value="Cancel">
                                </div>
                        </form>
                        <hr>
                        <div class="card-body">
                            <div class="card-header">
                                <h3>Image</h3>
                            </div>
                            <div class="table-responsive">
                                    <table class="display" id="data-source-1" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productImages['productImage'] as $item)
                                            <tr>
                                            <td>{{$loop -> index +1}}</td>
                                                <td><img src="{{asset('uploads/product/gallery/'.$item->image)}}" width="70px" height="80px" alt=""></td>
                                                <td> <a href="{{route('admin.product.deleteImage',$item->id)}}" id="confirm_delete"
                                                    class="btn btn-danger confirm_delete" style="margin-left: 2px">
                                                    <i class="fa-solid fa-trash-can"></i></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
@endsection

