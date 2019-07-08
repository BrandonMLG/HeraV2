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
        <title>Maquinaria Hera Apparel</title>
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

        <script>
            function realizaProceso() {
                var valorBusqueda = $('#busqueda').val();
                var parametros = {
                    "busqueda": valorBusqueda,
                };
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'AJAX/consultaMaquinaria.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    // beforeSend: function () {
                    //     $("#tabla_resultado").html("<div class='text-center h5'>   Procesando, espere por favor...</div>");
                    // },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#tabla_resultado").html(response);

                        var Caja = window.document.getElementById("MaquinaID");
                        Caja.style.display = 'none';
            
                    }
                });
            }
        </script>


        <script type="text/javascript">
            function ocultar() {
                var Caja = window.document.getElementById("MaquinaID");
                Caja.style.display = 'none';
            }
            function pulsar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }
            
              document.addEventListener('keyup', event => {
                if (event.ctrlKey && event.keyCode === 66) {
                    window.document.getElementById('busqueda').focus();
                }
            }, false)
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
                    <?php echo $BE->navbarHeader('Consulta de Maquinaria', 'Administrador'); ?> 

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

                    <div class="row page-titles">
                        <div class="col-md-4 text-center">
                            <h3 class="text-themecolor"> Buscador de Maquinaria:</h3>

                        </div>
                        <div class="col-md-4 text-center">
                            <form name="formulario" onkeypress = "return pulsar(event)">  
                                <input type="text" class="form-control mt-0"  id="busqueda" name="busqueda"  autofocus="on" autocomplete="off" 
                                       value="" onkeyup="realizaProceso()" >
                            </form>
                        </div>

                        <div class="col-md-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">Incio</a>
                                </li>
                                <li class="breadcrumb-item">Extras</li>
                                <li class="breadcrumb-item active">Maquinaria Hera</li>
                            </ol>
                        </div>
                        <div>
                            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                        </div>
                    </div>
                </div>
                
                <section id="tabla_resultado">
                </section>  
                <?php
                if (isset($_GET["ID"])) {
                    echo $BE->buscarMaquinariaID($_GET["ID"]);
                } 
//                else {
//                    echo ' <div id="contenedor_spinner">
//                            <div id="contenedor_carga">
//                                <div id="carga"></div>
//                                </div>
//                            <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Código de la Maquina</strong> que deseas modificar.</H4></div>
//                          </div>';
//                }
//                
                echo $BE->alertaCerrarSesion();
                ?>


            </div>

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
    <!-- ============================================================== -->
    <!--alerts CSS -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <script>
                                           function msj() {
                                               swal("Buen trabajo!", "La información de la Maquina: <?php echo $_GET["ID"] ?> , ha sido actualizada satisfactoriamente.", "success")
                                           }
                                           ;

                                           if (<?php echo isset($_GET["Success"]) ?>) {
                                               msj();

                                           }
    </script>

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