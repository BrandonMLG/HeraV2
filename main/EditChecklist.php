<?php
session_start();
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;
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
        <title>Checklist</title>
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
            function buscarDescripcion() {

                var valorBusqueda = $('#ID_Modulo').val();
                var text = $("#ID_Modulo option:selected").text();
                var parametros = {
                    "busqueda": valorBusqueda,
                };
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'AJAX/consultaDescripcion.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    // beforeSend: function () {
                    //     $("#tabla_resultado").html("<div class='text-center h5'>   Procesando, espere por favor...</div>");
                    // },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#desc").val(response);
                        $("#modulo").val(text);
                    }
                });
            }

            function cambiarActividad() {
                var actividad = $('#ID_Actividad option:selected').text();
                $('#actividad').val(actividad);
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
                    <?php echo $BE->navbarHeader('Editar Checklist', 'Administrador'); ?> 

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
                <div class="container-fluid">

                    <div class="row page-titles">
                        <div class="col-md-9 text-justify">
                            <p class="font-light"><span class="font-weight-bold">Inducción: </span>En el presente modulo podrás modificar los rasgos a evaluar duratente el <span class="font-medium">Matenimiento Preventivo</span> que se ejecuta a la distinta Maquinaria con la que cuenta la empresa <span class="font-medium">Hera Apparel</span>, esperamos contar con tu apoyo para la actualización de dicha información. <span class="font-medium">Empezemos!</span></p>

                        </div>

                        <div class="col-md-3 p-l-0">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">Incio</a>
                                </li>
                                <li class="breadcrumb-item">Mecanicos</li>
                                <li class="breadcrumb-item active"> Checklist</li>
                            </ol>
                        </div>
                        <div>
                            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>1.- Registrar Módulo:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">

                                                    <div class="form-group col-12">
                                                        <input type="text" class="form-control form-control-line text-center" value="" placeholder="ej. Sistema Eléctrico" name="modulo" autocomplete="off"> 
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <textarea type="text" rows='3'  class="form-control form-control-line text-center" placeholder="Descripción" name="descripcion" autocomplete="off"></textarea>
                                                    </div>
                                                    <div class="form-group col-12"> 
                                                        <p class="small text-justify">Utiliza este apartado para agregar <span class="font-weight-bold">nuevos modulos</span> que se verán reflejados en el <span class="font-weight-bold">Checklist</span>.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="1" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>2.- Registrar Criterio:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">
                                                    <div class="form-group text-center">
                                                        <label>Modulo</label>
                                                        <select class="form-control text-center" name="ID_Modulo">
                                                            <option></option>
                                                            <?php echo $BE->mostrarOptionsModulosChecklist(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <input type="text" class="form-control form-control-line text-center" value="" placeholder="ej. Clavijas y contactos" name="actividad" autocomplete="off"> 
                                                    </div>

                                                    <div class="form-group col-12"> 
                                                        <p class="small text-justify">En este apartado podrás ingresar un nuevo criterio a evaluar durante el <span class="font-weight-bold">Mantenimiento Preventivo</span> y vincularlo a cierto modulo.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="2" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>3.- Actualizar Módulo:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">
                                                    <div class="form-group text-center">
                                                        <label>Modulo</label>
                                                        <select class="form-control text-center" name="ID_Modulo" id="ID_Modulo" onchange="buscarDescripcion();">
                                                            <option></option>
                                                            <?php echo $BE->mostrarOptionsModulosChecklist(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <textarea type="text" rows='3'  class="form-control form-control-line text-center" placeholder="Descripción" name="descripcion" id="desc" autocomplete="off"></textarea>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <input type="text" class="form-control form-control-line text-center" value="" placeholder="Actualizar Nombre" name="modulo" id="modulo" autocomplete="off"> 
                                                    </div>

                                                    <div class="form-group col-12"> 
                                                        <p class="small text-justify">Actualizar la descripción de los modulos.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="3" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>4.- Actualizar Criterio:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">
                                                    <div class="form-group text-center">
                                                        <label>Actividades</label>
                                                        <select class="form-control text-center" name="ID_Actividad" id="ID_Actividad" onchange="cambiarActividad()">
                                                            <option></option>
                                                            <?php echo $BE->mostrarOptionsActividadChecklist(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <input type="text" class="form-control form-control-line text-center" value="" placeholder="Actualizar Nombre" name="actividad" id="actividad" autocomplete="off"> 
                                                    </div>
                                                    <div class="form-group col-12"> 
                                                        <p class="small text-justify">Actualizar la descripción de los modulos.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="4" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                     <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>5.- Eliminar Módulo:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">
                                                    <div class="form-group text-center">
                                                        <label>Modulo</label>
                                                        <select class="form-control text-center" name="ID_Modulo">
                                                            <option></option>
                                                            <?php echo $BE->mostrarOptionsModulosChecklist(); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-12"> 
                                                        <p class="small text-center">Eliminar <span class="font-weight-bold"> Modulo </span> y criterios.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="5" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>6.- Eliminar Criterio:</strong></h4>
                                                <form class="form-material m-t-40" method="POST" action="procesarChecklist.php">
                                                    <div class="form-group text-center">
                                                        <label>Actividades</label>
                                                        <select class="form-control text-center" name="ID_Actividad">
                                                            <option></option>
                                                            <?php echo $BE->mostrarOptionsActividadChecklist(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12"> 
                                                        <p class="small text-center">Eliminar <span class="font-weight-bold"> Criterios</span>.</p>
                                                    </div>
                                                    <div class="form-group col-12 hide">
                                                        <input type="text" class="form-control form-control-line" value="6" placeholder="formValue" name="formValue">
                                                    </div>
                                                    <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><strong>Checklist:</strong></h4>
                                        <div>
                                            <?php echo $BE->mostrarChecklist(); ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>     <?php echo $BE->alertaCerrarSesion(); ?>


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
                                                            swal("Buen trabajo!", "La accion a sido completada satisfactoriamente.", "success")
                                                        }
                                                        ;

                                                        if (<?php echo $_GET["status"]== md5('success') ?>) {
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