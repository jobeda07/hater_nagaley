@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<aside class="navbar-aside bg-primary" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route('admin.dashboard') }}" class="brand-wrap">
            @php
                $logo = get_setting('site_footer_logo');
            @endphp
            @if($logo != null)
                <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}" alt="{{ env('APP_NAME') }}"  style="height: 70px !important; min-width: 100px !important;">
            @else
                <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 70px !important; min-width: 80px !important;">
            @endif
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-white material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ ($route == 'admin.dashboard')? 'active':'' }}">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                   <i class="fa-solid fa-house fontawesome_icon_custom"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu
                {{ ($prefix == 'admin/product') || ($prefix == 'admin/category') || ($route == 'attribute.index') || ($prefix == 'admin/brand') ? 'active' : '' }}
            ">
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-bag-shopping fontawesome_icon_custom"></i>
                        <span class="text">Products</span>
                    </a>
                <div class="submenu">
                        <a class="{{ ($route == 'product.add') ? 'active':'' }}" href="{{ route('product.add') }}">Product Add</a>
                        <a class="{{ ($route == 'product.all') ? 'active':'' }}" href="{{ route('product.all') }}">Products</a>
                        <a class="{{ ($prefix == 'admin/category') ? 'active':'' }}" href="{{ route('category.index') }}">Categories</a>
                        <a class="{{ ($route == 'attribute.index') ? 'active':'' }}" href="{{ route('attribute.index') }}">Attributes</a>
                        <a class="{{ ($prefix == 'admin/brand') ? 'active':'' }}" href="{{ route('brand.all') }}">Brands</a>
                </div>
            </li>
            <li class="menu-item has-submenu {{ ($route == 'all_orders.vendor_sale_index')?'active':'' }}">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Sales</span>
                </a>
                <div class="submenu">
                    <a class="{{ ($route == 'all_orders.vendor_sale_index') ? 'active':'' }}" href="{{ route('all_orders.vendor_sale_index') }}" >Vendor Order List</a>
                </div>
            </li>
            <li class="menu-item has-submenu {{ ($prefix == 'admin/supplier')?'active':'' }}">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-stars"></i>
                        <span class="text">Suppliers</span>
                    </a>
                <div class="submenu">
                        <a class="{{ ($route == 'supplier.all') ? 'active':'' }}" href="{{ route('supplier.all') }}">Supplier List</a>
                        <a class="{{ ($route == 'supplier.create') ? 'active':'' }}" href="{{ route('supplier.create') }}">Supplier Add</a>
                </div>
            </li>

            <li class="menu-item has-submenu
                {{ ($route == 'stock_report.index')? 'active':'' }}
            ">
                <a class="menu-link" href="#">
                   <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Report</span>
                </a>
                <div class="submenu">
                    <a class="{{ ($route == 'stock_report.index') ? 'active':'' }}" href="{{ route('stock_report.index') }}">Product Stock</a>
                </div>
            </li>

        </ul>
        <hr />
        <br />
        <br />
        <div class="sidebar-widgets">
           <div class="copyright text-center m-25">
              <p>
                 <strong class="d-block">Admin Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved
              </p>
           </div>
        </div>
    </nav>
</aside>
