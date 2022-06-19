@extends('admin.layouts.layout')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Users</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">All users</li>
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
             <h3>Users</h3>
             <a class="btn btn-primary cart-btn-transform pull-right" href="{{route('admin.users.create')}}">Add user</a>
            </div>
            @include('admin.includes.message')
            <div class="card-body">
              <div class="table-responsive">
                <table class="display" id="data-source-1" style="width:100%">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($user as $item) 
                  <tr>                     
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->created_at}}</td>
                    <td class="d-flex">
                        {{-- edit data --}}
                      <a href="{{route('admin.users.edit', $item->id)}}">
                      <button class="btn btn-secondary btn-sm" style="margin-left: 2px">
                          <span>Reset password</span>
                      </button>
                      </a>
                      {{-- delete data  --}}
                      <form action="{{ route('admin.users.destroy',$item->id) }}" method="POST">
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
                        <th>User</th>
                        <th>Email</th>
                        <th>Created at</th>
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