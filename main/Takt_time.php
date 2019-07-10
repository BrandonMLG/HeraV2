<?php
session_start();
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;
$MODEL = new Modelo();
$BE->salir();
if (!$BE->siAutentificado()) {
    $BE->redireccionar("Login.php");
} else {
    $URL = basename($_SERVER['PHP_SELF']);
    $registro = $BE->verificarUrl($URL);
    if (!$registro) {
        $BE->redireccionar("Inicio.php");
    }
}
$BE->registrarMtto_Preventivo();
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
        <title>Takt Time</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/plugins/icheck/skins/all.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="cssPersonal/height.css" rel="stylesheet">
        <link href="css/pages/form-icheck.css" rel="stylesheet">
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
            var pausa = false;

            function pausar() {
                if (pausa) {
                    pausa = false;
                } else {
                    pausa = true;
                }
            }

            function iniciarCronometro() {
                var tiempo = $("#segundos").val();
                if (tiempo !== '') {
                    var elemento = document.getElementById("contenedor");
                    elemento.className = "hide";
                    document.getElementById('txtSeg').textContent = tiempo + ' seg.';
                    var tiempoCambio = (tiempo * 1000);
                    console.log(cont);
                    var cont = 0;
                    setInterval(function () {
                        if (!pausa) {
                            document.getElementById('meta').innerHTML = zfill(cont, 4);
                            cont++;
                            console.log(cont);
                        }
                    }, tiempoCambio);
                }
            }
        </script>

        <script>
            function obtenerHora() {
                var fecha = new Date();
                var hora = fecha.getHours();
                var min = fecha.getMinutes();
                var seg = fecha.getSeconds()

                if (hora > 7) {
                    if (expr) {

                    }
                }

            }

        </script>
        <script>
            function sumar() {
                inicio = true;
                if (inicio) {
                    var tiempo = $("#segundos").val();

                    var real = document.getElementById('real').innerHTML;
                    if (tiempo !== '') {
                        document.getElementById('real').innerHTML = zfill((parseInt(real) + 1), 4);
                    }
                }


            }

            function restar() {
                inicio = true;
                if (inicio) {
                    var tiempo = $("#segundos").val();

                    var real = document.getElementById('real').innerHTML;
                    if (tiempo !== '') {
                        document.getElementById('real').innerHTML = zfill((parseInt(real) - 1), 4);
                    }
                }
            }

            function detectarBoton(event) {
                if (event.button == 2)
                    restar();
                else if (event.button == 1)
                    console.log("El botón del ratón pulsado fue el medio");
                else
                    sumar()

            }
        </script>

        <script>
            function zfill(number, width) {
                var numberOutput = Math.abs(number); /* Valor absoluto del número */
                var length = number.toString().length; /* Largo del número */
                var zero = "0"; /* String de cero */

                if (width <= length) {
                    if (number < 0) {
                        return ("-" + numberOutput.toString());
                    } else {
                        return numberOutput.toString();
                    }
                } else {
                    if (number < 0) {
                        return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
                    } else {
                        return ((zero.repeat(width - length)) + numberOutput.toString());
                    }
                }
            }

            function inh() {
                document.oncontextmenu = inhabilitar;
            }

        </script>



    </head>
    <body class="fix-header card-no-border fix-sidebar" onload="inh()" oncontextmenu="return false;">
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
                    <?php echo $BE->navbarHeader('Takt Time', 'Administrador'); ?> 

                </nav>
            </header>
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <?php echo $BE->sideBar(); ?>
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper p-b-0">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-lg-12">


                            <!--                            <div class="row">
                                                            <div class="col-lg-3 col-sm-12 text-center  snm"><h2 id='crono' class="m-t-20" name="">00:00:00</h2> 
                                                                <input class="hide" id="tiempo_requerido"  name="tiempo_requerido"></div>
                                                            <div class="col-lg-6 col-sm-12 text-center"><h3 class="m-t-20"><strong>IDENTIFICACIÓN: </strong></h3></div>
                                                            <div class="col-lg-3  col-sm-12 text-center"><label for="" class="font-medium">Fecha:</label><input type="date" class="form-control text-center" name="fecha" id="fecha"></div>
                                                        </div>-->
                            <div class="row text-center">
                                <div class="col-1">
                                    <div class="row" id="contenedor">
                                        <div class="col-12 p-0">
                                            <input type="text" class="text-center font-weight-bold" id="segundos" autofocus="on">
                                        </div>
                                        <div class="col-12" onclick="iniciarCronometro();">
                                            <button class="btn btn-primary" >Guardar Takt</button>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-10">
                                    <div class=" display-1  font-medium p-20 text-dark">Meta: <button  type="button"class="btn btn-success text-white waves-effect"><span class="font-weight-bold" style="font-size: 8rem;" id="meta">0000</span></button></div>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="row text-center">
                                <div class="col-4 ">
                                </div>
                                <div class="col-4">
                                    <div class=" display-1  font-medium p-20 text-dark">
                                        <button  type="button"class="btn btn-danger text-white waves-effect">
                                            <span class="display-1 font-weight-bold" id="txtSeg">0 seg.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <button  type="button"class="btn btn-info text-white waves-effect font-weight-bold" onclick="pausar()">Pausar</button>
                                </div>
                            </div>
                            <div class="row text-center" onmousedown="detectarBoton(event);" contextmenu="restar()">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class=" display-1  font-medium p-20 text-dark">Real: <button  type="button"class="btn btn-warning text-white waves-effect"><span class="font-weight-bold" style="font-size: 8rem;" id="real">0000</span></button></div>

                                </div>
                                <div class="col-1">


                                </div>
                            </div>
                        </div>
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
                                    swal("Buen trabajo!", "La accion a sido completada satisfactoriamente.", "success")
                                }
                                ;

                                if (<?php echo $_GET["status"] == md5('success') ?>) {
                                    msj();
                                }
                                ;
    </script>


    <!-- icheck -->
    <script src="../assets/plugins/icheck/icheck.min.js"></script>
    <script src="../assets/plugins/icheck/icheck.init.js"></script>

</body>

</html>