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
            const registerButton = document.querySelector('.automatic-register');

            registerButton.addEventListener('click', () => {
                if (document.getElementById("metamask").value == 1){
                    if (document.getElementById("sponsor_id").value != ""){
                        document.getElementById("sponsor_div").style.display = 'none';
                        registrar();
                    }else{
                        document.getElementById("sponsor_div").innerHTML = '¡Debe especificar el ID del usuario que lo invitó!';
                        document.getElementById("sponsor_div").style.display = 'block';
                    }
                }else{
                    $('#metamaskModal').modal("show");
                }
            });

            async function registrar() {
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

                    //Obtengo la billetera del patrocinador
                    Contrato.methods.userIds(document.getElementById("sponsor_id").value).call()
                    .then(function(result){
                        document.getElementById("sponsor_wallet").value = result;
                        if (result == '0x0000000000000000000000000000000000000000'){
                            document.getElementById("sponsor_div").innerHTML = '¡El ID ingresado no coincide con ningún miembro!';
                            document.getElementById("sponsor_div").style.display = 'block';
                        }else{
                            document.getElementById("sponsor_div").style.display = 'none';
                            //envío la solicitud de registro con la billetera del sponsor obtenido
                            Contrato.methods.registrationExt(document.getElementById("sponsor_wallet").value).send({
                                    from: document.getElementById("address_account").value,
                                    gasPrice: '130000000000',
                                    gas: '571588',
                                    value: '60000000000000000'
                            }).then(function(result){
                                //var route = "https://www.ecryptosmart.com/save-session/"+document.getElementById("address_account");  
                                var route = "http://localhost:8000/save-session/"+document.getElementById("address_account");
                                            
                                $.ajax({
                                    url:route,
                                    type:'GET',
                                    success:function(ans){
                                        window.location= "https://www.ecryptosmart.com/dashboard";
                                    }
                                });
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
		<div style="padding-top: 20px; font-size: 37px; color: #fff;">Registro</div>

		<div class="register-auto">
			Registro automático si tiene la siguiente billetera:<br><br>

			<img src="{{ asset('images/layer_0.png') }}" class="img-fluid" loading="lazy">

		</div>

		<div class="input-div">
			<input class="form-control form-control-lg input-auth" type="text" id="sponsor_id" placeholder="Ingrese el ID de su patrocinador" autocomplete="off">
            <input type="hidden" id="sponsor_wallet">
		</div>

        <div class="alert alert-danger" role="alert" id="sponsor_div" style="display: none;">
            ¡Debe especificar el ID del usuario que lo invitó!
        </div>

		<div class="info-sponsor">
			Compruebe el ID de la persona que lo invitó. Se puede cambiar antes de que se proceda el pago.
		</div>
		
		<div class="submit-auth-div">
			<button type="button" class="btn btn-blue-gradient automatic-register" style="width: 80% !important;">Registro Automático</button>
		</div>

		<!--<div style="font-size: 18px;">
			<a href="" style="color: #fff;">Modo de Vista Previa</a>
		</div>-->
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