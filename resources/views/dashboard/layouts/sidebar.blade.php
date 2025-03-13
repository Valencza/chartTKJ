<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
  <div id="kt_app_sidebar_menu" data-kt-menu="true" class="menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-500 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 py-4 py-lg-6 ms-lg-n7 px-2 px-lg-0">
    <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-y px-1 px-lg-5" data-kt-sticky="true" data-kt-sticky-name="app-sidebar-menu-sticky" data-kt-sticky-offset="{default: false, xl: '500px'}" data-kt-sticky-release="#kt_app_stats" data-kt-sticky-width="250px" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header, #kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="20px">
      <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
          <span class="menu-bullet">
            <i class="fa fa-home"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </div>
      <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('produk') ? 'active' : '' }}" href="{{ route('produk') }}">
          <span class="menu-bullet">
            <i class="fa fa-shopping-bag"></i>
          </span>
          <span class="menu-title">Produk Kami</span>
        </a>
      </div>
      <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
        <span class="menu-link">
          <span class="menu-bullet">
            <i class="bi bi-grid-fill"></i>
          </span>
          <span class="menu-title">Kategori</span>
          <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion ">
          <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('kategoriProduk') ? 'active' : '' }}" href="{{route ('kategoriProduk') }}">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Kategori Produk</span>
            </a>
          </div>
          <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('kategoriJasa') ? 'active' : '' }}" href="{{route ('kategoriJasa') }}">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Kategori Jasa<span>
            </a>
          </div>
          <div class="menu-item">
            <a class="menu-link {{ request()->routeIs('kategoriBarang') ? 'active' : '' }}" href="{{route ('kategoriBarang') }}">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Kategori Barang<span>
            </a>
          </div>
        </div>
      </div>
      <!-- <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('portofolio') ? 'active' : '' }}" href="{{ route('portofolio') }}">
          <span class="menu-bullet">
            <i class="fa fa-briefcase"></i>
          </span>
          <span class="menu-title">Portofolio Kami</span>
        </a>
      </div> -->
      <div class="menu-item">
        <a class="menu-link {{ request()->routeIs('order') ? 'active' : '' }}" href="{{ route('order') }}">
          <span class="menu-bullet">
            <i class="fa fa-tools"></i>
          </span>
          <span class="menu-title">Orders</span>
        </a>
      </div>
      <!-- <div class="menu-item">
        <a class="menu-link" href="#">
          <span class="menu-bullet">
            <i class="fa fa-tools"></i>
          </span>
          <span class="menu-title">Service</span>
        </a>
      </div> -->
    </div>
  </div>
</div>