@extends('layouts.auth')

@push('scripts')
    <script type="text/javascript"> 
        if (typeof window.ethereum !== 'undefined') {
            document.getElementById("metamask").value = 1;
        }else{
            document.getElementById("metamask").value = 0;
        }

        if (typeof window.web3 !== "undefined" && typeof window.web3.currentProvider !== "undefined"){ 
            var web3 = new Web3 (window.web3.currentProvider); 
        }else{ 
            var web3 = new Web3(); 
        } 
                
        $(function() {
            var Contrato;
            const loginButton = document.querySelector('.login-btn');

            loginButton.addEventListener('click', () => {
                if (document.getElementById("metamask").value == 1){
                    entrar();
                }else{
                    $('#metamaskModal').modal("show");
                }
            });

            async function entrar() {
                const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
                const account = accounts[0];
                document.getElementById("address_account").value = account;

                $.getJSON('https://api.etherscan.io/api?module=contract&action=getabi&address=0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98&apikey=JEAYAMGKECBZFSX4GIKXC6DFAGUSR4716T', function (data) {
                    var contractABI = "";
                    contractABI = JSON.parse(data.result); 
                            
                    Contrato = new web3.eth.Contract(contractABI, '0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98', {
                        from: document.getElementById("address_account").value, // default from address
                        gasPrice: '5100000000' 
                    });

                    //Consulto los datos del usuario que está iniciando con su billetera Metamask
                    Contrato.methods.users(document.getElementById("address_account").value).call()
                    .then(function(result){
                    	if (result['id'] == 0){
                    		document.getElementById("error_div").style.display = 'block';
                    	}else{
                    		document.getElementById("error_div").style.display = 'none';
                    		//var route = "https://www.ecryptosmart.com/save-session/"+document.getElementById("address_account");  
				            var route = "http://localhost:8000/save-session/"+document.getElementById("address_account");
				                        
				            $.ajax({
				                url:route,
				                type:'GET',
				                success:function(ans){
				                    window.location= "https://www.ecryptosmart.com/dashboard";
				                }
				            });
                    	}
                    });
                });
            }
        });     
    </script> 
@endpush

@section('content')
	<div class="content-auth">
		<div style="padding-top: 20px; font-size: 37px; color: #fff;">Iniciar Sesión</div>

		<div class="register-auto">
			La entrada a tu oficina virtual a través de Metamask <br>
			<img src="{{ asset('images/layer_0.png') }}" class="img-fluid" loading="lazy"><br>
		</div>
		
		<div class="submit-auth-div">
			<button type="button" class="btn btn-blue-gradient login-btn" style="width: 60% !important;">Iniciar</button>
		</div>

		<div class="alert alert-danger" role="alert" id="error_div" style="display: none;">
            ¡Usted no se encuentra registrado!
        </div>

		<div style="font-size: 18px;">
			<a href="{{ route('register') }}" style="color: #4B8BFF;">Únanse si usted todavía no está con nosotros</a>
		</div>

		<div class="follow-auth-div">
			Síguenos <br>

			<a href=""><img src="{{ asset('images/icono-fb.png') }}" class="img-fluid" alt="Facebook" loading="lazy"></a>
			<a href=""><img src="{{ asset('images/icono-whatsapp.png') }}" class="img-fluid" alt="Whatsapp" loading="lazy"></a>
			<a href=""><img src="{{ asset('images/icono-instagram.png') }}" class="img-fluid" alt="Instagram" loading="lazy"></a>
		</div>
	</div>

	 <!-- Modal -->
    <div class="modal fade" id="metamaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #001437;">
                <div class="modal-body">
                    <img src="{{ asset('images/layer_0.png') }}" class="img-fluid" loading="lazy"><br><br>

                    <p style="color: white; font-size: 20px;">El sitio Ecryptosmart.com requiere el ETH monedero para la interacción con un contrato inteligente. Haga clic en el botón de abajo para descargar el monedero Metamask para el navegador</p>

                    <a href="https://metamask.io/" type="button" class="btn btn-blue-gradient">Ir a Metamask</a><hr>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Ventana</button>
                </div>
            </div>
        </div>
    </div>
@endsection