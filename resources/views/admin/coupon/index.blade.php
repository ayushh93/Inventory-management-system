@extends('admin.layouts.layout')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Coupons</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Coupons</li>
              <li class="breadcrumb-item active">All Coupons</li>
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
             <h3>Coupons</h3>
             <a class="btn btn-primary cart-btn-transform pull-right" href="{{route('admin.coupons.create')}}">Add Coupons</a>
            </div>
            @include('admin.includes.message')
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="data-source-1" style="width:100%">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Coupon Code</th>
                      <th>Discount</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($coupon)
                    @foreach ($coupon as $item)
                    <tr>
                      <td>{{$loop-> index + 1}}</td>
                      <td>{{$item->coupon_code}}</td>
                      <td>{{$item->discount}}%</td>
                      <td>{{$item->expiry_date}}</td>
                      <td>
                      @if ($item->status == 1)
                      <span class="badge badge-success">Active</span>
                      @elseif($item->status == 0)
                      <span class="badge badge-danger">Inactive</span>
                      @endif
                      </td>
                      <td class="d-flex">
                        {{-- view data  --}}
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#view_content{{$item->id}}">
                      <i class="fa fa-eye"></i></button>
                      {{-- edit data --}}
                        <a href="{{route('admin.coupons.edit', $item->id)}}">
                        <button class="btn btn-success btn-sm" style="margin-left: 2px">
                            <i class="fa fa-pencil"></i>
                        </button>
                        </a>
                        {{-- delete data  --}}
                        <form action="{{ route('admin.coupons.destroy',$item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" id="confirm_delete" class="btn btn-danger confirm_delete" style="margin-left: 2px">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>                    
                        </form>
                      </td>
                    </tr>
                                      <!-- Add Department Modal -->
 <div id="view_content{{$item->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Coupon Details</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p><strong>Coupon Code: </strong>{{ $item->coupon_code }}</p>
              <p><strong>Coupon Discount: </strong>{{ $item->discount }}</p>
              <p><strong>Expiry Date: </strong>{{ $item->expiry_date }}</p>
              <p><strong>Coupon Status: </strong>
                  @if($item->status == 1)
                      <span class="badge bg-success" style="color: white;">Active</span>
                  @else
                      <span class="badge bg-danger" style="color: white;">In Active</span>
                  @endif
              </p>
              <p><strong>Coupon Description: </strong>
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
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
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