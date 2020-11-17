@extends('layouts.dashboard')

@push('scripts')
<script type="text/javascript">
    if (typeof window.ethereum !== 'undefined') {
        document.getElementById("metamask").value = 1;
    } else {
        document.getElementById("metamask").value = 0;
    }

    if (typeof window.web3 !== "undefined" && typeof window.web3.currentProvider !== "undefined") {
        var web3 = new Web3(window.web3.currentProvider);
    } else {
        var web3 = new Web3();
    }

    $(function() {
        if (document.getElementById("metamask").value == 0) {
            window.location = "http://localhost:8000/register";
        } else {
            var Contrato;
            //var route = "https://www.ecryptosmart.com/check-session";
            var route = "http://localhost:8000/check-session";
            $.ajax({
                url: route,
                type: 'GET',
                success: function(ans) {
                    if (ans == false) {
                        window.location = "http://localhost:8000/login";
                    } else {
                        document.getElementById("address_account").value = ans;
                        $('.carousel').carousel({{$level-1}});
                        getData();
                    }
                }
            });
        }

        function getData() {
            $.getJSON('https://api.etherscan.io/api?module=contract&action=getabi&address=0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98&apikey=JEAYAMGKECBZFSX4GIKXC6DFAGUSR4716T', function(data) {
                var contractABI = "";
                contractABI = JSON.parse(data.result);

                Contrato = new web3.eth.Contract(contractABI, '0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98', {
                    from: document.getElementById("address_account").value, // default from address
                    //gasPrice: '5100000000' 
                });

                Contrato.methods.lastUserId().call().then(function(result) {
                    document.getElementById("users_count").innerHTML = result;
                    //Obtengo los datos del usuario en sessión
                    Contrato.methods.users(document.getElementById("address_account").value).call().then(function(result) {
                        //campo result['referrer'] es la address de mi sponsor
                        document.getElementById("user_id").innerHTML = 'ID ' + result['id'];
                        document.getElementById("user_referred").innerHTML = result['partnersCount'] + ' <i class="fa fa-users"></i>';
                        Contrato.methods.balances(document.getElementById("address_account").value).call().then(function(result) {
                            document.getElementById("user_balance_eth").innerHTML = result + ' ETH';
                            Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, {{$level}}).call().then(function(result) {
                                if (result == true){
                                    Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, {{$level}}).call().then(function(result) {
                                        drawReferrers({{$level}}, result[1].length);
                                    });
                                }
                            });
                        });
                    });
                });
                document.getElementById("header-items").style.visibility = 'visible';
                document.getElementById("content-dashboard").style.visibility = 'visible';
            });
        }

        function drawReferrers($level, $cantReferrers){
            if ($cantReferrers == 1){
                $("#referrer-1").addClass("bo-circle-1");
            }else if ($cantReferrers == 2){
                $("#referrer-1").addClass("bo-circle-1");
                $("#referrer-2").addClass("bo-circle-2");
            }else if ($cantReferrers == 3){
                $("#referrer-1").addClass("bo-circle-1");
                $("#referrer-2").addClass("bo-circle-2");
                $("#referrer-3").addClass("bo-circle-3");
            }
        }
    });
</script>
@endpush

@section('content')
    <div class="row" id="content-dashboard" style="visibility: hidden">
        <div class="col-12 col-xl-3 col-lg-4 pb-3">
            <div class="card card-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-xl-5 col-lg-5 col-md-5 card-info-img-div text-right">
                            <img src="{{ asset('images/bo-icono-eth.png') }}" class="card-info-img">
                        </div>
                        <div class="col-6 col-xl-7 col-lg-7 col-md-7 card-info-text-div text-left">
                            <span id="user_id"></span><br>
                            <span id="user_referred"></span><br>
                            <span id="user_balance_usd">0 USD</span><br>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-12 text-center pt-4">
                            <a type="button" href="#" class="btn btn-ecrypto btn-gradient-balance-eth" id="user_balance_eth"></a>
                        </div>

                        <div class="col-12 text-center pt-3">
                            <div class="card-info-item-title pb-2"> SMART BUSINESS 3</div>
                            <div class="row">
                                <div class="col pr-1">
                                    <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-eth card-info-btn">0.0234 ETH</a>
                                </div>
                                <div class="col pl-1">
                                    <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-usd card-info-btn">60 USD</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center pt-3">
                            <div class="card-info-item-title pb-2"> ENLACE DE AFILIADO</div>
                            <div class="row">
                                <div class="col">
                                    <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-eth card-info-btn"><i class="fa fa-copy"></i> 63FA54213HFDRSGTTFG737</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center pt-3 card-info-follow-div">
                            SÍGUENOS<br>
                            <a href=""><img src="{{ asset('images/icono-fb.png') }}" class="img-fluid" width="20" alt="Facebook" loading="lazy"></a>
                            <a href=""><img src="{{ asset('images/icono-whatsapp.png') }}" class="img-fluid" width="20" alt="Whatsapp" loading="lazy"></a>
                            <a href=""><img src="{{ asset('images/icono-instagram.png') }}" class="img-fluid" width="20" alt="Instagram" loading="lazy"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-12 col-xl-9 col-lg-8">
            <div class="box-right">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-12 bo-st-title-big"> ST <span class="bo-st-title-number-big">{{ $level }}</span></div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-left-div">
                                    <img src="{{ asset('images/bo-'.$level.'.png') }}" class="bo-st-big-img">
                                    <div class="pt-3 text-center">
                                        <button type="button" href="#" class="btn btn-ecrypto btn-gradient-light"><i class="fa fa-arrow-up"></i> ID 1</button>
                                    </div>
                                    <div class="pt-2 text-center bo-st-big-user-id">
                                        ID 123
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-center-div">
                                    <div class="bo-st-big-eth-balance">0.045 ETH</div>

                                    <div class="row bo-circles-big-div">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle-big" id="referrer-1"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big" id="referrer-2"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big" id="referrer-3"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bo-st-info-big">
                                        <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-right-div">
                                    <div class="bo-st-big-card-balance">
                                        $ 0 USD<br>
                                        0.0000 ETH
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="carousel-item">
                             <div class="row">
                                <div class="col-12 bo-st-title-big"> ST <span class="bo-st-title-number-big">2</span></div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-left-div">
                                    <img src="{{ asset('images/bo-2.png') }}" class="bo-st-big-img">
                                    <div class="pt-3 text-center">
                                        <button type="button" href="#" class="btn btn-ecrypto btn-gradient-light"><i class="fa fa-arrow-up"></i> ID 1</button>
                                    </div>
                                    <div class="pt-2 text-center bo-st-big-user-id">
                                        ID 123
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-center-div">
                                    <div class="bo-st-big-eth-balance">0.045 ETH</div>

                                    <div class="row bo-circles-big-div">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle-big bo-circle-1"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big bo-circle-2"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big bo-circle-3"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bo-st-info-big">
                                        <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-right-div">
                                    <div class="bo-st-big-card-balance">
                                        $ 0 USD<br>
                                        0.0000 ETH
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                             <div class="row">
                                <div class="col-12 bo-st-title-big"> ST <span class="bo-st-title-number-big">3</span></div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-left-div">
                                    <img src="{{ asset('images/bo-3.png') }}" class="bo-st-big-img">
                                    <div class="pt-3 text-center">
                                        <button type="button" href="#" class="btn btn-ecrypto btn-gradient-light"><i class="fa fa-arrow-up"></i> ID 1</button>
                                    </div>
                                    <div class="pt-2 text-center bo-st-big-user-id">
                                        ID 123
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-center-div">
                                    <div class="bo-st-big-eth-balance">0.045 ETH</div>

                                    <div class="row bo-circles-big-div">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle-big bo-circle-1"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big bo-circle-2"></label>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div>
                                                <label class="bo-circle-big bo-circle-3"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bo-st-info-big">
                                        <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-center bo-st-big-right-div">
                                    <div class="bo-st-big-card-balance">
                                        $ 0 USD<br>
                                        0.0000 ETH
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    @if ($level != 1)
                        <a class="carousel-control-prev" href="{{ route('smart-business-3-details', $level-1) }}" role="button">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="padding-left: 0 !important; margin-left: 0 !important;"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    @endif
                    @if ($level != 12)
                        <a class="carousel-control-next" href="{{ route('smart-business-3-details', $level+1) }}" role="button">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection