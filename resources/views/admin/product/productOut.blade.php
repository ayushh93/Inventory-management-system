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
                            <li class="breadcrumb-item active">Product Out</li>
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
                            <h3>Product out</h3>
                        </div>
                        @include('admin.includes.message')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="data-source-1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->SKU }}</td>
                                                <td>
                                                    @if (!empty($item->size))
                                                        {{ $item->size }}
                                                    @else
                                                        None
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($item->color))
                                                        {{ $item->color }}
                                                    @else
                                                        None
                                                    @endif
                                                </td>
                                               
                                                @if($item->stock > $item->low_stock)   
                                                <td class="text-success">{{ $item->stock }}</td>
                                                @elseif($item->stock < $item->low_stock)
                                                <td class="text-danger">{{ $item->stock }}</td>
                                                @endif
                                                <td>Rs. {{ $item->price }}</td>
                                                <td>
                                                    {{-- add stock --}}
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#view_content{{ $item->id }}">
                                                        Product Out</button>
                                                </td>
                                            </tr>
                                            <!-- Add Department Modal -->
                                            <div id="view_content{{ $item->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Product Details</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (!empty($item->product->featured_image))
                                                                <img src="{{ asset('uploads/product/' . $item->product->featured_image) }}"
                                                                    width="80px">
                                                            @else
                                                                <img src="{{ asset('uploads/default/noimg.png') }}"
                                                                    width="80px">
                                                            @endif
                                                            <hr>
                                                            <p><strong>Product:
                                                                </strong>{{ $item->product->product_name }}</p>
                                                            <p><strong>SKU: </strong>
                                                                {{ $item->SKU }}
                                                            </p>
                                                            <p><strong>Stock: </strong>
                                                                @if (($item->stock) > ($item->low_stock))
                                                                <span class="text-success">{{$item->stock}}</span>
                                                            @elseif(($item->stock) < ($item->low_stock))
                                                            <span class="text-danger">{{$item->stock}}</span>
                                                            
                                                            @endif
                                                            </p>
                                                            <p><strong>Product size: </strong>
                                                                @if (!empty($item->size))
                                                                    {{ $item->size }}
                                                                @else
                                                                    None
                                                                @endif
                                                            </p>
                                                            <p><strong>Product color: </strong>
                                                                @if (!empty($item->color))
                                                                    {{ $item->color }}
                                                                @else
                                                                    None
                                                                @endif
                                                            </p>
                                                            <hr>
                                                            <form action="{{ route('admin.products.removeStock', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <label for="stock_Remove"> <strong>Quantity:
                                                                    </strong></label>
                                                                <input type="number" value="{{ old('stock_remove') }}"
                                                                    name="stock_remove" max="{{$item->stock}}">
                                                                <button type="submit" value="Remove Stock"
                                                                    class="btn btn-success btn-sm">Product Out</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Add Department Modal -->
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Stock</th>
                                            <th>Price</th>
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
