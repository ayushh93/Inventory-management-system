 <!-- Page Body Start-->
 <div class="page-body-wrapper">
     <!-- Page Sidebar Start-->
     <div class="sidebar-wrapper">
         <div>
             <div class="logo-wrapper"><a href="{{ url('/admin/dashboard') }}"><img class="img-fluid for-light"
                         src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark"
                         src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
                 <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                 <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                 </div>
             </div>
             <div class="logo-icon-wrapper"><a href="{{ url('/admin/dashboard') }}"><img class="img-fluid"
                         src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
             <nav class="sidebar-main">
                 <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                 <div id="sidebar-menu">
                     <ul class="sidebar-links" id="simple-bar">
                         <li class="back-btn"><a href="{{ url('/admin/dashboard') }}"><img
                                     class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                             <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                     aria-hidden="true"></i></div>
                         </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'dashboard')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}"
                                 href="{{ url('/admin/dashboard') }}"><i data-feather="home"></i><span
                                     class="lan-3">Dashboard</span></a>
                         </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'user')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}"
                                 href="{{ route('admin.users.index') }}"><i
                                     data-feather="user"></i><span>Users</span></a>
                         </li>
                         <li class="sidebar-list">
                            @if (Session::get('admin_page') == 'brand')
                                @php $active = "side-active" @endphp
                            @else
                                @php $active = "" @endphp
                            @endif
                            <a class="sidebar-link sidebar-title {{ $active }}"
                                href="{{ route('admin.brands.index') }}"><i
                                    data-feather="bold"></i><span>Brands</span></a>
                        </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'category')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}" href="{{ url('/admin/categories') }}"><i
                                     data-feather="list"></i>
                                 <span>Categories</span></a>
                         </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'product')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}"
                                 href="{{ url('/admin/products') }}"><i
                                     data-feather="shopping-bag"></i><span>Products</span></a>
                         </li>
                         <li class="sidebar-list">
                            @if (Session::get('admin_page') == 'productIn' || Session::get('admin_page') == 'productOut')
                            @php $active = "side-active" @endphp
                        @else
                            @php $active = "" @endphp
                        @endif
                            <a class="sidebar-link sidebar-title {{ $active }}" href="#"><i data-feather="shopping-cart"></i><span >Product In/Out</span></a>
                            <ul class="sidebar-submenu">
                              <li><a href="{{route('admin.products.productIn')}}">Product In</a></li>
                              <li><a href="{{route('admin.products.productOut')}}">Product Out</a></li>
                            </ul>
                          </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'customer')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}"
                                 href="{{ route('admin.customers.index') }}"><i
                                     data-feather="users"></i><span>Customer</span></a>
                         </li>
                         <li class="sidebar-list">
                             @if (Session::get('admin_page') == 'coupon')
                                 @php $active = "side-active" @endphp
                             @else
                                 @php $active = "" @endphp
                             @endif
                             <a class="sidebar-link sidebar-title {{ $active }}"
                                 href="{{ route('admin.coupons.index') }}"><i
                                     data-feather="tag"></i><span>Coupons</span></a>
                         </li>
                         

                     </ul>
                 </div>
                 <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
             </nav>
         </div>
     </div>
     <!-- Page Sidebar Ends-->
