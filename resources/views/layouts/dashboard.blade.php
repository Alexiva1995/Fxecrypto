<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ecrypto</title>

		<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
		<link href="{{ asset('css/tree.css') }}" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset('bootstrap-4.5.0/css/bootstrap.min.css') }}">

        @stack('styles')

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

	</head>

	<body class="body-dashboard">
		<input type="hidden" id="metamask">
        <input type="hidden" id="address_account">
		{{-- NAVBAR --}}

		<div class="row">
			<div class="col-lg-3 col-xl-3 col-12 text-left header-left-div">
				<img class="img-fluid" src="{{ asset('images/logo.png') }}" width="300" alt="Ecrypto" loading="lazy">
			</div>
			<div class="col-lg-6 col-xl-6 col-md-8 col-12 text-center header-center-div">
				<div class="row" id="header-items" style="visibility: hidden;">
					<div class="col-3 text-center">
						<div class="header-items-title">TOTAL DE PARTICIPANTES</div> 
						<div class="header-items-value1" id="users_count"></div>
					</div>
					<div class="col-3 text-center">
						<div class="header-items-title">EN LAS ÚLTIMAS 24HR</div>
						<div class="header-items-value2">120</div>
					</div>
					<div class="col-3 text-center">
						<div class="header-items-title">INGRESOS TOTALES</div>
						<div class="header-items-value1">272 ETH</div>
					</div>
					<div class="col-3 text-center">
						<div class="header-items-title">INGRESOS USD</div>
						<div class="header-items-value2">8123 USD</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xl-3 col-md-4 col-12 text-right header-right-div">
				<!--<a class="dropdown-toggle language-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="{{ asset('images/flags/us.jpg') }}" class="rounded-circle" alt="Inglés" width="25" height="25"> Inglés
				</a>
				<div class="dropdown-menu language-list" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item language-list-item" href="#"><img src="{{ asset('images/flags/us.jpg') }}" class="rounded-circle" alt="Inglés" width="20" height="20"> Inglés</a>
					<a class="dropdown-item language-list-item" href="#"><img src="{{ asset('images/flags/es.png') }}" class="rounded-circle" alt="Español" width="20" height="20"> Español</a>
				</div>-->

				<a type="button" class="btn btn-ecrypto btn-logout" href="{{ route('logout') }}">CERRAR SESIÓN</a>
			</div>
		</div>
		{{-- FIN DEL NAVBAR --}}

        <div class="dashboard-content">
            @yield('content')
        </div>
		
		<script src="https://kit.fontawesome.com/d6f2727f64.js" crossorigin="anonymous"></script>
	
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('bootstrap-4.5.0/js/bootstrap.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.11/web3.min.js"></script>
        @stack('scripts')
	</body>
</html>