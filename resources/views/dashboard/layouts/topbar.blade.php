<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
	<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
		<div class="app-header-logo d-flex align-items-center me-lg-9">
			<a href="{{route ('dashboard') }}">
				<!-- Logo untuk Desktop dan iPad -->
				<img alt="Logo" src="{{asset ('assets/admin/media/logoo.png') }}" class="logo-desktop h-40px h-lg-44px mt-1 theme-light-show" />
				<img alt="Logo" src="{{asset ('assets/admin/media/logoo.png') }}" class="logo-desktop h-40px h-lg-44px theme-dark-show" />

				<!-- Logo untuk Mobile -->
				<img alt="Logo Mobile" src="{{asset ('assets/admin/media/logo icon.png') }}" class="logo-mobile h-40px h-lg-44px mt-1 theme-light-show" />
				<img alt="Logo Mobile" src="{{asset ('assets/admin/media/logo icon.png') }}" class="logo-mobile h-40px h-lg-44px theme-dark-show" />
			</a>
		</div>
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
			</div>
			<div class="app-navbar flex-shrink-0">
				<div class="app-navbar-item ms-1 ms-lg-4" id="kt_header_user_menu_toggle">
					<div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
						<img class="symbol symbol-35px symbol-md-40px" src="{{ Auth::user()->gambar ?? asset('assets/user/img/digireads-assets/default.png') }}"
							onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"
							alt="profile" />
					</div>
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
						<div class="menu-item px-3">
							<div class="menu-content d-flex align-items-center px-3">
								<div class="symbol symbol-50px me-5">
									<img alt="Logo" src="{{ Auth::user()->gambar ?? asset('assets/user/img/digireads-assets/default.png') }}"
										onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"
										alt="profile" />
								</div>
								<div class="d-flex flex-column">
									<div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->nama ?? 'Nama Tidak Tersedia' }}
										<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->role ?? 'Guest' }}</span>
									</div>
									<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email ?? 'Email Tidak Tersedia' }}</a>
								</div>
							</div>
						</div>
						<div class="separator my-2"></div>
						<div class="menu-item px-5">
							<a href="{{route ('pengaturan-akun') }}" class="menu-link keluar px-5">Setting Akun</a>
						</div>
						<div class="separator my-2"></div>
						<div class="menu-item px-5">
							<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							<a href="#" class="menu-link keluar px-5" id="btnLogout">Keluar</a>
						</div>
					</div>
				</div>
				<div class="app-navbar-item d-flex align-items-center d-lg-none ms-1 me-n2">
					<a href="#" class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
						<i class="ki-outline ki-abstract-14 fs-1"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>