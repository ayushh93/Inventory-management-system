@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <i data-feather="thumbs-up"></i>
        {{ Session::get('success_message') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i data-feather="alert-triangle"></i>
        {{ Session::get('error_message') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>       
    </div>
@endif
