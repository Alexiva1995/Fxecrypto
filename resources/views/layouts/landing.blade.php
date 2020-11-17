<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ecrypto</title>

	<link rel="stylesheet" href="{{ asset('css/theme.css') }}">

	<link rel="stylesheet" href="{{ asset('bootstrap-4.5.0/css/bootstrap.min.css') }}">

</head>

<body>
	<div class="main">
		{{-- NAVBAR --}}
		<nav class="navbar navbar-light">
			<a class="navbar-brand" href="#">
				<img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Ecrypto" loading="lazy">
			</a>

			<!--<li class="nav-item dropdown language-li">
				<a class="nav-link dropdown-toggle language-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="{{ asset('images/flags/us.jpg') }}" class="rounded-circle" alt="Inglés" width="25" height="25"> Inglés
				</a>
				<div class="dropdown-menu language-list" aria-labelledby="navbarDropdown">
					<a class="dropdown-item language-list-item" href="#"><img src="{{ asset('images/flags/us.jpg') }}" class="rounded-circle" alt="Inglés" width="20" height="20"> Inglés</a>
					<a class="dropdown-item language-list-item" href="#"><img src="{{ asset('images/flags/es.png') }}" class="rounded-circle" alt="Español" width="20" height="20"> Español</a>
				</div>
			</li>-->
		</nav>
		{{-- FIN DEL NAVBAR --}}

		<div class="row">
			<div class="col-md-2 d-none d-xl-block" style="text-align: right; padding-left: 8%;">
				<img src="{{ asset('images/eth-icon.png') }}" id="eth-icon" alt="Etherium" loading="lazy">
			</div>

			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 smart-contract">
				<img src="{{ asset('images/smart-contract.png') }}" class="img-fluid" alt="Smart Contract" loading="lazy"><br>

				<div class="smart-contract-buttons">
					<a type="button" href="{{ route('register') }}" class="btn btn-ecrypto btn-blue-dark">REGISTRO</a><br class="d-block d-sm-none"><br class="d-block d-sm-none">
					<a type="button" href="#" class="btn btn-ecrypto btn-blue-medium">¿CÓMO FUNCIONA?</a><br class="d-block d-sm-none"><br class="d-block d-sm-none">
					<a type="button" href="{{ route('login') }}" class="btn btn-ecrypto btn-blue-light">INICIAR SESIÓN</a>
				</div>
			</div>

			<div class="col-md-2 d-none d-xl-block"></div>
		</div>

		<div class="content">
			<div class="pad-20">La forma más rápida, fácil y sin riesgos de ganar <strong>ETH</strong></div>

			<div class="pad-20">
				La descentralización del Marketing, permite generar una revolución tecnologica en forma de contrato <br />inteligente. En E-cripto nos encontramos completamente abiertos en nuestro código y es por eso que tanto la seguridad como el trabajo a largo plazo están completamente garantizados.
			</div>

			<div class="pad-20">
				<div class="first-title">¿Por qué vale la pena E-Cripto?</div>

				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-r-50 pad-b-30">
						<img src="{{ asset('images/icono-seguridad.png') }}" style="width: 180px; height: 180px;" alt="Riesgos" loading="lazy"><br><br>

						<span class="subtitle">No Corres Riesgos:</span><br>

						El costo que debes invertir en el proyecto es de tan solo 0,03 ETH, y te serán devueltos por medio de tu primer referido. No debes realizar ninguna solicitud de pago y no necesitas esperar. Tus fondos serán transferidos directamente a tu Wallet.
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-l-50 pad-b-30">
						<img src="{{ asset('images/icono-escudo.png') }}" style="width: 180px; height: 180px;" alt="Transparencia" loading="lazy"><br><br>

						<span class="subtitle">Transparencia:</span><br>

						Por medio del anonimato, E-Cripto maneja un contrato inteligente que siempre está abierto, cualquiera puede ver el código y todo el historial de transacciones. Esto garantiza unas estadísticas reales y transparentes, así como condiciones limpias y reales.
					</div>

					<div class="w-100"></div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-r-50 pad-b-30">
						<img src="{{ asset('images/icono-piramide.png') }}" style="width: 180px; height: 180px;" alt="No Somos Pirámide" loading="lazy"><br><br>

						<span class="subtitle">No Somos una Pirámide:</span><br>

						Y esto significa que no tienes que invitar personas para obtener referidos ya que nuestro sistema encuentra esos referidos para ti de forma automática.
					</div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-l-50 pad-b-30">
						<img src="{{ asset('images/icono-descentralizacion.png') }}" style="width: 180px; height: 180px;" alt="Descentralización" loading="lazy"><br><br>

						<span class="subtitle">Descentralización:</span><br>

						No existirán lideres o admnistradores, tan solo habrá creadores, y estos serán los mismos integrantes del proyecto.
					</div>

					<div class="w-100"></div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-r-50 pad-b-30">
						<img src="{{ asset('images/icono-referidos.png') }}" style="width: 180px; height: 180px;" alt="Referidos" loading="lazy"><br><br>

						<span class="subtitle">Referidos por tus Líneas Ascendentes:</span><br>

						Una vez tus líneas ascendentes se encuentren completas, habrá un desbordamiento de marketing social que te permitirá recibir referidos de tu línea ascendente.
					</div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-l-50 pad-b-30">
						<img src="{{ asset('images/icono-online.png') }}" style="width: 180px; height: 180px;" alt="Online" loading="lazy"><br><br>

						<span class="subtitle">On Line:</span><br>

						El balance del contrato siempre es igual a cero, todos los medios se mueven entre los participantes y no hay ningún tipo de costo oculto.
					</div>
				</div>

				<div class="title">Estadísticas en Vivo</div>

				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pad-t-20 pad-b-20">
						<div class="blue-card">
							<img src="{{ asset('images/icono-estadisticas-1.png') }}" style="width: 50%; height: 50%;" alt="Total de Participantes" loading="lazy"><br>

							<div class="info-blue-card">21322</div>

							<div class="description-blue-card">Total de Participantes</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="blue-card">
							<img src="{{ asset('images/icono-estadisticas-2.png') }}" style="width: 70%; height: 50%;" alt="Invitados en Línea" loading="lazy"><br>

							<div class="info-blue-card">36</div>

							<div class="description-blue-card">Invitados en Línea</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 pad-t-20">
						<div class="blue-card">
							<img src="{{ asset('images/icono-estadisticas-3.png') }}" style="width: 50%; height: 50%;" alt="Transacciones Totales" loading="lazy"><br>

							<div class="info-blue-card">42882.64 eth</div>

							<div class="description-blue-card">Transacciones Totales</div>
						</div>
					</div>
				</div>
			</div>

			<div class="title">Road Map</div>

			<div class="road-map">
				<img src="{{ asset('images/icono-road-map.png') }}" class="img-fluid" alt="Road Map">
				<div class="road-map-steps">
					<div class="row">
						<div class="col">
							<div class="road-map-step">FASE 1</div>
							<div class="road-map-description">SMART CONTRACT AUTOMÁTICO</div>
						</div>
						<div class="col">
							<div class="road-map-step">FASE 2</div>
							<div class="road-map-description">¿ALUNA VEZ TE HAN PAGADO POR HACER COMPRAS? PRÓXIMAMENTE GRAN LANZAMIENTO.</div>
							{{--<div style="font-size: 0.6em;">(Consiste en venderles el Smart Contract + Infoproducto, en el diseño se sugiere generar expectativa.)</div>--}}
						</div>
						<div class="col" style="padding-top: 6%;">
							<div class="road-map-step">FASE 3</div>
							<div class="road-map-description">¿QUIERES ENTENDER EL SECRETO DE LOS NEGOCIOS ONLINE? MUY PRONTO.</div>
							{{--<div style="font-size: 0.6em;">(Consiste en un programa educativo en Marketing Online para comercializar, en el diseño se sugiere generar expectativa.)</div>--}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="row">
				<div class="col-md-4">
					<img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Ecrypto" loading="lazy">
				</div>
				<div class="col-md-6 footer-medium-section">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="{{ route('register') }}" class="footer-link">REGISTRO</a>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="" class="footer-link">¿POR QUÉ VALE LA PENA E-CRIPTO?</a>
						</div>
						<div class="w-100"></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="" class="footer-link">¿CÓMO FUNCIONA?</a>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="" class="footer-link">¿ESTADÍSTICAS EN VIVO?</a>
						</div>
						<div class="w-100"></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="{{ route('login') }}" class="footer-link">INICIAR SESIÓN</a>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 footer-item">
							<a href="" class="footer-link">ROAD MAP</a>
						</div>
					</div>
				</div>
				<div class="col-md-2 footer-right-section">
					SÍGUENOS<br>

					<div style="padding: 20px 0;">
						<a href=""><img src="{{ asset('images/icono-fb.png') }}" class="img-fluid" alt="Facebook" loading="lazy"></a>
						<a href=""><img src="{{ asset('images/icono-whatsapp.png') }}" class="img-fluid" alt="Whatsapp" loading="lazy"></a>
						<a href=""><img src="{{ asset('images/icono-instagram.png') }}" class="img-fluid" alt="Instagram" loading="lazy"></a>
					</div>

				</div>
			</div>

		</div>

	</div>


	<script src="https://kit.fontawesome.com/d6f2727f64.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="{{ asset('bootstrap-4.5.0/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/ImageSelect.jquery.js') }}" type="text/javascript"></script>
</body>

</html>