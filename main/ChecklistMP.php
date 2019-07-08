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
        <title>MP/Checklist</title>
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
            $validacion1;
            $validacion2;

            function validarChecklist() {
                var actividades = <?php echo json_encode($MODEL->mostrarActividadesChecklist2()); ?>;
                console.log(actividades);
                $size = actividades.length;
                $seleccionados = 0;
                for (var i = 0, max = $size; i < max; i++) {
                    var id = actividades[i].ID_Actividad;

                    var act = 'ACT-' + id;
                    var radioValue = $("input[name='" + act + "']:checked").val();
                    if (radioValue) {
                        console.log(act + ": " + radioValue);
                        var contenido = document.getElementById(act).textContent;
                        contenido = contenido.replace('*', '');
                        document.getElementById(act).innerHTML = contenido + ' <i class="fa fa-check text-info"></i>';
                        $seleccionados++;
                    } else {
                        var contenido = document.getElementById(act).textContent;
                        contenido = contenido.replace('*', '');
                        document.getElementById(act).innerHTML = contenido + '<span class="text-danger font-20 font-weight-bold"> *</span>';
                    }

                }
//                <span class="text-danger">*</span>

                console.log("Seleccionados: " + $seleccionados);
                console.log("Restan: " + ($size - $seleccionados));

                if ($size > $seleccionados) {
                    document.getElementById('titulo').textContent = 'Checklist Incompleto!';
                    document.getElementById('informacion').innerHTML = 'El checklist de Mantenimiento Preventivo se encuentra con algunos <span class="font-medium"> campos sin verificación</span>, por tal motivo tu reporte <span class="font-medium">no puede ser procesado</span>  en este momento hasta haber completado los campos necesarios.<br><br><span class="text-center font-weight-bold">Criterios Faltantes: <span class="text-danger">' + ($size - $seleccionados) + '</span></span>';
                    var elemento = document.getElementById("listo");
                    elemento.className = "hide";
                    document.getElementById('boton2').textContent = 'Cerrar';
                } else {
                    console.log();
                    document.getElementById('titulo').textContent = 'Mantenimiento Completado!';
                    document.getElementById('informacion').innerHTML = 'Agradecemos tu participación en la realización de este <span class="font-medium">Mantenimiento Preventivo</span>, mismo que podrá ser usado para futuras auditorias.<br>Pulsa el siguiente botón de: <span class="font-weight-bold">"Listo"</span> para procesar tu reporte o pulsa el botón de <span class="font-weight-bold">"Cancelar"</span> para revisar una vez más tu CheckList antes de ser enviado y almacenado.';
                    var elemento = document.getElementById("listo");
                    elemento.className = "";
                    document.getElementById('boton2').textContent = 'Cancelar';

                }

            }
        </script>
        <script>
            var inicio = 0;
            var timeout = 0;
            function empezarDetener(elemento) {
                if (timeout == 0)
                {
                    // empezar el cronometro
                    elemento.value = "Detener";
                    // Obtenemos el valor actual
                    inicio = vuelta = new Date().getTime();
                    // iniciamos el proceso
                    funcionando();
                } else {
                    // detemer el cronometro
                    elemento.value = "Empezar";
                    clearTimeout(timeout);
                    timeout = 0;
                }
            }

            function funcionando() {
                // obteneos la fecha actual
                var actual = new Date().getTime();
                // obtenemos la diferencia entre la fecha actual y la de inicio
                var diff = new Date(actual - inicio);
                // mostramos la diferencia entre la fecha actual y la inicial
                var result = LeadingZero(diff.getUTCHours()) + ":" + LeadingZero(diff.getUTCMinutes()) + ":" + LeadingZero(diff.getUTCSeconds());
                document.getElementById('crono').innerHTML = result;

                document.getElementById('tiempo_requerido').value = result;
                // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
                timeout = setTimeout("funcionando()", 1000);
            }
            /* Funcion que pone un 0 delante de un valor si es necesario */
            function LeadingZero(Time) {
                return (Time < 10) ? "0" + Time : +Time;
            }
        </script>
        <script>
            function validarMaquina(resultado) {
                if (resultado['Maquina'] !== ' ') {
                    console.log('Existe Maquina');
//                    document.getElementById('guardar').disabled=false;
                    $validacion1 = true;
                } else {
                    console.log('No existe maquina');
//                    document.getElementById('guardar').disabled=true;
                    $validacion1 = false;
                }
            }

            function habilitarGuardar() {
                var checkbox = $("input[id='minimal-checkbox-1']:checked").val();
                if (checkbox) {
                    $validacion2 = true;
                } else {
                    $validacion2 = false;
                }
                if ($validacion1 && $validacion2) {
                    document.getElementById('guardar').disabled = false;
                } else {
                    document.getElementById('guardar').disabled = true;
                }
            }

        </script>
        <script>
            function buscarMaquina() {
                var valorBusqueda = $('#ID_Maquina').val();
                var parametros = {
                    "busqueda": valorBusqueda,
                };
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'AJAX/consultaInfoMaquina.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    // beforeSend: function () {
                    //     $("#tabla_resultado").html("<div class='text-center h5'>   Procesando, espere por favor...</div>");
                    // },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        var resultado = JSON.parse(response);
                        $("#maquina").val(resultado['Maquina']);
                        $("#modelo").val(resultado['Modelo']);
                        $("#marca").val(resultado['Marca']);
                        $("#serie").val(resultado['Serie']);
                        $("#ubicacion").val(resultado['Ubicacion']);
                        console.log(response);

                        validarMaquina(resultado);
                    }
                });
            }
        </script>
        <script>
            function cargarFecha() {
                $("#fecha").val("<?php echo $BE->fechaActual(); ?>");
            }
        </script>
    </head>
    <body class="fix-header card-no-border fix-sidebar" onload="cargarFecha();
            empezarDetener(this)">
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
                    <?php echo $BE->navbarHeader('Mantenimiento Preventivo', 'Administrador'); ?> 

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
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="card">
                                        <div class="ribbon ribbon-corner ribbon-success"><i class="fa fa-hashtag"></i></div>
                                        <div class="card-body">
                                            <form class="form-material m-t-40" method="post" action="ChecklistMP.php">
                                                <div class="col-12 card-title">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-12 text-center  snm"><h2 id='crono' class="m-t-20" name="">00:00:00</h2> 
                                                            <input class="hide" id="tiempo_requerido"  name="tiempo_requerido"></div>
                                                        <div class="col-lg-6 col-sm-12 text-center"><h3 class="m-t-20"><strong>IDENTIFICACIÓN: </strong></h3></div>
                                                        <div class="col-lg-3  col-sm-12 text-center"><label for="" class="font-medium">Fecha:</label><input type="date" class="form-control text-center" name="fecha" id="fecha"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium"># Maquina <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="ej. 821" name="ID_Maquina" id="ID_Maquina" autocomplete="off" onkeyup="buscarMaquina();
                                                                    habilitarGuardar()"> 
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium">Tipo Maquina:</label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="" id="maquina" autocomplete="off"> 
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium">Modelo:</label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="" id="modelo" autocomplete="off"> 
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium">Marca:</label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="" id="marca" autocomplete="off"> 
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium">No. Serie:</label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="" id="serie" autocomplete="off"> 
                                                        </div>
                                                        <div class="col-lg-2 col-sm-6 text-center m-t-10">
                                                            <label type="text" class="font-medium">Ubicacion:</label>
                                                            <input type="text" class="form-control form-control-line text-center" value="" placeholder="" id="ubicacion" autocomplete="off"> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 skin skin-square">
                                                        <div class="row">
                                                            <div class="col-12 text-center"><h4 class="m-t-20"><strong>CUESTIONARIO DE CHEQUEO: </strong></h4></div>
                                                        </div>
                                                        <?php echo $BE->mostrarChecklistMP(); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 skin skin-square">
                                                        <div class="row">
                                                            <div class="col-12 text-center"><h4 class="m-t-20"><strong>OBSERVACIONES DEL INSPECTOR: </strong></h4></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-12 m-t-40">
                                                                <textarea type="text" rows='5'  class="form-control form-control-line text-center" placeholder="Descripción" name="descripcion" autocomplete="off"></textarea>
                                                            </div>
                                                            <div class="form-group col-12"> 
                                                                <p class="small text-justify"><i class="fa fa-check text-info"></i> Utiliza este apartado para <span class="font-weight-bold">describir brevemente</span> el mantenimiento realizado, mismo que se verá reflejado en tu <span class="font-weight-bold">reporte</span>.</p>
                                                            </div>

                                                            <div class="form-group col-12 m-t-40">
                                                                <textarea type="text" rows='5'  class="form-control form-control-line text-center" placeholder="Cambio de Piezas" name="piezas" autocomplete="off"></textarea>
                                                            </div>
                                                            <div class="form-group col-12"> 
                                                                <p class="small text-justify"><i class="fa fa-check text-info"></i> Si tuviste la necesidad de realizar algún<span class="font-weight-bold"> cambio de pieza</span> para dejar la maquina en optimo funcionamiento no olvides <span class="font-weight-bold">registrar las piezas </span> que requeriste.</p>
                                                            </div>

                                                            <div class="form-group col-12 m-t-40">
                                                                <textarea type="text" rows='5'  class="form-control form-control-line text-center" placeholder="Observaciones" name="observaciones" autocomplete="off"></textarea>
                                                            </div>
                                                            <div class="form-group col-12"> 
                                                                <p class="small text-justify"><i class="fa fa-check text-info"></i> Puedes ocupar este apartado para registrar alguna <span class="font-weight-bold">anotación o observación</span> que pueda ser de utilidad para realizar futuros<span class="font-weight-bold"> Mantenimientos Preventivos o Correctivos</span>.</p>
                                                            </div>

                                                            <div class="col-12 text-center"><h4 class="m-t-20"><strong>CIERRE: </strong></h4></div>
                                                            <div class="form-group col-12 mt-2"> 
                                                                <p class="small text-justify"><i class="fa fa-bullhorn text-danger"> </i> El presente Checklist refleja la inpección realizada a cargo del C. <span class="font-weight-bold"><?php echo $_SESSION["usuario"]["Usuario"] ?></span>, colaborador de la Empresa <span class="font-weight-bold"> Hera Apparel S.A. de C.V. </span>perteneciente al Depto: <span class="font-weight-bold"> <?php echo $_SESSION["usuario"]["Departamento"] ?></span>, mismo checklist deberá funjir como historico para los futuros <span class="font-weight-bold">Mantenimientos Preventivos</span> a realizar.</p>
                                                            </div>
                                                            <div class="form-group col-12 text-center">
                                                                <input type="checkbox" class="text-success" id="minimal-checkbox-1" onclick="habilitarGuardar()" >
                                                                <label for="minimal-checkbox-1">De Acuerdo.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-3"> </div>
                                                                <div class="col-6"   onclick="validarChecklist()">
                                                                    <button type="button" class="btn btn-success col-12" id="guardar"  data-toggle="modal" data-target="#myModal"  disabled=""><i class="fa fa-spin  fa-refresh"></i> Validar </button>
                                                                </div>
                                                                <div class="col-3"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title font-weight-bold" id="titulo"></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p id="informacion" class="text-justify"> </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div id="listo" ><button type="submit" class="btn btn-success waves-effect">Listo!</button></div>
                                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="boton2">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo $BE->alertaCerrarSesion(); ?>
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
    <!-- icheck -->
    <script src="../assets/plugins/icheck/icheck.min.js"></script>
    <script src="../assets/plugins/icheck/icheck.init.js"></script>

</body>

</html>