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
                            <li class="breadcrumb-item active">Add Product Attribute</li>
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
                            <h5>Add Product Attribute</h5>
                            <div class="product-details d-flex justify-content-between pt-4">
                                <ul class="product-details-list">
                                    <li>Product Name: <span class="product-name">{{ $product->product_name }}</span></li>
                                    <li>Slug: <span class="slug-name">{{ $product->slug }}</span></li>
                                    <li>Brand: <span class="brand-name">
                                            @if (!empty($product->brand->brand_name))
                                                {{ $product->brand->brand_name }}
                                            @else
                                            <span class="text-danger">  None</span>
                                            @endif
                                        </span></li>
                                    <li>Category: <span
                                            class="category-name"> @if (!empty($product->category->category_name))
                                            {{ $product->category->category_name }}
                                        @else
                                            <span class="text-danger">Uncategorised</span> 
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
                        <form action="{{ route('admin.product.storeAttribute') }}" method="post" enctype="multipart/form-data"
                            class="mt-5 ml-2 mb-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="control-group ">
                                <div class="field_wrapper">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="text" name="sku[]" placeholder="SKU" class="form-control" value="{{old('sku[]')}}"/>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" name="size[]" placeholder="Size" class="form-control" value="{{old('size[]')}}"/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="color[]" placeholder="Color" class="form-control" value="{{old('color[]')}}" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="price[]" placeholder="Price"
                                                class="form-control" value="{{old('price[]')}}" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="stock[]" placeholder="Stock"
                                                class="form-control" value="{{old('stock[]')}}" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="low_stock[]" placeholder="Low Stock"
                                                class="form-control" value="{{old('low_stock[]')}}" />
                                        </div>
                                        <div class="col-md-1">
                                            <a href="javascript:void(0);" class="add_button" title="Add field">
                                                <img src="{{ asset('assets/images/plus-green.svg') }}" /></a>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <input class="btn btn-light" type="reset" value="Cancel">
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="card-body">
                            <div class="card-header pt-0 d-flex justify-content-between">
                                <h3>Product Details</h3>
                                
                            </div>
                            <div class="table-responsive">
                                <form action="{{route('admin.product.updateAttribute',$productDetails->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
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
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productDetails['productattribute'] as $attribute)
                                                <tr>
                                                    <td> <input type="hidden" name="idAttr[]"
                                                            value="{{ $attribute->id }}"> {{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <input type="text" name="sku[]" value="{{ $attribute->SKU }}"
                                                            class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="size[]" value="{{ $attribute->size }}"
                                                            class="form-control" @if(empty($attribute->size)) placeholder="No size" @endif>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="color[]" value="{{ $attribute->color }}"
                                                            class="form-control" @if(empty($attribute->color)) placeholder="No color" @endif>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="price[]" value="{{ $attribute->price }}"
                                                            class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="stock[]" value="{{ $attribute->stock }}"
                                                            class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="low_stock[]"
                                                            value="{{ $attribute->low_stock }}" class="form-control" required>
                                                    </td>
                                                    <td class="d-flex">
                                                        <input type="submit" value="Update" class="btn btn-sm btn-info">
                                                        <a href="{{route('admin.product.deleteAttribute',$attribute->id)}}" id="confirm_delete"
                                                        class="btn btn-danger confirm_delete" style="margin-left: 2px">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                '<div class="field_wrapper remove"> <div class="row"><div class="col-md-2"> <input type="text" name="sku[]" placeholder="SKU" class="form-control"/> </div><div class="col-md-1"> <input type="text" name="size[]" placeholder="Size" class="form-control"/> </div><div class="col-md-2"> <input type="text" name="color[]" placeholder="Color" class="form-control"/> </div><div class="col-md-2"> <input type="number" name="price[]" placeholder="Price" class="form-control"/> </div><div class="col-md-2"> <input type="number" name="stock[]" placeholder="Stock" class="form-control"/> </div><div class="col-md-2"> <input type="number" name="low_stock[]" placeholder="Low Stock" class="form-control"/> </div><div class="col-md-1"> <a href="javascript:void(0);" class="remove_button" title="Add field"> <img src="{{ asset('assets/images/red-x.png') }}"/></a> </div></div></div>';
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parents('.remove').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endsection
