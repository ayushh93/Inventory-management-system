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
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Brands</li>
              <li class="breadcrumb-item active">Edit Brand</li>
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
            <h5>Edit Brand</h5>
          </div> 
          @include('admin.includes.message')

          <form class="form theme-form" method="post" action="{{route('admin.brands.update',$brand->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="brand_name">Brand name</label>
                    <input class="form-control" name="brand_name" type="text" placeholder="Brand name" value="{{$brand->brand_name}}">
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
                        {{-- display image on upload  --}} 
                        @if(!empty($brand->image))
                          <img src="{{asset('uploads/brand/'.$brand->image)}}" class="display-img" alt="" srcset="" id="img-change">
                          @else
                          <img src="{{asset('uploads/default/noimg.png')}}" class="display-img" alt="" srcset="" id="img-change">
                          @endif
                      </div>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label" for="description">Brand Description</label>
                    <textarea class="form-control" name="description" placeholder="Enter Description..." rows="3">{{$brand->description}}</textarea>
                  </div>
                </div>
              </div>
              <div class="but-button-wrapper">
                  <div class="mb-3 but-button">
                    <label class="form-label" for="status">Brand Status</label>
                    <div class="media-body icon-state switch-outline">
                        <label class="switch" style="margin-left: 20px;">
                          <input type="checkbox" name="status" @if($brand->status == 1) value="1" checked @endif><span class="switch-state bg-success"></span>
                        </label>
                      </div>
                  </div>
              </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" type="submit">Update</button>
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


    

