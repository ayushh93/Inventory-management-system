@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Brands</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Brand</li>
                            <li class="breadcrumb-item active">All Brands</li>
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
                            <h3>Brands</h3>
                            <a class="btn btn-primary cart-btn-transform pull-right"
                                href="{{ route('admin.brands.create') }}">Add Brand</a>
                        </div>
                        @include('admin.includes.message')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="data-source-1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Brand name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brand as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @if (!empty($item->image))
                                                        <img src="{{ asset('uploads/brand/' . $item->image) }}" width="70px"
                                                            height="50px">
                                                    @else
                                                        <img src="{{ asset('uploads/default/noimg.png') }}" width="70px"
                                                            height="50px">
                                                    @endif
                                                </td>
                                                <td>{{ $item->brand_name }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success" style="color: white;">Active</span>
                                                    @else
                                                        <span class="badge bg-danger" style="color: white;">In Active</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    {{-- view data --}}
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#view_content{{ $item->id }}">
                                                        <i class="fa fa-eye"></i></button>
                                                    {{-- edit data --}}
                                                    <a href="{{ route('admin.brands.edit', $item->id) }}">
                                                        <button class="btn btn-success btn-sm" style="margin-left: 2px">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    </a>
                                                    {{-- delete data --}}
                                                    <form action="{{ route('admin.brands.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="confirm_delete"
                                                            class="btn btn-danger confirm_delete" style="margin-left: 2px">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Add Department Modal -->
                                            <div id="view_content{{ $item->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Brand Details</h5>
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (!empty($item->image))
                                                                <img src="{{ asset('uploads/brand/' . $item->image) }}"
                                                                    width="80px">
                                                            @else
                                                                <img src="{{ asset('uploads/default/noimg.png') }}"
                                                                    width="80px">
                                                            @endif
                                                            <hr>
                                                            <p><strong>Brand Name: </strong>{{ $item->brand_name }}</p>
                                                            <p><strong>Brand Status: </strong>
                                                                @if ($item->status == 1)
                                                                    <span class="badge bg-success"
                                                                        style="color: white;">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger" style="color: white;">In
                                                                        Active</span>
                                                                @endif
                                                            </p>
                                                            <p><strong>Product Description: </strong>
                                                            </p>
                                                            <p>
                                                                {{ $item->description }}
                                                            </p>
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
                                            <th>Image</th>
                                            <th>Brand name</th>
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
