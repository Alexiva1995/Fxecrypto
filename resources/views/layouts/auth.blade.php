<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ecrypto</title>

		<link rel="stylesheet" href="{{ asset('css/theme.css') }}">

		<link rel="stylesheet" href="{{ asset('bootstrap-4.5.0/css/bootstrap.min.css') }}">
		
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
		@stack('styles')
	</head>
	<body>
		<input type="hidden" id="metamask" >
		<input type="hidden" id="address_account">
		<div class="main-auth">
			<div class="row">
				<div class="col-xl-4 col-lg-4 col-md-4 d-none d-md-block d-lg-block d-xl-block eth-icon-div">
					<img src="{{ asset('images/eth-icon.png') }}" id="eth-icon-auth" height="650" alt="Etherium" loading="lazy">
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-xl-3 col-2"></div>
						<div class="col-xl-6 col-8 content-auth-div">
							
							<div style="padding-bottom: 60px;">
								<a href="{{ route('index') }}"><img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Ecrypto" loading="lazy"></a>
							</div>
							
							@yield('content')

						</div>
						<div class="col-xl-3 col-2"></div>
					</div>
				</div>
			</div>
			
		</div>

		<script src="https://kit.fontawesome.com/d6f2727f64.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('bootstrap-4.5.0/js/bootstrap.min.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.11/web3.min.js"></script>
		
		@stack('scripts')
	</body>
</html>