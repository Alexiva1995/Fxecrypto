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
                        document.getElementById("wallet_address").innerHTML = '<i class="fa fa-wallet"></i> ' + document.getElementById("address_account").value;
                        Contrato.methods.balances(document.getElementById("address_account").value).call().then(function(result) {
                            document.getElementById("user_balance_eth").innerHTML = result + ' ETH';
                            //MATRIZ SMART BUSINESS 3 
                            drawX3Matrix();
                            //MATRIZ SMART BUSINESS 6 
                            drawX6Matrix();
                        });
                    });
                });
                document.getElementById("header-items").style.visibility = 'visible';
                document.getElementById("content-dashboard").style.visibility = 'visible';
            });
        }

        function drawX3Matrix() {
            //ST-1 
            Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 1).call().then(function(result) {
                drawReferrers(1, result[1].length);
                //ST-2 
                Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 2).call().then(function(result) {
                    if (result == true) {
                        $("#x3-level-2").removeClass("new-level");
                        $("#x3-level-2").attr('href', 'http://localhost:8000/dashboard/smart-business-3/2');
                        $("#bo-st-card-2").removeClass("bo-st-card-disabled");
                        Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 2).call().then(function(result) {
                            drawReferrers(2, result[1].length);
                            //ST-3
                            Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 3).call().then(function(result) {
                                if (result == true) {
                                    $("#x3-level-3").removeClass("new-level");
                                    $("#x3-level-3").attr('href', 'http://localhost:8000/dashboard/smart-business-3/3');
                                    $("#bo-st-card-3").removeClass("bo-st-card-disabled");
                                    Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 3).call().then(function(result) {
                                        drawReferrers(3, result[1].length);
                                        //ST-4
                                        Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 4).call().then(function(result) {
                                            if (result == true) {
                                                $("#x3-level-4").removeClass("new-level");
                                                $("#x3-level-4").attr('href', 'http://localhost:8000/dashboard/smart-business-3/4');
                                                $("#bo-st-card-4").removeClass("bo-st-card-disabled");
                                                Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 4).call().then(function(result) {
                                                    drawReferrers(4, result[1].length);
                                                    //ST-5
                                                    Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 5).call().then(function(result) {
                                                        if (result == true) {
                                                            $("#x3-level-5").removeClass("new-level");
                                                            $("#x3-level-5").attr('href', 'http://localhost:8000/dashboard/smart-business-3/5');
                                                            $("#bo-st-card-5").removeClass("bo-st-card-disabled");
                                                            Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 5).call().then(function(result) {
                                                                drawReferrers(5, result[1].length);
                                                                //ST-6
                                                                Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 6).call().then(function(result) {
                                                                    if (result == true) {
                                                                        $("#x3-level-6").removeClass("new-level");
                                                                        $("#x3-level-6").attr('href', 'http://localhost:8000/dashboard/smart-business-3/6');
                                                                        $("#bo-st-card-6").removeClass("bo-st-card-disabled");
                                                                        Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 6).call().then(function(result) {
                                                                            drawReferrers(6, result[1].length);
                                                                            //ST-7
                                                                            Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 7).call().then(function(result) {
                                                                                if (result == true) {
                                                                                    $("#x3-level-7").removeClass("new-level");
                                                                                    $("#x3-level-7").attr('href', 'http://localhost:8000/dashboard/smart-business-3/7');
                                                                                    $("#bo-st-card-7").removeClass("bo-st-card-disabled");
                                                                                    Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 7).call().then(function(result) {
                                                                                        drawReferrers(7, result[1].length);
                                                                                        //ST-8
                                                                                        Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 8).call().then(function(result) {
                                                                                            if (result == true) {
                                                                                                $("#x3-level-8").removeClass("new-level");
                                                                                                $("#x3-level-8").attr('href', 'http://localhost:8000/dashboard/smart-business-3/8');
                                                                                                $("#bo-st-card-8").removeClass("bo-st-card-disabled");
                                                                                                Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 8).call().then(function(result) {
                                                                                                    drawReferrers(8, result[1].length);
                                                                                                    //ST-9
                                                                                                    Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 9).call().then(function(result) {
                                                                                                        if (result == true) {
                                                                                                            $("#x3-level-9").removeClass("new-level");
                                                                                                            $("#x3-level-9").attr('href', 'http://localhost:8000/dashboard/smart-business-3/9');
                                                                                                            $("#bo-st-card-9").removeClass("bo-st-card-disabled");
                                                                                                            Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 9).call().then(function(result) {
                                                                                                                drawReferrers(9, result[1].length);
                                                                                                                //ST-10
                                                                                                                Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 10).call().then(function(result) {
                                                                                                                    if (result == true) {
                                                                                                                        $("#x3-level-10").removeClass("new-level");
                                                                                                                        $("#x3-level-10").attr('href', 'http://localhost:8000/dashboard/smart-business-3/10');
                                                                                                                        $("#bo-st-card-10").removeClass("bo-st-card-disabled");
                                                                                                                        Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 10).call().then(function(result) {
                                                                                                                            drawReferrers(10, result[1].length);
                                                                                                                            //ST-11
                                                                                                                            Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 11).call().then(function(result) {
                                                                                                                                if (result == true) {
                                                                                                                                    $("#x3-level-11").removeClass("new-level");
                                                                                                                                    $("#x3-level-11").attr('href', 'http://localhost:8000/dashboard/smart-business-3/11');
                                                                                                                                    $("#bo-st-card-11").removeClass("bo-st-card-disabled");
                                                                                                                                    Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 11).call().then(function(result) {
                                                                                                                                        drawReferrers(11, result[1].length);
                                                                                                                                        //ST-12
                                                                                                                                        Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, 12).call().then(function(result) {
                                                                                                                                            if (result == true) {
                                                                                                                                                $("#x3-level-12").removeClass("new-level");
                                                                                                                                                $("#x3-level-12").attr('href', 'http://localhost:8000/dashboard/smart-business-3/12');
                                                                                                                                                $("#bo-st-card-12").removeClass("bo-st-card-disabled");
                                                                                                                                                Contrato.methods.usersX3Matrix(document.getElementById("address_account").value, 12).call().then(function(result) {
                                                                                                                                                    drawReferrers(12, result[1].length);
                                                                                                                                                });
                                                                                                                                            }
                                                                                                                                        });
                                                                                                                                        //FIN ST-12
                                                                                                                                    });
                                                                                                                                }
                                                                                                                            });
                                                                                                                            //FIN ST-11
                                                                                                                        });
                                                                                                                    }
                                                                                                                });
                                                                                                                //FIN ST-10
                                                                                                            });
                                                                                                        }
                                                                                                    });
                                                                                                    //FIN ST-9
                                                                                                });
                                                                                            }
                                                                                        });
                                                                                        //FIN ST-8
                                                                                    });
                                                                                }
                                                                            });
                                                                            //FIN ST-7
                                                                        });
                                                                    }
                                                                });
                                                                //FIN ST-6
                                                            });
                                                        }
                                                    });
                                                    //FIN ST-5
                                                });
                                            }
                                        });
                                        //FIN ST-4
                                    });
                                }
                            });
                            //FIN ST-3
                        });
                    }
                });
                //FIN ST-2
            });
        }

        function drawX6Matrix() {
            //ST-1 
            Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 1).call().then(function(result) {
                drawReferrersX6(1, result[1].length, result[2].length);
                //ST-2 
                Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 2).call().then(function(result) {
                    if (result == true) {
                        $("#x6-level-2").removeClass("new-level");
                        $("#x6-level-2").attr('href', 'http://localhost:8000/dashboard/smart-business-6/2');
                        $("#bo-st-card-x6-2").removeClass("bo-st-card-disabled");
                        Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 2).call().then(function(result) {
                            drawReferrersX6(2, result[1].length, result[2].length);
                            //ST-3
                            Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 3).call().then(function(result) {
                                if (result == true) {
                                    $("#x6-level-3").removeClass("new-level");
                                    $("#x6-level-3").attr('href', 'http://localhost:8000/dashboard/smart-business-6/3');
                                    $("#bo-st-card-x6-3").removeClass("bo-st-card-disabled");
                                    Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 3).call().then(function(result) {
                                        drawReferrersX6(3, result[1].length, result[2].length);
                                        //ST-4
                                        Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 4).call().then(function(result) {
                                            if (result == true) {
                                                $("#x6-level-4").removeClass("new-level");
                                                $("#x6-level-4").attr('href', 'http://localhost:8000/dashboard/smart-business-6/4');
                                                $("#bo-st-card-x6-4").removeClass("bo-st-card-disabled");
                                                Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 4).call().then(function(result) {
                                                    drawReferrersX6(4, result[1].length, result[2].length);
                                                    //ST-5
                                                    Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 5).call().then(function(result) {
                                                        if (result == true) {
                                                            $("#x6-level-5").removeClass("new-level");
                                                            $("#x6-level-5").attr('href', 'http://localhost:8000/dashboard/smart-business-6/5');
                                                            $("#bo-st-card-x6-5").removeClass("bo-st-card-disabled");
                                                            Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 5).call().then(function(result) {
                                                                drawReferrersX6(5, result[1].length, result[2].length);
                                                                //ST-6
                                                                Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 6).call().then(function(result) {
                                                                    if (result == true) {
                                                                        $("#x6-level-6").removeClass("new-level");
                                                                        $("#x6-level-6").attr('href', 'http://localhost:8000/dashboard/smart-business-6/6');
                                                                        $("#bo-st-card-x6-6").removeClass("bo-st-card-disabled");
                                                                        Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 6).call().then(function(result) {
                                                                            drawReferrersX6(6, result[1].length, result[2].length);
                                                                            //ST-7
                                                                            Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 7).call().then(function(result) {
                                                                                if (result == true) {
                                                                                    $("#x6-level-7").removeClass("new-level");
                                                                                    $("#x6-level-7").attr('href', 'http://localhost:8000/dashboard/smart-business-6/7');
                                                                                    $("#bo-st-card-x6-7").removeClass("bo-st-card-disabled");
                                                                                    Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 7).call().then(function(result) {
                                                                                        drawReferrersX6(7, result[1].length, result[2].length);
                                                                                        //ST-8
                                                                                        Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 8).call().then(function(result) {
                                                                                            if (result == true) {
                                                                                                $("#x6-level-8").removeClass("new-level");
                                                                                                $("#x6-level-8").attr('href', 'http://localhost:8000/dashboard/smart-business-6/8');
                                                                                                $("#bo-st-card-x6-8").removeClass("bo-st-card-disabled");
                                                                                                Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 8).call().then(function(result) {
                                                                                                    drawReferrersX6(8, result[1].length, result[2].length);
                                                                                                    //ST-9
                                                                                                    Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 9).call().then(function(result) {
                                                                                                        if (result == true) {
                                                                                                            $("#x6-level-9").removeClass("new-level");
                                                                                                            $("#x6-level-9").attr('href', 'http://localhost:8000/dashboard/smart-business-6/9');
                                                                                                            $("#bo-st-card-x6-9").removeClass("bo-st-card-disabled");
                                                                                                            Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 9).call().then(function(result) {
                                                                                                                drawReferrersX6(9, result[1].length, result[2].length);
                                                                                                                //ST-10
                                                                                                                Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 10).call().then(function(result) {
                                                                                                                    if (result == true) {
                                                                                                                        $("#x6-level-10").removeClass("new-level");
                                                                                                                        $("#x6-level-10").attr('href', 'http://localhost:8000/dashboard/smart-business-6/10');
                                                                                                                        $("#bo-st-card-x6-10").removeClass("bo-st-card-disabled");
                                                                                                                        Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 10).call().then(function(result) {
                                                                                                                            drawReferrersX6(10, result[1].length, result[2].length);
                                                                                                                            //ST-11
                                                                                                                            Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 11).call().then(function(result) {
                                                                                                                                if (result == true) {
                                                                                                                                    $("#x6-level-11").removeClass("new-level");
                                                                                                                                    $("#x6-level-11").attr('href', 'http://localhost:8000/dashboard/smart-business-6/11');
                                                                                                                                    $("#bo-st-card-x6-11").removeClass("bo-st-card-disabled");
                                                                                                                                    Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 11).call().then(function(result) {
                                                                                                                                        drawReferrersX6(11, result[1].length, result[2].length);
                                                                                                                                        //ST-12
                                                                                                                                        Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, 12).call().then(function(result) {
                                                                                                                                            if (result == true) {
                                                                                                                                                $("#x6-level-12").removeClass("new-level");
                                                                                                                                                $("#x6-level-12").attr('href', 'http://localhost:8000/dashboard/smart-business-6/12');
                                                                                                                                                $("#bo-st-card-x6-12").removeClass("bo-st-card-disabled");
                                                                                                                                                Contrato.methods.usersX6Matrix(document.getElementById("address_account").value, 12).call().then(function(result) {
                                                                                                                                                    drawReferrersX6(12, result[1].length, result[2].length);
                                                                                                                                                });
                                                                                                                                            }
                                                                                                                                        });
                                                                                                                                        //FIN ST-12
                                                                                                                                    });
                                                                                                                                }
                                                                                                                            });
                                                                                                                            //FIN ST-11
                                                                                                                        });
                                                                                                                    }
                                                                                                                });
                                                                                                                //FIN ST-10
                                                                                                            });
                                                                                                        }
                                                                                                    });
                                                                                                    //FIN ST-9
                                                                                                });
                                                                                            }
                                                                                        });
                                                                                        //FIN ST-8
                                                                                    });
                                                                                }
                                                                            });
                                                                            //FIN ST-7
                                                                        });
                                                                    }
                                                                });
                                                                //FIN ST-6
                                                            });
                                                        }
                                                    });
                                                    //FIN ST-5
                                                });
                                            }
                                        });
                                        //FIN ST-4
                                    });
                                }
                            });
                            //FIN ST-3
                        });
                    }
                });
                //FIN ST-2
            });
        }

        function drawReferrers($level, $cantReferrers) {
            if ($cantReferrers == 1) {
                $("#x3-st" + $level + "-1").addClass("bo-circle-1");
            } else if ($cantReferrers == 2) {
                $("#x3-st" + $level + "-1").addClass("bo-circle-1");
                $("#x3-st" + $level + "-2").addClass("bo-circle-2");
            } else if ($cantReferrers == 3) {
                $("#x3-st" + $level + "-1").addClass("bo-circle-1");
                $("#x3-st" + $level + "-2").addClass("bo-circle-2");
                $("#x3-st" + $level + "-3").addClass("bo-circle-3");
            }
        }

        function drawReferrersX6($level, $cantReferrersLeft, $cantReferrersRight) {
            if ($cantReferrersLeft == 1) {
                $("#x6-st" + $level + "-1").addClass("bo-circle-x6-1");
            } else if ($cantReferrersLeft == 2) {
                $("#x6-st" + $level + "-1").addClass("bo-circle-x6-1");
                $("#x6-st" + $level + "-2").addClass("bo-circle-x6-2");
            } else if ($cantReferrersLeft == 3) {
                $("#x6-st" + $level + "-1").addClass("bo-circle-x6-1");
                $("#x6-st" + $level + "-2").addClass("bo-circle-x6-2");
                $("#x6-st" + $level + "-3").addClass("bo-circle-x6-3");
            }

            if ($cantReferrersRight == 1) {
                $("#x6-st" + $level + "-4").addClass("bo-circle-x6-4");
            } else if ($cantReferrersRight == 2) {
                $("#x6-st" + $level + "-4").addClass("bo-circle-x6-4");
                $("#x6-st" + $level + "-5").addClass("bo-circle-x6-5");
            } else if ($cantReferrersRight == 3) {
                $("#x6-st" + $level + "-4").addClass("bo-circle-x6-4");
                $("#x6-st" + $level + "-5").addClass("bo-circle-x6-5");
                $("#x6-st" + $level + "-6").addClass("bo-circle-x6-6");
            }
        }

        $(".new-level").on('click', function() {
            var id = $(this).attr('id').split("-");
            var level = id[2];
            if (id[0] == 'x3') {
                var matrix = 1;
                var sb = 3;
            } else {
                var matrix = 2;
                var sb = 6;
            }

            if (matrix == 1) {
                Contrato.methods.usersActiveX3Levels(document.getElementById("address_account").value, level - 1).call().then(function(result) {
                    if (result == true) {
                        Contrato.methods.levelPrice(level).call().then(function(result) {
                            document.getElementById("matrix").value = matrix;
                            document.getElementById("new-level").value = level;
                            document.getElementById("modal-level").innerHTML = level + " del SMART BUSINESS " + sb;
                            document.getElementById("new-level-price").value = result;
                            document.getElementById("modal-amount").innerHTML = (result / 1000000000000000000);
                            $('#buyLevelModal').modal("show");
                        });
                    } else {
                        $('#lockLevelModal').modal("show");
                    }
                });
            } else {
                Contrato.methods.usersActiveX6Levels(document.getElementById("address_account").value, level - 1).call().then(function(result) {
                    if (result == true) {
                        Contrato.methods.levelPrice(level).call().then(function(result) {
                            document.getElementById("matrix").value = matrix;
                            document.getElementById("new-level").value = level;
                            document.getElementById("modal-level").innerHTML = level + " del SMART BUSINESS " + sb;
                            document.getElementById("new-level-price").value = result;
                            document.getElementById("modal-amount").innerHTML = (result / 1000000000000000000);
                            $('#buyLevelModal').modal("show");
                        });
                    } else {
                        $('#lockLevelModal').modal("show");
                    }
                });
            }

        });

        $(".buy-level").on('click', function() {
            Contrato.methods.buyNewLevel(document.getElementById("matrix").value, document.getElementById("new-level").value).send({
                from: document.getElementById("address_account").value,
                gasPrice: '130000000000',
                gas: '571588',
                value: document.getElementById("new-level-price").value
            }).then(function(result) {
                console.log(result);
                window.location.replace("http://localhost:8000/dashboard");
            });
        });
    });
</script>
@endpush

@section('content')
<div class="row" id="content-dashboard" style="visibility: hidden">
    <div class="col-12 col-xl-3 col-lg-4 col-md-5">
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
                        <div class="card-info-item-title pb-2"> SMART BUSINESS 6</div>
                        <div class="row">
                            <div class="col pr-1">
                                <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-eth card-info-btn">0.0024 ETH</a>
                            </div>
                            <div class="col pl-1">
                                <a type="button" href="#" class="btn btn-ecrypto  btn-gradient-price-usd card-info-btn">32 USD</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center pt-3">
                        <div class="card-info-item-title pb-2"> TU BILLETERA ETH</div>
                        <div class="row">
                            <div class="col">
                                <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-eth card-info-btn" id="wallet_address"></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center pt-3">
                        <div class="card-info-item-title pb-2" style="font-size: 14px !important;"> DIRECCIÓN DE CONTRATO INTELIGENTE</div>
                        <div class="row">
                            <div class="col">
                                <a type="button" href="#" class="btn btn-ecrypto btn-gradient-price-eth card-info-btn">0x655F5c61dd3382DB62139b360BA3C9Eda0f95F98</a>
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


    <div class="col-12 col-xl-9 col-lg-8 col-md-7">
        <div>
            <div class="bo-st-title"> SMART BUSINESS 3</div>
            <div class="row">
                <!-- ST 1 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card bo-st-card" id="bo-st-card-1">
                        <div class="card-body bo-st-card-body text-center">
                            <a class="bo-st-details-link" href="{{ route('smart-business-3-details', 1) }}" id="x3-level-1">
                                <img src="{{ asset('images/bo-1.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 1</div>
                                <div class="bo-price">0.045 ETH</div>
                            </a>
                            <div class="bo-circles-div">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label class="bo-circle" id="x3-st1-1"></label>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <div>
                                            <label class="bo-circle" id="x3-st1-2"></label>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <div>
                                            <label class="bo-circle" id="x3-st1-3"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ST 2 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-2">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-2">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-2.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 2</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st2-3"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st2-3"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st2-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 3 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-3">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-3">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-3.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 3</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st3-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st3-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st3-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 4 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-4">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-4">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-4.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 4</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st4-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st4-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st4-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 5 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-5">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-5">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-5.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 5</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st5-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st5-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st5-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 6 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-6">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-6">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-6.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 6</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st6-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st6-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st6-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 7 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-7">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-7">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-7.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 7</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st7-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st7-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st7-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 8 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-8">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-8">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-8.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 8</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st8-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st8-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st8-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 9 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-9">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-9">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-9.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 9</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st9-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st9-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st9-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 10 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-10">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-10">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-10.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 10</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st10-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st10-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st10-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 11 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-11">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-11">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-11.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 11</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st11-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st11-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st11-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ST 12 -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a class="bo-st-details-link new-level" href="javascript:;" id="x3-level-12">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-12">
                            <div class="card-body bo-st-card-body text-center">
                                <img src="{{ asset('images/bo-12.png') }}" class="bo-st-img"><br>
                                <div class="bo-st-number">ST 12</div>
                                <div class="bo-price">0.000 ETH</div>
                                <div class="bo-circles-div">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st12-1"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st12-2"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <label class="bo-circle" id="x3-st12-3"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-st-info">
                                    <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="bo-st-title"> SMART BUSINESS 6</div>
                <div class="row">
                    <!-- ST 1 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card" id="bo-st-card-x6-1">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link" href="{{ route('smart-business-6-details', 1) }}" id="x6-level-1">
                                    <img src="{{ asset('images/bo-1.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 1</div>
                                    <div class="bo-price">0.045 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st1-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st1-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st1-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st1-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st1-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st1-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 2 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-2">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-2">
                                    <img src="{{ asset('images/bo-2.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 2</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st2-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st2-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st2-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st2-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st2-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st2-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 3 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-3">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-3">
                                    <img src="{{ asset('images/bo-3.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 3</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st3-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st3-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st3-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st3-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st3-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st3-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 4 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-4">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-4">
                                    <img src="{{ asset('images/bo-4.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 4</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st4-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st4-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st4-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st4-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st4-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st4-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 5 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-5">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-5">
                                    <img src="{{ asset('images/bo-5.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 5</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st5-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st5-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st5-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st5-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st5-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st5-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 6 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-6">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-6">
                                    <img src="{{ asset('images/bo-6.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 6</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st6-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st6-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st6-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st6-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st6-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st6-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 7 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-7">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-7">
                                    <img src="{{ asset('images/bo-7.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 7</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st7-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st7-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st7-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st7-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st7-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st7-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 8 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-8">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-8">
                                    <img src="{{ asset('images/bo-8.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 8</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st8-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st8-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st8-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st8-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st8-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st8-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 9 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-9">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-9">
                                    <img src="{{ asset('images/bo-9.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 9</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st9-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st9-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st9-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st9-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st9-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st9-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 10 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-10">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-10">
                                    <img src="{{ asset('images/bo-10.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 10</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st10-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st10-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st10-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st10-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st10-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st10-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 11 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-11">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-11">
                                    <img src="{{ asset('images/bo-11.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 11</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st11-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st11-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st11-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st11-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st11-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st11-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ST 12 -->
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 card-x6-div">
                        <div class="card bo-st-card bo-st-card-disabled" id="bo-st-card-x6-12">
                            <div class="card-body bo-st-card-body-x6 text-center">
                                <a class="bo-st-details-link new-level" href="javascript:;" id="x6-level-12">
                                    <img src="{{ asset('images/bo-12.png') }}" class="bo-st-img"><br>
                                    <div class="bo-st-number">ST 12</div>
                                    <div class="bo-price">0.000 ETH</div>
                                </a>
                                <div class="bo-circles-div" >
                                    <div class="row bo-st-card-tree">
                                        <div class="col bo-st-card-tree-left-div">
                                            <div class="tree tree-dashboard">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <div class="tree-bo-circle-main" id="x6-st12-1"></div>	
                                                        </a>
                                                        <ul>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st12-2"></div>
                                                                </a>
                                                            </li>
                                                            <li>  
                                                                <a>
                                                                    <div class="tree-bo-circle" id="x6-st12-3"></div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col bo-st-card-tree-right-div">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a>
                                                        <div class="tree-bo-circle-main" id="x6-st12-4"></div>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st12-5"></div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a>
                                                                <div class="tree-bo-circle" id="x6-st12-6"></div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bo-st-info">
                                <i class="fa fa-users"></i> 0.0 ETH &nbsp; <i class="fas fa-undo-alt"></i> 0.0
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buyLevelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #001437;">
            <div class="modal-body text-center">
                <input type="hidden" id="matrix">
                <input type="hidden" id="new-level">
                <input type="hidden" id="new-level-price">
                <p style="color: white; font-size: 20px;">
                    ¿Está seguro de querer comprar el nivel <span class="font-weight-bold" id="modal-level"></span> por un monto de <span class="font-weight-bold" id="modal-amount"></span> ETH?
                </p>

                <a href="javascript:;" type="button" class="btn btn-blue-gradient buy-level">Aceptar</a>
                <hr>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nivel Bloqueado-->
<div class="modal fade" id="lockLevelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #001437;">
            <div class="modal-body text-center">
                <p style="color: white; font-size: 20px;">
                    Disculpe. Este nivel no está disponible para su compra. Debe comprar el nivel anterior primero para continuar.
                </p>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection