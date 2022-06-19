@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Product Attribute</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">Product Details</li>
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
                            <h5>Product Details</h5>
                            <div class="product-details d-flex justify-content-between pt-4">
                                <ul class="product-details-list">
                                    <li><strong> Product Name:</strong> <span class="product-name">{{ $product->product_name }}</span></li>
                                    <li><strong>Slug:</strong> <span class="slug-name">{{ $product->slug }}</span></li>
                                    <li><strong>Brand:</strong> <span class="brand-name">
                                            @if (!empty($product->brand->brand_name))
                                                {{ $product->brand->brand_name }}
                                            @else
                                                None
                                            @endif
                                        </span></li>
                                    <li><strong>Category:</strong> <span
                                            class="category-name">{{ $product->category->category_name }}</span></li>
                                    <li><strong>Price: </strong><span class="category-name">{{ $product->price }}</span></li>
                                    <li><strong>Status:</strong>
                                        @if ($product->status == 1 )
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                   </li>
                                   <li><strong>Featured Product:</strong>
                                    @if ($product->featured_product == 1 )
                                    <span class="badge badge-success">Yes</span>
                                    @else
                                    <span class="badge badge-danger">No</span>
                                    @endif
                               </li>
                               <li><strong>Excerpt:</strong> <br> <span
                                class="excerpt-name">{{ $product->excerpt }}</span></li>
                                <li><strong>Description:</strong> <br> <span
                                    class="description-name">{!! $product->description !!}</span></li>
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
                        <hr>
                        <div class="card-body">
                            <div class="card-header pt-0">
                                <h3>Product Attributes</h3>            
                            </div>
                            <div class="table-responsive">
                                    <table class="display" id="data-source-1" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>SKU</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Low Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productDetails['productattribute'] as $item)
                                            <tr>
                                                <td>{{$loop -> index + 1 }}</td>
                                                <td>{{$item->SKU}}</td>
                                                <td>@if (!empty($item->size))
                                                    {{$item->size}}
                                                @else
                                                    No size
                                                @endif
                                                    </td>
                                                <td>@if (!empty($item->color))
                                                    {{$item->color}}
                                                @else
                                                    No color
                                                @endif</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->stock}}</td>
                                                <td>{{$item->low_stock}}</td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>SKU</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Low Stock</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <section id="homeGallery" class="product-gallery pt-3 section-padding mx-auto">
                        <div class="container">
                            <div class="main-title text-center">
                                <h4 class="mb-4">Gallery</h4>
                            </div>
                            <div class="gallery-flex">
                                <div class="row">
                                    @foreach ($productImages['productImage'] as $item)
                                        
                                    <div class="col-lg-4 col-md-4">
                                        <div class="gallery-image">
                                            <a href="{{asset('uploads/product/gallery/'. $item->image)}}" data-fancybox="gallery">
                                                <img src="{{asset('uploads/product/gallery/'. $item->image)}}" alt="Image">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
@endsection


