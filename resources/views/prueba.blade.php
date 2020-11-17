<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
            
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.2.11/web3.min.js"></script>

            <script type="text/javascript">   
                if (typeof window.web3 !== "undefined" && typeof window.web3.currentProvider !== "undefined"){ 
                    var web3 = new Web3 (window.web3.currentProvider); 
                }else{ 
                    var web3 = new Web3(); 
                } 
                
                $(function() {
                    const idButton = document.querySelector('.idButton');
                    const registerButton = document.querySelector('.registerButton');
                    const usersButton = document.querySelector('.usersButton');
                    const balanceButton = document.querySelector('.balanceButton');
                    const ownerButton = document.querySelector('.ownerButton');
                    var Contrato;

                    getAccount();

                    idButton.addEventListener('click', () => {
                        obtenerWallet();
                    });

                    registerButton.addEventListener('click', () => {
                        registrar();
                    });

                    usersButton.addEventListener('click', () => {
                        infoUsuario();
                    });

                    balanceButton.addEventListener('click', () => {
                        balance();
                    });

                    ownerButton.addEventListener('click', () => {
                        owner();
                    });

                    async function getAccount() {
                        const accounts = await ethereum.request({ method: 'eth_requestAccounts' });
                        const account = accounts[0];
                        document.getElementById("address_account").value = account;

                        $.getJSON('https://api.etherscan.io/api?module=contract&action=getabi&address=0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98&apikey=JEAYAMGKECBZFSX4GIKXC6DFAGUSR4716T', function (data) {
                            var contractABI = "";
                            contractABI = JSON.parse(data.result); 
                            
                            Contrato = new web3.eth.Contract(contractABI, '0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98', {
                                from: document.getElementById("address_account").value, // default from address
                                gasPrice: '30000000' // default gas price in wei, 20 gwei in this case
                            });
                        });
                    }

                    function obtenerWallet(){
                        var wallet = Contrato.methods.userIds(document.getElementById("id").value).call()
                                        .then(function(result){
                                            document.getElementById("walletReferred").value = result;
                                        });
                    }

                    function registrar(){
                        var registro = Contrato.methods.registrationExt(document.getElementById("walletReferred").value).send()
                                        .then(function(result){
                                            console.log(result);
                                        });
                    }

                    function infoUsuario(){
                        var info = Contrato.methods.users(document.getElementById("wallet").value).call()
                                        .then(function(result){
                                            document.getElementById("info").innerHTML = "ID de Usuario: "+result['id']+" <br> Patrocinador: "+result['referrer']+"<br> Referidos: "+result['partnersCount'];
                                        });
                    }

                    function balance(){
                        var balance = Contrato.methods.balances(document.getElementById("wallet2").value).call()
                                        .then(function(result){
                                            document.getElementById("info-balance").innerHTML = result+" eth";
                                        });
                    }

                    function owner(){
                        var owner = Contrato.methods.owner().call().then(function(result){
                            document.getElementById("info-owner").innerHTML = result;
                        });
                    }
                }); 
            </script> 

        </head> 
        <body>
            <input type="hidden" id="address_account">

            <label>Función que devuelve Owner</label>
            <button class="ownerButton">Probar</button><br>
            <div id="info-owner"></div><hr>
            
            <label>Función que obtiene la billetera desde un ID de usuario </label><br><br>
            ID del Usuario: <input type="text" id="id"/>
            <button class="idButton">Obtener Billetera</button><br><hr>

            <label>Función para registrar (Necesita el wallet del patrocinador) </label><br><br>
            Wallet Patrocinador: <input type="text" id="walletReferred"/>
            <button class="registerButton">Registrarme</button><br><hr>
            
            <label>Función que devuelve la información de un usuario a partir de su billetera (Obtengo id de usuario y personas por debajo de mi red) </label><br><br>
            Billetera de Usuario: <input type="text" id="wallet"/>
            <button class="usersButton">Consultar</button><br>
            <div id="info"></div><hr>

            <label>Función que devuelve el balance en ethers de un usuario a partir de su billetera</label><br><br>
            Billetera de Usuario: <input type="text" id="wallet2"/>
            <button class="balanceButton">Consultar</button><br>
            <div id="info-balance"></div><hr>

        </body>
</html>

