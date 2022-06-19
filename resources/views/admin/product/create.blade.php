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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Product</h5>
                        </div>
                        @include('admin.includes.message')

                        <form class="form theme-form" method="post" action="{{ route('admin.products.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Select category</label>
                                            <select type="text" name="category_id" class="form-control">
                                                <option value="" selected disabled>Select Category</option>
                                                @if ($categories)
                                                    @foreach ($categories as $category)
                                                        <?php $dash = ''; ?>
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                        @if (count($category->subcategory))
                                                            @include('admin.product.subCategoryList-option-for-product',
                                                                [
                                                                    'subcategories' => $category->subcategory,
                                                                ])
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Select Brand</label>
                                            <select type="text" name="brand_id" class="form-control">
                                                <option value="" selected disabled>Select Brand</option>
                                                @if ($brands)
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->brand_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="product_name">Product name</label>
                                            <input class="form-control" name="product_name" type="text"
                                                placeholder="Product name " value="{{ old('product_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Featured Image</label>
                                            <div class="inner-form">
                                                <input class="form-control w-25" id="image-input" name="featured_image"
                                                    type="file" accept="image/*" onchange="readURL(this);">
                                                {{-- display image on upload --}}
                                                <img src="" class="display-img" alt="" srcset="" id="img-change">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Product Price</label>
                                            <input class="form-control" name="price" type="number" min="0"
                                                placeholder="Product Price" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="but-button-wrapper">
                                        <div class="mb-3 but-button" style="margin-right: 2rem">
                                            <label class="form-label" for="status">Product Status</label>
                                            <div class="media-body icon-state switch-outline">
                                                <label class="switch" style="margin-left: 20px;">
                                                    <input type="checkbox" name="status" value="1" checked><span
                                                        class="switch-state bg-success"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="but-button-wrapper">
                                        <div class="mb-3 but-button">
                                            <label class="form-label" for="featured_product">Featured Product</label>
                                            <div class="media-body icon-state switch-outline">
                                                <label class="switch" style="margin-left: 20px;">
                                                    <input type="checkbox" name="featured_product" value="1" checked><span
                                                        class="switch-state bg-success"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="excerpt">Product Excerpt</label>
                                            <textarea class="form-control" name="excerpt" placeholder="Enter Excerpt..." cols="3" rows="3">{{ old('excerpt') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Product Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description...">{{ old('description') }}</textarea>
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

@section('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        //change image on upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-change')
                        .attr('src', e.target.result)
                        .width(100)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
