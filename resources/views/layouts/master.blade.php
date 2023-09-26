<!DOCTYPE html>
<html lang="tr" data-theme="dark">
	<!--begin::Head-->
	<head>
          @include('layouts.head')
          @yield('head')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">
		<!--begin::Main-->
         @include('layouts.headMobile')
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
			    @include('layouts.sidebar')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					@include('layouts.header')
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						@include('layouts.subheader')
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
							   @yield('content')
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
				        @include('layouts.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->

       @include('layouts.script')
       @yield('footer')
        @if ($toastr = session('toastr'))
            <!-- Toastr Session -->
            <script> $(function () { toastr.{{ $toastr[0] }}("{!! $toastr[1] !!}") }); </script>
        @endif
	</body>
	<!--end::Body-->
</html>
