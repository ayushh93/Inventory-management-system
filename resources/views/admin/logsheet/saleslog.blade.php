@extends('admin.layouts.layout')
@section('main-content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Sales Log</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Log sheet</li>
                            <li class="breadcrumb-item active">Sales Log</li>
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
                            <h3>Sales Log</h3>
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
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>User</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{$item->productAttribute->product->product_name}}</td>
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
                                                <td>{{ $item->quantity }}</td>
                                                <td>Rs. {{ $item->price }}</td>
                                                <td>{{ $item->sold_by }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
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
                                            <th>Date</th>
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
