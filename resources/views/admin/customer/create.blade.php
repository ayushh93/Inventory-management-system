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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Customers</li>
                            <li class="breadcrumb-item active">Add Customer</li>
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
                            <h5>Add Customer</h5>
                        </div>
                        @include('admin.includes.message')

                        <form class="form theme-form" method="post" action="{{ route('admin.customers.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Customer name</label>
                                            <input class="form-control" name="name" type="text"
                                                placeholder="Customer name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Customer email</label>
                                            <input class="form-control" name="email" type="email"
                                                placeholder="hello@email.com" value="{{ old('email') }}">
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
                                                {{-- display image on upload --}}
                                                <img src="" class="display-img" alt="" srcset="" id="img-change">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="number">Customer number</label>
                                            <input class="form-control" name="number" type="tel"
                                                placeholder="Customer number" value="{{ old('number') }}">
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
  function readURL(input){
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
