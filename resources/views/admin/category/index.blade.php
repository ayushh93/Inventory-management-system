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
                            <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Categories</li>
                            <li class="breadcrumb-item active">All Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- HTML (DOM) sourced data  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Categories</h3>
                            <a class="btn btn-primary cart-btn-transform pull-right"
                                href="{{ route('admin.categories.create') }}">Add Categories</a>
                        </div>
                        @include('admin.includes.message')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="data-source-1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Parent Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($category))
                                            <?php $_SESSION['i'] = 0; ?>
                                            @foreach ($category as $item)
                                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                                <tr>
                                                    <?php $dash = ''; ?>
                                                    <td>{{ $_SESSION['i'] }}</td>
                                                    <td>
                                                        @if (!empty($item->image))
                                                            <img src="{{ asset('uploads/category/' . $item->image) }}"
                                                                width="70px" height="50px">
                                                        @else
                                                            <img src="{{ asset('uploads/default/noimg.png') }}"
                                                                width="70px" height="50px">
                                                        @endif
                                                    </td>
                                                    <td><span class="fwber">{{ $item->category_name }}</span>
                                                    </td>
                                                    <td>
                                                        @if (isset($item->parent_id))
                                                            {{ $category->subcategory->category_name }}
                                                        @else
                                                            <span class="fwb"> None</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @elseif($item->status == 0)
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        {{-- view data --}}
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#view_content{{ $item->id }}">
                                                            <i class="fa fa-eye"></i></button>
                                                        {{-- edit data --}}
                                                        <a href="{{ route('admin.categories.edit', $item->id) }}">
                                                            <button class="btn btn-success btn-sm" style="margin-left: 2px">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </a>
                                                        {{-- delete data --}}
                                                        <form action="{{ route('admin.categories.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="confirm_delete"
                                                                class="btn btn-danger confirm_delete"
                                                                style="margin-left: 2px">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- Add Department Modal -->
                                                <div id="view_content{{ $item->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Category Details</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if (!empty($item->image))
                                                                    <img src="{{ asset('uploads/category/' . $item->image) }}"
                                                                        width="80px">
                                                                @else
                                                                    <img src="{{ asset('uploads/default/noimg.png') }}"
                                                                        width="80px">
                                                                @endif
                                                                <hr>
                                                                <p><strong>Category:</strong>{{ $item->category_name }}
                                                                </p>
                                                                <p><strong>Category slug:</strong>{{ $item->slug}}
                                                                </p>
                                                                <p><strong>Parent Category:</strong>
                                                                    @if (isset($item->parent_id))
                                                                        {{ $category->subcategory->category_name }}
                                                                    @else
                                                                        <span class="fwb"> None</span>
                                                                    @endif
                                                                </p>
                                                                <p><strong>Category Status: </strong>
                                                                    @if ($item->status == 1)
                                                                        <span class="badge bg-success"
                                                                            style="color: white;">Active</span>
                                                                    @else
                                                                        <span class="badge bg-danger"
                                                                            style="color: white;">In
                                                                            Active</span>
                                                                    @endif
                                                                </p>
                                                                <p><strong>Category Description: </strong>
                                                                </p>
                                                                <p>
                                                                    {{ $item->description }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Add Department Modal -->
                                                @if (count($item->subcategory))
                                                    @include('admin.category.sub-category-list', [
                                                        'subcategories' => $item->subcategory,
                                                    ])
                                                @endif
                                            @endforeach
                                            <?php unset($_SESSION['i']); ?>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Parent Category</th>
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
