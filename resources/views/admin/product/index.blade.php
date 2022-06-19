@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Products</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Product</li>
                            <li class="breadcrumb-item active">All Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- HTML (DOM) sourced data  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Products</h3>
                            <a class="btn btn-primary cart-btn-transform pull-right"
                                href="{{ route('admin.products.create') }}">Add Product</a>
                        </div>
                        @include('admin.includes.message')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="data-source-1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @if (!empty($item->featured_image))
                                                        <img src="{{ asset('uploads/product/' . $item->featured_image) }}"
                                                            width="70px" height="50px" alt="" srcset="">
                                                    @else
                                                        <img src="{{ asset('uploads/default/noimg.png') }}" width="70px"
                                                            height="50px" alt="" srcset="">
                                                    @endif
                                                </td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>
                                                    @if (empty($item->category_id))
                                                       <span class="text-danger"> Uncategorized</span>
                                                    @else
                                                        {{ $item->category->category_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($item->brand_id))
                                                    <span class="text-danger">None</span>
                                                    @else
                                                        {{ $item->brand->brand_name }}
                                                    @endif
                                                </td>
                                        
                                        
                                        <td>Rs. {{ $item->price }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">In active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex mb-2">
                                                {{-- view data --}}
                                                <a href="{{ route('admin.products.show', $item->id) }}">
                                                    <button class="btn btn-info btn-sm" style="margin-left: 2px">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                {{-- edit data --}}
                                                <a href="{{ route('admin.products.edit', $item->id) }}">
                                                    <button class="btn btn-success btn-sm" style="margin-left: 2px">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                {{-- delete data --}}
                                                <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="confirm_delete"
                                                        class="btn btn-danger confirm_delete" style="margin-left: 2px">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class='d-flex'>
                                                {{-- Add attributes --}}
                                                <a href="{{ route('admin.product.addAttribute', $item->id) }}">
                                                    <button class="btn btn-primary btn-sm" style="margin-left: 2px">
                                                        <span style="font-size: 8px"> Attribute</span>
                                                    </button>
                                                </a>
                                                {{-- Add image --}}
                                                <a href="{{ route('admin.product.addImage', $item->id) }}">
                                                    <button class="btn btn-primary btn-sm" style="margin-left: 2px">
                                                        <span style="font-size: 8px"> Images</span>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
