<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="{{ Request::is('admin/category*') ? 'true':'false' }}" aria-controls="category">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Category</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/category*') ? 'show':'' }}" id="category">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/*/edit')  ? 'active':'' }}" href="{{ url('admin/category') }}">View Category</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category/create') ? 'active':'' }}" href="{{ url('admin/category/create') }}">Add Category</a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="{{ Request::is('admin/products*') ? 'true':'false' }}" aria-controls="products">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Products</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/products*') ? 'show':'' }}" id="products">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products') || Request::is('admin/products/*/edit')  ? 'active':'' }}" href="{{ url('admin/products') }}">View Products</a></li>
                <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products/create') ? 'active':'' }}" href="{{ url('admin/products/create') }}">Add Product</a></li>
            </ul>
        </div>
        </li>
        </li>
        <li class="nav-item {{ Request::is('admin/users*') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="{{ Request::is('admin/users*') ? 'true':'false' }}" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/users*') ? 'show':'' }}" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active':'' }}" href="{{ url('/admin/users') }}"> View User </a></li>
                <li class="nav-item"> <a class="nav-link {{ Request::is('admin/users/create') || Request::is('admin/users/*/edit') ? 'active':'' }}" href="{{ url('/admin/users/create') }}"> Add User </a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/brand') }}">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Brands</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/colors') }}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Colors</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/sliders') }}">
            <i class="mdi mdi-emoticon menu-icon"></i>
            <span class="menu-title">Sliders</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/settings') }}">
            <i class="mdi mdi-settings menu-icon"></i>
            <span class="menu-title">Site Settings</span>
        </a>
        
        <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/orders') }}">
            <i class="mdi mdi-sale menu-icon"></i>
            <span class="menu-title">Orders</span>
        </a>
        </li>
    </ul>
</nav>