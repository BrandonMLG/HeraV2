<?php
session_start();
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd;
$BE->salir();
if (!$BE->siAutentificado()) {
    $BE->redireccionar("Login.php");
} else{
    
    $URL  = basename($_SERVER['PHP_SELF']); 
   $registro = $BE->verificarUrl($URL);
   if (!$registro) {
      $BE->redireccionar("Inicio.php");
   }
}

$BE->registrarEntrada();
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
        <title>Registro de Entradas</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="cssPersonal/height.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/green.css" id="theme" rel="stylesheet">
        <!-- page css -->
        <link href="css/pages/user-card.css" rel="stylesheet">
        <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                    url: 'AJAX/consultaEntradasRef.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    // beforeSend: function () {
                    //     $("#tabla_resultado").html("<div class='text-center h5'>   Procesando, espere por favor...</div>");
                    // },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#tabla_resultado").html(response);
                        var Caja = window.document.getElementById("contenedor_spinner");
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

            function ocultarCajaSpinner() {
                var Caja = window.document.getElementById("contenedor_spinner");
                if (<?php echo isset($_GET["ID"]) ?>) {
                    Caja.style.display = 'none';
                }
            }
        </script>  
        <script type="text/javascript">
            function pulsar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }

        </script>

    </head>

    <body class="fix-header card-no-border fix-sidebar" onload="ocultarCajaSpinner();">
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
                    <?php echo $BE->navbarHeader('ENTRADAS DE REFACCIONES', 'Administrador'); ?> 

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
                        <div class="col-md-3 text-center">
                            <h3 class="text-themecolor">Refacción de Entrada:</h3>
                        </div>

                        <div class="col-md-4 text-center">
                            <select  id="busqueda" onchange="realizaProceso()" class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                <option class="" value="select">Elige una Refacción...</option>
                                <?php echo $BE->mostrarRefaccionesOptions() ?>
                            </select>   
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
<!--                     <div class="row">
                        <div class="col-12">
                            <div class="col-lg-12" id="MaquinaID">
                                <div class="row el-element-overlay">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <h3 class="card-title m-l-20 m-t-20 font-weight-bold"><span class="lstick"></span>A-SK</h3>
                                            <div class="ribbon ribbon-right ribbon-default m-t-10"><strong>Clave: 4171201900</strong></div>
                                            <div class="el-card-item m-t-10">
                                                <div class="el-card-content">
                                                    <h4 class="box-title">FABRICACION DE BOQUILLA TIPO CONTOUR CON BASE AEREA PARA OVEROLL 2 5/8 X 1 3/4</h4>
                                                    <div class="col-12">
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold">Maquina:</div>
                                                            <div class="col-6">PRESILLA</div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold ">Marca:</div>
                                                            <div class="col-6">SEGURIDAD E HIGIENE</div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold">Modelo:</div>
                                                            <div class="col-6">USO MESA DE CORTE</div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>Verde</th>
                                                                    <th>Amarillo</th>
                                                                    <th>Rojo</th>
                                                                </tr>
                                                                <tr class="font-weight-bold">
                                                                    <td class="text-white bg-success">8</td>
                                                                    <td class="text-white bg-warning">4</td>
                                                                    <td class="text-white bg-danger">6</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <span class="font-weight-bold h6">Disponibles: </span><button class="btn-sm btn-success mt-2" type="button"  ><span class="h5">5</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form  method="POST" action="EntradaRef.php" class="col-lg-5 col-md-6" >
                                        <div class="card">
                                            <div class="col-12">
                                                <div class="row m-t-15 ">
                                                    <div class="col-sm-6 p-0 ">
                                                        <h3 class="card-title m-l-20 m-b-0">
                                                            <span class="lstick"></span>Información:
                                                        </h3>
                                                    </div>
                                                 
                                                    <div class="col-sm-6 text-center">
                                                        <select class="form-control custom-select col-sm-12 text-center font-weight-bold"  name="estado" id="estado">
                                                            <option value="verde" class="font-weight-bold">VERDE</option>
                                                             <option value="amarillo" class="font-weight-bold">AMARILLO</option>
                                                              <option value="rojo" class="font-weight-bold">ROJO</option>
                                                        </select>
                                                        <small class="text-danger font-weight-bold">Estado de la Refacción.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            `  
                                            <div class="card-body p-t-0">
                                                <div class="form-body">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label  col-sm-12 text-center font-medium">Cantidad:</label>
                                                                    <input autocomplete="off" type="text" class="col-sm-12  form-control text-center font-weight-bold m-r-10" name="cantidad" id="cantidad" onkeyup="calcular();">
                                                                </div>  
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label col-sm-12 text-center font-medium">Unidad de Medida:</label>
                                                                    <select class="form-control custom-select col-sm-12 text-center font-weight-bold  m-l-10"  name="unidad_medida" id="unidad_medida">
                                                                        <option value="PZ" class="font-weight-bold">PZ</option>
                                                                        <option value="CAJA" class="font-weight-bold">CAJA</option>
                                                                        <option value="LTR" class="font-weight-bold">LTR</option>
                                                                        <option value="PAQUETE" class="font-weight-bold">PAQUETE</option>
                                                                        <option value="BOQUILLA" class="font-weight-bold">BOQUILLA</option>
                                                                        <option value="PR" class="font-weight-bold">PR</option>
                                                                        <option value="KG" class="font-weight-bold">KG</option>
                                                                        <option value="MTR" class="font-weight-bold">MTR</option>
                                                                        <option value="BULTO" class="font-weight-bold">BULTO</option>
                                                                        <option value="ROLLO" class="font-weight-bold">ROLLO</option>
                                                                        <option value="CUBETA" class="font-weight-bold">CUBETA</option>
                                                                        <option value="GAUGE" class="font-weight-bold">GAUGE</option>
                                                                        <option value="GRM" class="font-weight-bold">GRM</option>
                                                                        <option value="GALON" class="font-weight-bold">GALON</option>
                                                                        <option value="ENBOBINADO" class="font-weight-bold">ENBOBINADO</option>
                                                                        <option value="JUEGO" class="font-weight-bold">JUEGO</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-t-20">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label  col-sm-12 text-center font-medium"><span class="font-weight-bold">#</span> Factura:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center m-r-10" id="factura" name="factura">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    <label class="control-label col-sm-12 text-center font-medium ">Orden Compra:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center  m-l-10" id="orden_compra" name="orden_compra">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-t-20">
                                                        <div class="row">
                                                            <label class="text-center  col-sm-12 font-medium">Proveedor:</label>
                                                            <input class="form-control text-center col-12  font-12" autocomplete="on" id="proveedor" name="proveedor">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-t-20">
                                                        <div class="row">
                                                            <div class="col-lg-5 col-sm-12">
                                                                <div class="row">
                                                                    <label class="text-center col-sm-12 font-medium">Precio Unitario:</label>
                                                                    <input  type="text" class="form-control text-center col-12  p-0 m-0" id="precio" name="precio_unitario" onkeyup="calcular();" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="row  m-t-5 m-l-20">
                                                                    <div class="col-12 p-0 m-0 text-center">
                                                                        <div class="text-dark m-b-5 font-medium">Subtotal: <span class="font-weight-bold float-right" id="subtotal01">$ 0.00</span></div> 
                                                                        <hr class="m-0 p-0"> 
                                                                        <div class="text-danger m-t-5 m-b-5 font-medium">IVA:  <span class="font-weight-bold float-right" id="IVA01">$ 0.00</span></div> 
                                                                        <hr class="m-0 p-0"> 
                                                                        <div class="text-success m-t-5 font-medium">Total:  <span class="font-weight-bold float-right" id="total01">$ 0.00</span></div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-actions">
                                                        <div class="row m-t-20">
                                                            <div class="offset-lg-4 offset-sm-7 m-b-20">
                                                                <button type="submit" class="btn btn-info" id="guardar"> <i class="fa fa-check"></i> Guardar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" value="0.00" id="subtotal" name="subtotal" class="">
                                                <input type="text" value="0.00" id="IVA" name="IVA" class="">
                                                <input type="text" value="0.00" id="total" name="total" class="">
                                                <input type="text" value="MAQ001" id="ID_Refaccion" name="ID_Refaccion" class="">
                                            </div>
                                        </div>
                                    </form>

                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><span class="lstick"></span>Historial de Movimientos:</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <section id="tabla_resultado">
                    </section>  
                    <?php
                   
                        echo ' <div id="contenedor_spinner">
                            <div id="contenedor_carga">
                                <div id="carga"></div>
                                </div>
                            <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Código de la Maquina</strong> que deseas modificar.</H4></div>
                          </div>';
                    
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
                                                                            swal("Buen trabajo!", "La se ha dado entrada a la refacción satisfactoriamente.", "success")
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

        <script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
        <script>
                                                                        jQuery(document).ready(function () {
                                                                            // Switchery
                                                                            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                                                                            $('.js-switch').each(function () {
                                                                                new Switchery($(this)[0], $(this).data());
                                                                            });
                                                                            // For select 2
                                                                            $(".select2").select2();
                                                                            $('.selectpicker').selectpicker();
                                                                            //Bootstrap-TouchSpin
                                                                            $(".vertical-spin").TouchSpin({
                                                                                verticalbuttons: true,
                                                                                verticalupclass: 'ti-plus',
                                                                                verticaldownclass: 'ti-minus'
                                                                            });
                                                                            var vspinTrue = $(".vertical-spin").TouchSpin({
                                                                                verticalbuttons: true
                                                                            });
                                                                            if (vspinTrue) {
                                                                                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                                                                            }
                                                                            $("input[name='tch1']").TouchSpin({
                                                                                min: 0,
                                                                                max: 100,
                                                                                step: 0.1,
                                                                                decimals: 2,
                                                                                boostat: 5,
                                                                                maxboostedstep: 10,
                                                                                postfix: '%'
                                                                            });
                                                                            $("input[name='tch2']").TouchSpin({
                                                                                min: -1000000000,
                                                                                max: 1000000000,
                                                                                stepinterval: 50,
                                                                                maxboostedstep: 10000000,
                                                                                prefix: '$'
                                                                            });
                                                                            $("input[name='tch3']").TouchSpin();
                                                                            $("input[name='tch3_22']").TouchSpin({
                                                                                initval: 40
                                                                            });
                                                                            $("input[name='tch5']").TouchSpin({
                                                                                prefix: "pre",
                                                                                postfix: "post"
                                                                            });
                                                                            // For multiselect
                                                                            $('#pre-selected-options').multiSelect();
                                                                            $('#optgroup').multiSelect({
                                                                                selectableOptgroup: true
                                                                            });
                                                                            $('#public-methods').multiSelect();
                                                                            $('#select-all').click(function () {
                                                                                $('#public-methods').multiSelect('select_all');
                                                                                return false;
                                                                            });
                                                                            $('#deselect-all').click(function () {
                                                                                $('#public-methods').multiSelect('deselect_all');
                                                                                return false;
                                                                            });
                                                                            $('#refresh').on('click', function () {
                                                                                $('#public-methods').multiSelect('refresh');
                                                                                return false;
                                                                            });
                                                                            $('#add-option').on('click', function () {
                                                                                $('#public-methods').multiSelect('addOption', {
                                                                                    value: 42,
                                                                                    text: 'test 42',
                                                                                    index: 0
                                                                                });
                                                                                return false;
                                                                            });
                                                                            $(".ajax").select2({
                                                                                ajax: {
                                                                                    url: "https://api.github.com/search/repositories",
                                                                                    dataType: 'json',
                                                                                    delay: 250,
                                                                                    data: function (params) {
                                                                                        return {
                                                                                            q: params.term, // search term
                                                                                            page: params.page
                                                                                        };
                                                                                    },
                                                                                    processResults: function (data, params) {
                                                                                        // parse the results into the format expected by Select2
                                                                                        // since we are using custom formatting functions we do not need to
                                                                                        // alter the remote JSON data, except to indicate that infinite
                                                                                        // scrolling can be used
                                                                                        params.page = params.page || 1;
                                                                                        return {
                                                                                            results: data.items,
                                                                                            pagination: {
                                                                                                more: (params.page * 30) < data.total_count
                                                                                            }
                                                                                        };
                                                                                    },
                                                                                    cache: true
                                                                                },
                                                                                escapeMarkup: function (markup) {
                                                                                    return markup;
                                                                                }, // let our custom formatter work
                                                                                minimumInputLength: 1,
                                                                                templateResult: formatRepo, // omitted for brevity, see the source of this page
                                                                                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                                                                            });
                                                                        });
        </script>
        <script>
            function calcular() {
                var cantidad = parseFloat($('#cantidad').val());
                var precio = parseFloat($('#precio').val());

                if (precio && cantidad) {
                    var calculo1 = precio * cantidad;
                    var calculo01 = calculo1.toFixed(2).toString();
                    var calculo2 = calculo1 * 0.16;
                    var calculo02 = calculo2.toFixed(2).toString();
                    var calculo3 = calculo1 + calculo2;
                    var calculo03 = calculo3.toFixed(2).toString();

                    $('#subtotal01').text('$ ' + calculo01);
                    $('#IVA01').text('$ ' + calculo02);
                    $('#total01').text('$ ' + calculo03);

                    $('#subtotal').val(calculo01);
                    $('#IVA').val(calculo02);
                    $('#total').val(calculo03);
                } else {
                    $('#subtotal01').text('$ 0.00');
                    $('#IVA01').text('$ 0.00');
                    $('#total01').text('$ 0.00');

                    $('#subtotal').val('0.00');
                    $('#IVA').val('0.00');
                    $('#total').val('0.00');
                }
            }


        </script>
        <!-- ============================================================== -->
        <!-- Style switcher -->
        <!-- ============================================================== -->
        <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    </body>

</html>