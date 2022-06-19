<?php $dash.='-- '; ?>
@foreach($subcategories as $item)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>@if(!empty($item->image))
          <img src="{{ asset('uploads/category/'.$item->image) }}" width="70px" height="50px">
      @else
          <img src="{{ asset('uploads/default/noimg.png') }}" width="70px" height="50px">
      @endif</td>
        <td>{{$dash}}{{$item->category_name}}</td>
        <td>
            {{$item->parent->category_name}}
        </td>
        <td>
          @if ($item->status == 1)
          <span class="badge badge-success">Active</span>
          @elseif($item->status == 0)
          <span class="badge badge-danger">Inactive</span>
          @endif
          </td>
          <td class="d-flex">
            {{-- view data --}}
            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                data-bs-target="#view_content{{ $item->id }}">
                <i class="fa fa-eye"></i></button>
            {{-- edit data --}}
            <a href="{{ route('admin.categories.edit', $item->id) }}">
                <button class="btn btn-success btn-sm" style="margin-left: 2px">
                    <i class="fa fa-pencil"></i>
                </button>
            </a>
            {{-- delete data --}}
            <form action="{{ route('admin.categories.destroy', $item->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" id="confirm_delete"
                    class="btn btn-danger confirm_delete"
                    style="margin-left: 2px">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </form>
        </td>
     </tr>
     <!-- Add Department Modal -->
     <div id="view_content{{ $item->id }}" class="modal fade"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category Details</h5>
                    <button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (!empty($item->image))
                        <img src="{{ asset('uploads/category/' . $item->image) }}"
                            width="80px">
                    @else
                        <img src="{{ asset('uploads/default/noimg.png') }}"
                            width="80px">
                    @endif
                    <hr>
                    <p><strong>Category:</strong>{{ $item->category_name }}
                    </p>
                    <p><strong>Parent Category:</strong>
                        {{$item->parent->category_name}}
                    </p>
                    <p><strong>Category Status: </strong>
                        @if ($item->status == 1)
                            <span class="badge bg-success"
                                style="color: white;">Active</span>
                        @else
                            <span class="badge bg-danger"
                                style="color: white;">In
                                Active</span>
                        @endif
                    </p>
                    <p><strong>Category Description: </strong>
                    </p>
                    <p>
                        {{ $item->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Department Modal -->
    @if(count($item->subcategory))
        @include('admin.category.sub-category-list',['subcategories' => $item->subcategory])
    @endif
@endforeach