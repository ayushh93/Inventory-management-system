@extends('admin.layouts.layout')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Customers</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Customer</li>
              <li class="breadcrumb-item active">All Customers</li>
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
             <h3>Customers</h3>
             <a class="btn btn-primary cart-btn-transform pull-right" href="{{route('admin.customers.create')}}">Add Customer</a>
            </div>
            @include('admin.includes.message')
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="data-source-1" style="width:100%">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Image</th>
                      <th>Customer name</th>
                      <th>Email</th>
                      <th>Phone number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($customer as $item) 
                  <tr>                     
                    <td>{{$loop->index + 1}}</td>
                    <td><img src="{{asset('uploads/customer/'. $item->image)}}" width="70px" height="50px" alt="" srcset=""></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->number}}</td>
                    <td class="d-flex">
                      <a href="{{route('admin.customers.edit', $item->id)}}">
                      <button class="btn btn-success btn-sm">
                          <i class="fa fa-pencil"></i>
                      </button>
                      </a>
                      <form action="{{ route('admin.customers.destroy',$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                          <button type="submit" id="confirm_delete" class="btn btn-danger confirm_delete" style="margin-left: 2px">
                            <i class="fa-solid fa-trash-can"></i>
                          </button>                    
                      </form>
                    </td>
                  </tr> 
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Customer name</th>
                            <th>Phone number</th>
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