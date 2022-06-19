
{{-- <form method="POST" action="{{ route('admin.adminlogout') }}">
    @csrf

    <x-dropdown-link :href="route('admin.adminlogout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form> --}}

@extends('admin.layouts.layout')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">        
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Dashboard</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      
    </div>
    <!-- Container-fluid Ends-->
  </div> 
@endsection
        
        