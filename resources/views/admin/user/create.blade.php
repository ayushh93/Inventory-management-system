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
              <li class="breadcrumb-item active">Add User</li>
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
            <h5>Add User</h5>
          </div> 
          @include('admin.includes.message')
          <form class="form theme-form" method="post" action="{{route('admin.users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" name="username" type="text" placeholder="Username" value="{{old('username')}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="email">User email</label>
                    <input class="form-control" name="email" type="email" placeholder="hello@email.com" value="{{old('email')}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" name="password" type="password" placeholder="Password" value="{{old('password')}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm Password" value="{{old('password_confirmation')}}">
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



    

