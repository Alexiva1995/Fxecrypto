<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="{{ asset('js/TronWeb.js') }}"></script>

        <script>
            const HttpProvider = TronWeb.providers.HttpProvider;
            const fullNode = new HttpProvider("https://api.trongrid.io");
            const solidityNode = new HttpProvider("https://api.trongrid.io");
            const eventServer = new HttpProvider("https://api.trongrid.io");
            const privateKey = "3481E79956D4BD95F358AC96D151C976392FC4E3FC132F78A847906DE588C145";
            const tronWeb = new TronWeb(fullNode,solidityNode,eventServer,privateKey);

            var contrato;

            async function getContract(){
                contrato = await tronWeb.contract().at("TR82peVEpXzz2a8fCuHHmAQ2358GsGnhtJ");
                console.log(contrato);

                /*res.methods.lastUserId().call().then(function(result) {
                    console.log("Resultado: "+result);
                });*/
            }
            
            async function registrarme(){
                try {
                    contrato = await tronWeb.contract().at("TR82peVEpXzz2a8fCuHHmAQ2358GsGnhtJ");
                    contrato.registrationExt(document.getElementById("wallet").value).send({
                        feeLimit:100000000,
                        callValue:0,
                        shouldPollResponse:true
                    }).then(function(result){
                        console.log(result);
                    });

                    //console.log(res);

                } catch (error) {
                    console.log(error);
                }
            }

            function gettronweb(){
                if(window.tronWeb && window.tronWeb.defaultAddress.base58){
                    document.getElementById("wallet").value = tronWeb.defaultAddress.base58;
                    getContract();
                }else{
                    console.log("Error");
                }
            }

            window.addEventListener('message', function (e) {
                if (e.data.message && e.data.message.action == "tabReply") {
                    console.log("tabReply event", e.data.message)
                    if (e.data.message.data.data.node.chain == '_'){
                        console.log("tronLink currently selects the main chain")
                    }else{
                        console.log("tronLink currently selects the side chain")
                    }
                }

                if (e.data.message && e.data.message.action == "setAccount") {
                    console.log("setAccount event", e.data.message)
                    console.log("current address:", e.data.message.data.address);
                    document.getElementById("wallet").value = e.data.message.data.address;

                }
                if (e.data.message && e.data.message.action == "setNode") {
                    console.log("setNode event", e.data.message)
                    if (e.data.message.data.node.chain == '_'){
                        console.log("tronLink currently selects the main chain")
                    }else{
                        console.log("tronLink currently selects the side chain")
                    }

                }
            })
            var obj = setInterval(async ()=>{
                if (window.tronWeb && window.tronWeb.defaultAddress.base58) {
                    clearInterval(obj)
                    let tronweb = window.tronWeb
                }
            }, 10)

        </script>
    </head>
    <body>
        <!--<button onclick="gettronweb()">Can you get tronweb from tronlink?</button>-->

        <button onclick="registrarme()">Registrarme</button>
        <input type="text" id="wallet">
    </body>
</html>