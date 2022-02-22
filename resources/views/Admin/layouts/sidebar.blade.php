<div class="app-sidebar menu-fixed" data-background-color="black" data-image="{{asset('admin-assets/app-assets/img/sidebar-bg/01.jpg')}}" data-scroll-to-active="true">
  <!-- main menu header-->
  <!-- Sidebar Header starts-->
  <div class="sidebar-header">
    <div class="logo clearfix"><a class="logo-text float-left" href="{{route('admin.main')}}">
        <div class="logo-img"><img src="{{asset('admin-assets/app-assets/img/logo.png')}}" style="width: 40px;" alt="Apex Logo" /></div><span class="text">MINE CART</span>
      </a><a class="nav-toggle d-none d-lg-none d-xl-block" id="sidebarToggle" href="javascript:;"><i class="toggle-icon ft-toggle-right" data-toggle="expanded"></i></a><a class="nav-close d-block d-lg-block d-xl-none" id="sidebarClose" href="javascript:;"><i class="ft-x"></i></a></div>
  </div>
  <div class="sidebar-content main-menu-content">
    <div class="nav-container">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        @can('dashboard_view')
        <li class="nav-item {{ request()->is('*dashboard*') ? 'active' : '' }}"><a href="{{route('admin.main')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="Email">Dashboard</span></a>
        </li>
        @endcan
        @can('role_view')
        <li class="nav-item {{ request()->is('*role*') ? 'active' : '' }}"><a href="{{route('admin.role.index')}}"><i class="fa fa-plus-square-o"></i><span class="menu-title" data-i18n="Role">Role</span></a></li>
        @endcan

        @can('admin_view')
        <li class="nav-item {{ request()->is('*adminUser*') ? 'active' : '' }}"><a href="{{route('admin.adminUser.index')}}"><i class="fa fa-unlock-alt"></i><span class="menu-title" data-i18n="Permission">Admin User</span></a></li>
        @endcan

        @can('category_view')
        <li class="nav-item {{ request()->is('*Category*') ? 'active' : '' }}"><a href="{{route('admin.Category.categoryindex')}}"><i class="fa fa-window-restore"></i><span class="menu-title" data-i18n="Category">Category</span></a></li>
        @endcan

        @can('brand_view')
        <li class="nav-item {{ request()->is('*Brand*') ? 'active' : '' }}"><a href="{{route('admin.Brand.brandindex')}}"><i class="fa fa-superpowers"></i><span class="menu-title" data-i18n="Brand">Brand</span></a></li>
        @endcan

        @can('seller_view')
        <li class="nav-item {{ request()->is('*Seller*') ? 'active' : '' }}"><a href="{{route('admin.Seller.sellerindex')}}"><i class="fa fa-user-plus"></i><span class="menu-title" data-i18n="Task Board">Seller</span></a></li>
        @endcan

        @can('store_view')
        <li class="nav-item {{ request()->is('*store*') ? 'active' : '' }}"><a href="{{route('admin.store.index')}}"><i class="fa fa-shopping-basket"></i><span class="menu-title" data-i18n="Calendar">Store</span></a></li>
        @endcan

        @can('product_view')
        <li class="nav-item {{ request()->is('*product*') ? 'active' : '' }}"><a href="{{route('admin.product.index')}}"><i class="fa fa-product-hunt"></i><span class="menu-title" data-i18n="Calendar">Product</span></a></li>
        @endcan

        @can('membership_view')
        <li class="nav-item {{ request()->is('*Membership*') ? 'active' : '' }}"><a href="{{route('admin.Membership.membershipindex')}}"><i class="fa fa-id-card"></i><span class="menu-title" data-i18n="Calendar">Membership Plan</span></a></li>
        @endcan
      </ul>
    </div>
  </div>
  <!-- main menu content-->
  <div class="sidebar-background"></div>
</div>
