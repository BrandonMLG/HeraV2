<?php
session_start();
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;
$BE->salir();
if (!$BE->siAutentificado()) {
    $BE->redireccionar("Login.php");
}else{
    
    $URL  = basename($_SERVER['PHP_SELF']); 
   $registro = $BE->verificarUrl($URL);
   if (!$registro) {
      $BE->redireccionar("Inicio.php");
   }
}

$BE->actualizarMaquinaria();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <?php echo $BE->faviconLogo() ?>
        <title>Consulta Nómina</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->

        <link href="css/style.css" rel="stylesheet">
        <link href="cssPersonal/height.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/blue.css" id="theme" rel="stylesheet">

        <!--         page css 
                <link href="css/pages/file-upload.css" rel="stylesheet">-->
        <!-- page css -->
        <link href="css/pages/user-card.css" rel="stylesheet">
        <!-- page css -->
        <link href="css/pages/ribbon-page.css" rel="stylesheet">
        <!--Spinner-->
        <link rel="stylesheet" href="../main/css/spinner.css">
        <!--Ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!--        <script src="jsPersonal/script.js"></script>-->
        <!--Spinner-->
        <link rel="stylesheet" href="../main/css/spinner.css">
        <script>

            function realizaProceso() {
                var valorBusqueda = $('#busqueda').val();
                var semana = $('#semana').val();

                var parametros = {
                    "busqueda": valorBusqueda,
                    "semana": semana
                };
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'AJAX/consultaNomina.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
//                    beforeSend: function () {
//                        $("#tabla_resultado").html("Procesando, espere por favor...");
//                    },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#tabla_resultado").html(response);
                    }
                });
            }
        </script>
        <script>


            function ocultarCajaSpinner() {

                var valorBusqueda = $('#busqueda').val();
                if (valorBusqueda !== '') {
                    var Caja = window.document.getElementById("CajaID");

                    Caja.style.display = 'none';
                } else {
                    var Caja = window.document.getElementById("CajaID");

                    Caja.style.display = 'inherit';
                }



            }
        </script>
        <script type="text/javascript">
            function pulsar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }
        </script>
        <script>
            function Calculo(sueldo) {
                var pieza = window.document.form1.piezas.value;
                console.log(pieza);
                var tarea = window.document.form1.tarea.value;
                var resultado = (((sueldo / 5) / tarea) * pieza) * 2;

                window.document.form1.importe.value = resultado.toFixed(2);
            }
            function CalculoTiempoExtraDobles(sueldo) {
                var horas = window.document.form2.numeroDobles.value;
                var resultado = ((sueldo / 67.2) * 2) * horas;
                window.document.form2.pagoDobles.value = resultado.toFixed(2);
            }
            function CalculoTiempoExtraTriples(sueldo) {
                var horas = window.document.form2.numeroTriples.value;
                var resultado = ((sueldo / 67.2) * 3) * horas;
                window.document.form2.pagoTriples.value = resultado.toFixed(2);
            }
            function limpiarRebase() {
                window.document.form1.piezas.value = '';
                window.document.form1.tarea.value = '';
                window.document.form1.importe.value = '$0.00';
                window.document.getElementById("piezas").focus();
            }
            function limpiarTiempoExtra() {
                window.document.form2.numeroDobles.value = '';
                window.document.form2.numeroTriples.value = '';
                window.document.form2.pagoDobles.value = '$0.00';
                window.document.form2.pagoTriples.value = '$0.00';

                window.document.getElementById("numeroDobles").focus();
            }

            document.addEventListener('keyup', event => {
                if (event.ctrlKey && event.keyCode === 66) {
                    window.document.getElementById('busqueda').focus();
                }
            }, false)

            function cambiaDefecto(valor) {
                console.log(valor);
                document.formulario.busqueda.value = valor + ' ';
                window.document.getElementById("busqueda").focus();
            }

        </script>

    </head>

    <body class="fix-header card-no-border fix-sidebar" onload="">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Hera Apparel</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <?php echo $BE->navbarLogos(); ?> 
                    <?php echo $BE->navbarHeader('Consulta de Nómina', 'Administrador'); ?> 

                </nav>
            </header>
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <?php echo $BE->sideBar(); ?>
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-3 text-center">
                            <h3 class="text-themecolor">Importes de Nómina: </h3>
                        </div>
                        <div class="col-md-3">
                            <form name="formulario" onkeypress = "return pulsar(event)">  
                                <input type="text" class="form-control mt-0"  id="busqueda" name="busqueda" autofocus="on" autocomplete="off" onkeyup="realizaProceso();
                                        ocultarCajaSpinner();">
                            </form>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control custom-select btn-secondary" id="semana" onchange="realizaProceso()">
                                <?php echo $BE->returnUltimaSemana(); ?>
                            </select>
<!--                                    <small class="form-control-feedback"> Select your gender. </small> </div>-->
                        </div>
                        <div class="col-md-4 align-self-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">Incio</a>
                                </li>
                                <li class="breadcrumb-item">Depto Nominas</li>
                                <li class="breadcrumb-item active">Consulta Nomina  </li>
                            </ol>
                        </div>
                        <div>
                            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                        </div>
                    </div>


                    <!--                    <div class="row p-b-0">
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 animated bounceInDown">
                                                <div class="card">
                                                    <div class="card-header text-center">
                                                        <i class="fa fa-address-card"></i><strong class="card-title pl-2">Perfil</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mx-auto d-block">
                                                            <img class="rounded-circle mx-auto d-block " src="imagenesEmpleados/20.jpg" alt="Card image cap">
                                                            <h6 class="text-center mb-1 mt-2">JUAN PEREZ LOPEZ</h6>
                                                            <div class="text-center"><i class="fa fa-map-marker"></i> SISTEMAS</div>
                                                        </div>
                                                        <hr>
                                                        <div class="row text-center">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class=" ti-user h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Sueldo:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold">$ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-star h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Puntualidad:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold">$ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center m-t-15">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-flag-alt h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Prima Vac:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold">$ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-hand-point-right h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Dia Festivo:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold">$ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header text-center">
                                                                <i class="fa  fa-bookmark"></i><strong class="card-title pl-2">Calculos Extras:</strong>
                                                            </div>
                                                            <div class="card-body">
                                                                <button type="button" class="btn btn-primary rounded m-r-20 m-l-40" data-toggle="modal" data-target="#exampleModal">Rebases</button>
                                                                <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModal2">Tiempo Extra</button>
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12  ">
                                                <button type="button" class="font-18 m-t-30 m-b-20 btn btn-rounded btn-block btn-info animated pulse"><span class="pr-2">Importe:</span>$ 2500.00</button>
                                                <div class="card animated bounceInUp">
                                                    <div class="card-header text-center">
                                                        <i class="fa  fa-bar-chart-o"></i><strong class="card-title pl-2">Eficiencia Semanal</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="">Lunes: $50.00<span class="pull-right">50%</span></h5>
                                                        <div class="progress" id="altura6">
                                                            <div class="progress-bar bg-info wow animated progress-animated" style="width: 50%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                                        </div>
                                                        <h5 class="m-t-30">Martes: $50.00<span class="pull-right">50%</span></h5>
                                                        <div class="progress" id="altura6">
                                                            <div class="progress-bar bg-info wow animated progress-animated" style="width: 50%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                                        </div>
                                                        <h5 class="m-t-30">Miercoles: $50.00<span class="pull-right">50%</span></h5>
                                                        <div class="progress" id="altura6">
                                                            <div class="progress-bar bg-info wow animated progress-animated" style="width: 50%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                                        </div>
                                                        <h5 class="m-t-30">Jueves: $50.00<span class="pull-right">50%</span></h5>
                                                        <div class="progress" id="altura6">
                                                            <div class="progress-bar bg-info wow animated progress-animated" style="width: 50%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                                        </div>
                                                        <h5 class="m-t-30">Viernes: % 50.00 <span class="pull-right">50%</span></h5>
                                                        <div class="progress" id="altura6">
                                                            <div class="progress-bar bg-info wow animated progress-animated" style="width:50%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row text-center m-t-15">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-crown h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Prima Dom:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold"> $ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-stats-up h2"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Rebase:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><span class="font-bold"> $ 1500.00</span></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 animated bounceInRight">
                                                <div class="card">
                                                    <div class="card-header text-center">
                                                        <i class="fa   fa-fire"></i><strong class="card-title pl-2">Tiempo Extra</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row text-center m-t-15">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-alarm-clock text-info h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row text-center"><div class="col-xl-12">Dobles: <span class="label label-rounded label-success pull-right">8</span></div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="font-bold"> $ 321.52</span></h4></div></div></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-alarm-clock text-info h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row text-center"><div class="col-xl-12">Triples: <span class="label label-rounded label-success pull-right">3</span></div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="font-bold"> $ 1500.00</span></h4></div></div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-t-10">
                                                            <div class="col-12">
                                                                <p class="text-center"><span class="font-bold">Lun: </span>3
                                                                    <span class="font-bold">Mar: </span>4
                                                                    <span class="font-bold">Mie: </span>3
                                                                    <span class="font-bold">Jue: </span>4 <br>
                                                                    <span class="font-bold">Vie: </span>4
                                                                    <span class="font-bold">Sab: </span>3
                                                                    <span class="font-bold">Dom: </span>5 </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header text-center">
                                                        <i class="fa   fa-info"></i><strong class="card-title pl-2">Percepciones</strong>
                                                    </div>
                                                    <div class="card-body">
                                                       
                                                        
                                                        <div class="row text-center m-t-10">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-flag-alt-2 text-warning h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Bono:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="">$ 1500.00</span></h4></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                 <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-stats-down text-danger h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Descuentos:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="">$ 1500.00</span></h4></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center m-t-15">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-bolt text-megna h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Rendimiento:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="">$ 1500.00</span></h4></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                 <div class="row">
                                                                    <div class="col-xl-3"><i class="ti-share text-info h1"></i></div>
                                                                    <div class="col-xl-9">
                                                                        <div class="row"><div class="col-xl-12">Diferencia:</div></div>
                                                                        <div class="row"><div class="col-xl-12"><h4><span class="">$ 402.00</span></h4></div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                    <!--                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Calculo de Rebases</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form name="form1">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Piezas:</label>
                                            <input type="text" class="form-control" id="piezas" name="piezas" onkeyup="Calculo(' . $SueldoBase . ');">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Tarea:</label>
                                            <textarea class="form-control" name="tarea" onkeyup="Calculo(' . $SueldoBase . ');"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Importe:</label>
                                            <textarea class="form-control" name="importe"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onClick="limpiarRebase();">Clean</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Calculo de Tiempo Extra</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form name="form2">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Horas Dobles:</label>
                                            <input type="text" class="form-control" id="numeroDobles" name="numeroDobles" onkeyup="CalculoTiempoExtraDobles(' . $SueldoBase . ')">
                                            <input type="text" class="form-control mt-3" name="pagoDobles" value="$0.00">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Horas Triples:</label>
                                            <input type="text" class="form-control" id="recipient-name1" name="numeroTriples" onkeyup="CalculoTiempoExtraTriples(' . $SueldoBase . ');">
                                            <input type="text" class="form-control mt-3" name="pagoTriples" value="$0.00">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onClick="limpiarTiempoExtra();">Clean</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <section id="tabla_resultado">
                    </section>    

                    <div id="CajaID">
                        <div id="contenedor_spinner">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Número del Colaborador</strong> que deseas buscar.</H4></div>
                    </div>
                    <?php
                    //echo $BE->mostrarColaboradores();
                    echo $BE->alertaCerrarSesion();
                    ?> 
                    <!-- .right-sidebar -->
                    <div class="right-sidebar">
                        <div class="slimscrollright">
                            <div class="rpanel-title">Panel de Servicios<span><i class="ti-close right-side-toggle"></i></span> </div>
                            <div class="r-panel-body">
                                <ul id="themecolors" class="m-t-20">
                                    <li><b>Light sidebar</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                    <li class="d-block m-t-30"><b>Dark sidebar</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer "> © Hera.com 2019</footer>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- Session-timeout-idle -->
<script src="../assets/plugins/session-timeout/idle/jquery.idletimeout.js"></script>
<script src="../assets/plugins/session-timeout/idle/jquery.idletimer.js"></script>

<script>
                                        var UIIdleTimeout = function () {
                                            return {
                                                init: function () {
                                                    var o;
                                                    $("body").append(""), $.idleTimeout("#idle-timeout-dialog", ".modal-content button:last", {
                                                        idleAfter: 300,
                                                        timeout: 3e4,
                                                        pollingInterval: 1,
                                                        keepAliveURL: "/keep-alive",
                                                        serverResponseEquals: "OK",
                                                        onTimeout: function () {
                                                            window.location = "Inicio.php?salir=1"
                                                        },
                                                        onIdle: function () {
                                                            $("#idle-timeout-dialog").modal("show"), o = $("#idle-timeout-counter"), $("#idle-timeout-dialog-keepalive").on("click", function () {
                                                                $("#idle-timeout-dialog").modal("hide")
                                                            })
                                                        },
                                                        onCountdown: function (e) {
                                                            o.html(e)
                                                        }
                                                    })
                                                }
                                            }
                                        }();
                                        jQuery(document).ready(function () {
                                            UIIdleTimeout.init()
                                        });
</script>


</body>

</html>