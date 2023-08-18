<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>{{ $title ?? '' }} : E-Masjid</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">E-Masjid</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu Utama
					</li>

					<li class="sidebar-item {{ Route::is('home') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('home') }}">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('masjid.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('masjid.create') }}">
							<i class="fa-solid fa-bank align-middle"></i> <span class="align-middle">Data Masjid</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('kas.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('kas.index') }}">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Kas Masjid</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('profil.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('profil.index') }}">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil Masjid</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('kategori.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('kategori.index') }}">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Kategori Informasi</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('informasi.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('informasi.index') }}">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Informasi Masjid</span>
						</a>
					</li>

					<li class="sidebar-item {{ Route::is('masjidbank.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('masjidbank.index') }}">
							<i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Data Bank</span>
						</a>
					</li>
					
					<li class="sidebar-item {{ Route::is('kurban.*') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('kurban.index') }}">
							<i class="fa-solid fa-cow align-middle"></i> <span class="align-middle">Data Kurban</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<h4 class="ml-2 fw-bold">{{ auth()->user()->masjid?->nama }}</h4>
						</li>
					</ul>
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="{{ asset('images/avatar.png') }}" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->name }}" /> 
								<span class="text-dark">{{ auth()->user()->name }}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('userprofil.edit', 0) }}"><i class="align-middle me-1" data-feather="user"></i> Ubah Profil</a>
								<a class="dropdown-item" href="{{ route('logout-user') }}">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					@include('flash::message')
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@yield('content')

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('adminkit/js/app.js') }}"></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

	<!-- include summernote css/js-->
	<script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('sm/summernote-bs4.css') }}" rel="stylesheet">
    <script src="{{ asset('sm/summernote-bs4.js') }}"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://kit.fontawesome.com/ad369635ad.js" crossorigin="anonymous"></script>
	
	<script>
		$(document).ready(function () {
			$('.select2').select2();
			$('#summernote').summernote({
				tabsize: 2,
				height: 100
			});
			$('.rupiah').mask("#.##0", {
				reverse: true
			});
		});
	</script>
	@yield('js')
</body>

</html>