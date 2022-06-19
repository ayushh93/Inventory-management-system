@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Categories
                        </h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Categories</li>
                            <li class="breadcrumb-item active">Edit Category</li>
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
                            <h5>Edit Category</h5>
                        </div>
                        @include('admin.includes.message')

                        <form class="form theme-form" method="post"
                            action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Select parent category</label>
                                            <select type="text" name="parent_id" class="form-control">
                                                <option value="">None</option>
                                                @if ($categories)
                                                    @foreach ($categories as $item)
                                                        <?php $dash = ''; ?>
                                                        <option value="{{ $item->id }}"
                                                            @if ($category->parent_id == $item->id) selected @endif>
                                                            {{ $item->category_name }}
                                                        </option>
                                                        @if (count($item->subcategory))
                                                            @include('admin.category.sub-category-list-option-for-update',
                                                                [
                                                                    'subcategories' => $item->subcategory,
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
                                            <label class="form-label" for="category_name">Category name</label>
                                            <input class="form-control" name="category_name" type="text"
                                                placeholder="Category name" value="{{ $category->category_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Image</label>
                                            <div class="inner-form">
                                                <input class="form-control w-25" id="image-input" name="image" type="file"
                                                    accept="image/*" onchange="readURL(this);">
                                                <input type="hidden" name="current_image" value="{{ $category->image }}">

                                                {{-- display image on upload --}}
                                                @if ($category->image)
                                                    <img src="{{ asset('uploads/category/' . $category->image) }}"
                                                        class="display-img" alt="" srcset="" id="img-change">
                                                @else
                                                    <img src="{{ asset('uploads/default/noimg.png') }}"
                                                        class="display-img" alt="" srcset="" id="img-change">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="description">Category Description</label>
                                            <textarea class="form-control" name="description" placeholder="Enter Description..." rows="3">{{ $category->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="but-button-wrapper">
                                    <div class="mb-3 but-button">
                                        <label class="form-label" for="status">Category Status</label>
                                        <div class="media-body icon-state switch-outline">
                                            <label class="switch" style="margin-left: 20px;">
                                                <input type="checkbox" name="status"
                                                    @if ($category->status == 1) value="1" checked @endif><span
                                                    class="switch-state bg-success"></span>
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

@section('js')
    <script>
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
