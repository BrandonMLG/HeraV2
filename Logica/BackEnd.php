<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FrontEnd
 *
 * @author GS63VR
 */
class BackEnd {

    private $modelo;

    public function __construct() {
        $this->modelo = new Modelo();
    }

    public function mensaje($msj) {

        return "<script>alert('.$msj.')</script>";
    }

    public function alertaCerrarSesion() {
        return '<div id="idle-timeout-dialog" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tu sesión expira pronto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <i class="fa fa-warning font-red"></i> Se finalizará la sesión debido a la inactividad detectada: 
                                                    <strong class="h4"><span id="idle-timeout-counter"></span></strong> segundos.</p>
                                                <p>Quieres continuar con la sesión? </p>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button id="idle-timeout-dialog-keepalive" type="button" class="btn btn-success" data-dismiss="modal">Si, Deseo continuar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
    }

    public function navbarLogos() {
        return '<div class="navbar-header">
                        <a class="navbar-brand" href="">
                            <b>
                                <!--Logos-->
                                <img src="../assets/images/logoAzul.png" alt="homepage" class="dark-logo m-l-5" />
                                <img src="../assets/images/logoBlanco.png" alt="homepage" class="light-logo m-l-5"/>
                            </b>
                            <!-- Logo text -->
                            <span>
                                <img src="../assets/images/letrasAzul.png" alt="homepage" class="dark-logo animated bounce m-l-5" />
                                <img src="../assets/images/letrasBlancas.png" class="light-logo" alt="homepage" /></span> </a>
                    </div>';
    }

    public function navbarHeader($Titulo, $Usuario) {
        return '  <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto">
                            <!-- This is  -->
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item hidden-sm-down"></li>
                        </ul>
                        <!-- User profile and search -->
                        <div class="text-center col-lg-11 col-sm-9 col-md-6">
                            <p class="h3 text-white">
                                ' . $Titulo . '
                            </p>
                        </div>
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/HERA1.jpg" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="../assets/images/users/HERA1.jpg" alt="user"></div>
                                                <div class="u-text">
                                                    <h4>' . $Usuario . '</h4>
                                                    <p class="text-muted">@soporte.tehuacan</p><a href="Inicio.php" class="btn btn-rounded btn-danger btn-sm">Go to Start</a></div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="Inicio.php?salir=1"><i class="fa fa-power-off"></i> Cerrar Sesion</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>';
    }

    public function sideBar() {
        $ID_Usuario = $_SESSION["usuario"]["ID"];

        $acu = '<aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="../assets/images/users/HERA4.png" alt="user" /><span class="hide-menu">'
                . $_SESSION["usuario"]["Usuario"] . '</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <!--                                    <li><a href="javascript:void()">My Profile </a></li>
                                                                        <li><a href="javascript:void()">My Balance</a></li>
                                                                        <li><a href="javascript:void()">Inbox</a></li>
                                                                        <li><a href="javascript:void()">Account Setting</a></li>-->
                                     <li><a href="Inicio.php">Ir a Inicio</a></li>
                                    <li><a href="Inicio.php?salir=1">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                            <li class="nav-devider"></li>';
        $registros = $this->modelo->ModulosUsuarios($ID_Usuario);
        $cont = 1;
        foreach ($registros as $r) {

            $interfaz = $this->modelo->InterfazUsuarios($ID_Usuario, $r["modulo"]);
            $num = count($interfaz);
            $acu = $acu . '
                <li> 
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="' . $r["icon"] . '"></i><span class="hide-menu">' . $r["modulo"] . '<span class="label label-rouded ' . $this->ordenColores($cont) . ' pull-right">' . $num . '</span></span></a>';
            if ($cont === 5) {
                $cont = 1;
            } else {
                $cont++;
            }
            foreach ($interfaz as $i) {
                $acu = $acu . '<ul aria-expanded="false" class="collapse">
                                            <li><a href="' . $i["url"] . '">' . $i["nombre"] . '</a></li>
                                       </ul>';
            }
            $acu = $acu . '</li>'
                    . '<li class="nav-devider"></li>';
        }

        $acu = $acu . '</ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->i
            </aside>';
        return $acu;
    }

    public function ordenColores($num) {
        if ($num === 1) {
            return 'label-success';
        } else if ($num === 2) {
            return 'label-warning';
        } else if ($num === 3) {
            return 'label-danger';
        } else if ($num === 4) {
            return 'label-info';
        } else if ($num === 5) {
            return 'label-primary';
        }
    }

    public function faviconLogo() {
        return ' <link rel="icon" type="image/png" sizes="20x20" href="../assets/images/logoBlanco.png">';
    }

    public function autentificar() {
        if (isset($_POST["usuario"]) && isset($_POST["password"])) {
            $user = $_POST["usuario"];
            $password = md5($_POST["password"]);
            $user = $this->modelo->consultarUsuario($user, $password);
            if (isset($user)) {
                $_SESSION["usuario"] = $user;
            }
        }
    }

    public function autentificar2() {
        if (isset($_POST["usuario"]) && isset($_POST["password"])) {
            if ($this->consultarUsuario($_POST["usuario"])) {
                //El usuario y contraseña son correctas
                if ($this->consultarUsuarioPassword($_POST["usuario"], $_POST["password"])) {
                    //Consultar info del usuario
                    $user = $this->modelo->consultarUsuario($_POST["usuario"], md5($_POST["password"]));
                    if (isset($user)) {
                        //Implementar 
                        $_SESSION["usuario"] = $user;
                    }
                } else {
                    //La contraseña es incorrecta
                    $this->redireccionar('Login.php?status='. md5("errorPass").'');
                }
            } else {
                //El usuario ingresado no existe
                $this->redireccionar('Login.php?status='. md5("errorUser").'');
            }
        }
    }

    public function consultarEmpleadoNominaCompleta($ID) {
        $coincidencia = $this->modelo->consultarEmpleadoNominaCompleta($ID);
        return $coincidencia;
    }

    public function consultarEmpleadoNominaCompletaIncidencias($ID, $Semana) {
        $coincidencia = $this->modelo->consultarEmpleadoNominaCompletaIncidencias($ID, $Semana);
        return $coincidencia;
    }

    public function returnUltimaSemana() {
        $sentencia = $this->modelo->returnSemanasNomina();

        $text = '';
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $semana) {
            $text = $text . '<option class="text-center" value="' . $semana["Semana"] . '">Semana ' . $semana["Semana"] . '</option>';
        }

        return $text;
    }

    public function bonosEfi($Efi, $BonoProduccion, $Incidencia) {
        $Dif;
        if ($Efi >= 84 && $Efi < 90) {
            $Dif = (.85) * ($BonoProduccion / 5);
            $Dif = $this->darFormatoMoneda($Dif);
            $Dif = '<span class="label label-rounded label-success pull-center">' . $Dif . '</span>';
        } elseif ($Efi >= 90 && $Efi < 95) {
            $Dif = (.90) * ($BonoProduccion / 5);
            $Dif = $this->darFormatoMoneda($Dif);
            $Dif = '<span class="label label-rounded label-success pull-center">' . $Dif . '</span>';
        } elseif ($Efi >= 95 && $Efi < 100) {
            $Dif = (.95) * ($BonoProduccion / 5);
            $Dif = $this->darFormatoMoneda($Dif);
            $Dif = '<span class="label label-rounded label-success pull-center">' . $Dif . '</span>';
        } elseif ($Efi >= 100) {
            $Dif = (1.00) * ($BonoProduccion / 5);
            $Dif = $this->darFormatoMoneda($Dif);
            $Dif = '<span class="label label-rounded label-success pull-center">' . $Dif . '</span>';
        } else {
            if (trim($Incidencia) == 'GG') {
                $Dif = '<span class="label label-rounded label-success pull-center"><i class="icon-like"></i></span>';
            } elseif (trim($Incidencia) == 'VAC') {
                $Dif = '<span class="label label-rounded label-info pull-center"><i class=" icon-cup"></i> Vaciones</span>';
            } elseif (trim($Incidencia) == 'PCGS') {
                $Dif = '<span class="label label-rounded label-info pull-center"><i class="icon-check"></i> Permiso C/Gose</span>';
            } elseif (trim($Incidencia) == 'PSGS') {
                $Dif = '<span class="label label-rounded label-danger pull-center"><i class="icon-close"></i> Permiso S/Gose</span>';
            } elseif (trim($Incidencia) == 'INCIM') {
                $Dif = '<span class="label label-rounded label-primary pull-center"><i class="icon-direction"></i> Incapacidad</span>';
            } elseif (trim($Incidencia) == 'F') {
                $Dif = '<span class="label label-rounded label-danger pull-center"><i class="icon-dislike"></i> Falta</span>';
            } elseif (trim($Incidencia) == 'SUSP') {
                $Dif = '<span class="label label-rounded label-primary pull-center"><i class="icon-ghost"></i> Suspención</span>';
            } elseif (trim($Incidencia) == 'FEST') {
                $Dif = '<span class="label label-rounded label-success pull-center"><i class="icon-tag"></i> Día Festivo</span>';
            } elseif (trim($Incidencia) == 'ERR') {
                $Dif = '<span class="label label-rounded label-warning pull-center"><i class="icon-clock"></i> Sin Registros</span>';
            } else {
                $Dif = '<span class="label label-rounded label-warning pull-center"><i class="icon-info"></i></span>';
            }
        }
        return $Dif;
    }

    public function consultarMaquinaria($ID) {
        $coincidencia = $this->modelo->consultarMaquinaria($ID);
        return $coincidencia;
    }

    public function consultarUsuario($usuario) {
        $coincidencia = $this->modelo->verificarUsuario($usuario);
        return $coincidencia["Usuario"];
    }

    public function consultarUsuarioPassword($usuario, $password) {
        $coincidencia = $this->modelo->consultarUsuario($usuario, md5($password));
        return $coincidencia["Usuario"];
    }

    public function buscarMaquinaria($Ubicacion, $criterio, $estado) {
        $coincidencias = $this->modelo->buscarMaquinaria($Ubicacion, $criterio, $estado);
        $Numerocoincidencias = $this->modelo->numCoincidenciasbuscarMaquinaria($Ubicacion, $criterio, $estado);
        $cont = 1;
        $acu = '          <div class="row">      
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Maquinaria: <Strong>' . $Ubicacion . ' </Strong></h3>
                                      <h5 class="card-subtitle  text-lg-right"><span class="text-danger">' . $Numerocoincidencias["Num"] . ' coincidencias</span> <a href="../excel/filtroMaquinaria.php?busqueda=' . $Ubicacion . '&criterio=' . $criterio . '&estado=' . $estado . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Orden.</th>
                                                <th class="text-center">Activo</th>
                                                <th>Maquina</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Serie</th>
                                                <th>Estado</th>
                                                <th>More</th>
                                                <th>Modificar</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
        foreach ($coincidencias as $r) {
            $acu = $acu . '   
                            <tr>
                                                     <td class="text-center"><h4>' . $cont . '</h4></td>
                                                    <td class="text-center">' . $r["NumeroActivo"] . '</td>
                                                    <td>' . $r["Maquina"] . '</td>
                                                    <td><span class="text-muted">' . $r["Marca"] . '</span> </td>
                                                    <td>' . $r["Modelo"] . '</td>
                                                    <td>' . $r["Serie"] . '</td>
                                                    <td class="text-center">
                                                        <button class="btn-sm ' . $this->colorEstadoMaquina($r["Estado"]) . '" type="button"  >
                                                            ' . $r["Estado"] . '
                                                        </button>
                                                    </td>
                                                     <td>
                                                        <button class=" btn-sm btn-rounded btn-primary" data-toggle="collapse" data-target="#collapseExample' . $r["Orden"] . '">
                                                           <i class="h5 mdi mdi-plus-circle-outline "></i>
                                                        </button>
                                                    </td>
                                                    <td>
                                                       <a href="ConsultarMaquinaria.php?ID=' . $r["NumeroActivo"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"></a>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td colspan="8" class="p-0">
                                                        <div class="collapse container m-b-40" id="collapseExample' . $r["Orden"] . '" >
                                                            <div class="m-t-40 row ">
                                                                <div class="col-4">
                                                                    <img src="' . $this->verificarFotoMaquina($r["NumeroActivo"]) . '" alt="" style="height: 180px;width: 300px;"  class="rounded animated bounce el-overlay">
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="row text-justify">
                                                                        
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Ubicacion: </span>' . $r["Ubicacion"] . '</p> 
                                                                            <p><span class="font-bold">Ultima Actualizacion: </span><br>' . $r["UltimaActualizacion"] . '</p>

                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Estado: </span>' . $r["Estado"] . '</p> 
                                                                            <p><span class="font-bold">Propietario: </span>' . $r["Propietario"] . '</p> 

                                                                        </div>
                                                                        <div class="col-12">
                                                                        <p><span class="font-bold tex-js">Comentario: </span>' . $r["Comentario"] . '</p>                                                                
                                                                        </div>
                                                                    </div
                                                                </div>

                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                 
                                               
';
            $cont = $cont + 1;
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>';

        return $acu;
    }

    public function verifRef($criterio) {
        if ($criterio <> "") {
            return '<h4 class="card-title text-center">Resultados para: <span class="font-weight-bold">' . $criterio . '</span></h4>';
        } else {
            return '<h4 class="card-title text-center font-weight-bold">Concentrado de Refacciones</h4>';
        }
    }

    public function veriInOut($tipo) {
        if ($tipo == "entrada_refaccion") {
            return '<h4 class="card-title text-center"> <span class="font-weight-bold">Entradas de Refacciones:</span></h4>';
        } else {
            return '<h4 class="card-title text-center"> <span class="font-weight-bold">Salidas de Refacciones:</span></h4>';
        }
    }

    public function buscarInOutRef($tipo, $inicio, $fin) {
        $registros = $this->modelo->BuscarInOutRef($tipo, $inicio, $fin);

        if ($tipo === "entrada_refaccion") {
            $acu = '                   
                    <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                            <h4 class="card-title text-center"> <span class="font-weight-bold">Entradas de Refacciones:</span></h4>
                                              <h5 class="card-subtitle  text-lg-right"><a href="../excel/reporteInOutRef.php?tipo=' . $tipo . '&inicio=' . $inicio . '&fin=' . $fin . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Orden</th>
                                                                <th class="text-center">Estante</th>
                                                                <th class="text-center">Refaccion</th>
                                                                 <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
            $cont = 1;
            foreach ($registros as $r) {
                $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $cont . '</td>
                                                    <td class="font-weight-bold text-center">' . $r["estante"] . '</td>
                                                    <td class="text-center">' . $r["descripcion"] . '</td>
                                                   <td class="text-center">' . $r["proveedor"] . '</td>    
                                                    <td class="text-center">
                                                       <button type="button" class="font-weight-bold btn-success btn-sm" >' . $r["cantidad"] . '</button>
                                                    </td>
                                                    <td class="text-center">' . $this->fechaMx($r["fecha"]) . '</td>    
                                                     <td>
                                                       <a href="SalidasRef.php?ID=' . $r["ID_Entrada"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"></a>
                                                    </td>
                            </tr>                      
                                                 
                                               
';
                $cont++;
            }
            $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {
            $acu = '                   
                    <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                            <h4 class="card-title text-center"> <span class="font-weight-bold">Salidas de Refacciones:</span></h4>
                                              <h5 class="card-subtitle  text-lg-right"><a href="../excel/reporteInOutRef.php?tipo=' . $tipo . '&inicio=' . $inicio . '&fin=' . $fin . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Orden</th>
                                                                <th class="text-center">Estante</th>
                                                                <th class="text-center">Refaccion</th>
                                                                 <th class="text-center">Nombre</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
            $cont = 1;
            foreach ($registros as $r) {
                $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $cont . '</td>
                                                    <td class="font-weight-bold text-center">' . $r["estante"] . '</td>
                                                    <td class="text-center">' . $r["descripcion"] . '</td>
                                                   <td class="text-center">' . $r["nombre"] . '</td>    
                                                    <td class="text-center">
                                                       <button type="button" class="font-weight-bold btn-danger btn-sm" >' . $r["cantidad"] . '</button>
                                                    </td>
                                                    <td class="text-center">' . $this->fechaMx($r["fecha"]) . '</td>    
                                                      <td>
                                                       <a href="SalidasRef.php?ID=' . $r["ID_Salida"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"></a>
                                                    </td>
                            </tr>                      
                                                 
                                               
';
                $cont++;
            }
            $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
        }


        return $acu;
    }

    public function buscarRefacciones($criterioBusqueda, $filtro, $estado) {
        $registros = $this->modelo->BuscarRefacciones($criterioBusqueda, $filtro, $estado);
        $Numerocoincidencias = $this->modelo->numRefaccionesEncontradas($criterioBusqueda, $filtro, $estado);
        $acu = '                   
                    <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                            ' . $this->verifRef($criterioBusqueda) . '
                                              <h5 class="card-subtitle  text-lg-right"><span class="text-info font-weight-bold">' . $Numerocoincidencias["Num"] . ' Coincidencias Encontradas</span> <a href="../excel/reporteRefacciones.php?busqueda=' . $criterioBusqueda . '&filtro=' . $filtro . '&estado=' . $estado . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Orden</th>
                                                                <th class="text-center">Estante</th>
                                                                <th class="text-center">Refaccion</th>
                                                                 <th class="text-center">Stock</th>
                                                                <th class="text-center">Clave</th>
                                                                <th class="text-center">Maquina</th>
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        $cont = 1;
        foreach ($registros as $r) {
            $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $cont . '</td>
                                                    <td class="font-weight-bold text-center">' . $r["estante"] . '</td>
                                                    <td class="text-center">' . $r["descripcion"] . '</td>
                                                    <td class="text-center">
                                                       <button type="button" class="font-weight-bold ' . $this->verificarStock($r["stock"]) . ' btn-sm" >' . $r["stock"] . '</button>
                                                    </td>
                                                    <td class="text-center">' . $r["clave"] . '</td>    
                                                    <td class="text-center">' . $r["maquina"] . '</td>   
                                                    <td>
                                                       <a href="ModificarRef.php?ID=' . $r["ID_Refaccion"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"></a>
                                                    </td> 
                            </tr>                      
                                                 
                                               
';
            $cont++;
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $acu;
    }

    
    public function buscarRefaccionesMec($criterioBusqueda, $filtro) {
        $registros = $this->modelo->BuscarRefaccionesMec($criterioBusqueda, $filtro);
        $Numerocoincidencias = $this->modelo->numRefaccionesEncontradasMec($criterioBusqueda, $filtro);
        $acu = '                   
                    <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                            ' . $this->verifRef($criterioBusqueda) . '
                                              <h5 class="card-subtitle  text-right"><span class="text-info font-weight-bold">' . $Numerocoincidencias["Num"] . ' Coincidencias Encontradas</span></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Orden</th>
                                                                <th class="text-center">Estante</th>
                                                                <th class="text-center">Refaccion</th>
                                                                 <th class="text-center">Stock</th>
                                                                <th class="text-center">Clave</th>
                                                                <th class="text-center">Maquina</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        $cont = 1;
        foreach ($registros as $r) {
            $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $cont . '</td>
                                                    <td class="font-weight-bold text-center">' . $r["estante"] . '</td>
                                                    <td class="text-center">' . $r["descripcion"] . '</td>
                                                    <td class="text-center">
                                                       <button type="button" class="font-weight-bold ' . $this->verificarStock($r["stock"]) . ' btn-sm" >' . $r["stock"] . '</button>
                                                    </td>
                                                    <td class="text-center">' . $r["clave"] . '</td>    
                                                    <td class="text-center">' . $r["maquina"] . '</td>   
                            </tr>                      
                                                 
                                               
';
            $cont++;
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $acu;
    }
    
    public function fechaMx($fecha) {
        date_default_timezone_set('America/Mexico_City');
// Unix
        setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
        setlocale(LC_TIME, 'spanish');
        return $date = date('d-M-Y', strtotime($fecha));
    }

    public function fechaActual() {
        date_default_timezone_set('America/Mexico_City');
        return date('Y-m-d');
    }

    public function formatoMoneda($number) {
        setlocale(LC_MONETARY, "es_ES");
        $number = money_format("%.2n", $number);
        return $number;
    }

    public function fechaMxHora($fecha) {
        date_default_timezone_set('America/Mexico_City');
// Unix
        setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
        setlocale(LC_TIME, 'spanish');
        return $date = date('d-M-Y H:i:s', strtotime($fecha));
        ;
    }

    public function buscarMaquinariaID($ID) {
        $infoMaquina = $this->modelo->buscarMaquinariaID($ID);

        $acu = '';
        if (isset($infoMaquina["NumeroActivo"])) {
            $histMovimientos = $this->modelo->historialMovMaquinaria($ID);

            $acu = $acu . '<div class="col-lg-12" id="MaquinaID">
                    <div class="row el-element-overlay">
                        <!--                        <div class="col-md-12">
                                                    <h4 class="card-title">Modificación de Maquinaria</h4>
                                                    <h6 class="card-subtitle m-b-20 text-muted">Efectua los cambios que requieras y guardalos presionando <code>accept</code></h6>
                                                </div>-->
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <h3 class="card-title m-l-20 m-t-20"><span class="lstick"></span>' . $infoMaquina["NumeroActivo"] . '</h3>
                                <div class="ribbon ribbon-right ribbon-default m-t-10"><strong>' . $infoMaquina["Marca"] . '</strong></div>
                                <div class="el-card-item m-t-10">
                                    <div class="el-overlay-1"> <img src="' . $this->verificarFotoMaquina($infoMaquina["NumeroActivo"]) . '" alt="user"/>

                                    </div>
                                    <div class="el-card-content">
                                        <h3 class="box-title">' . $infoMaquina["Maquina"] . '</h3> <small>Modelo: <strong>' . $infoMaquina["Modelo"] . '</strong> </small><small> Serie: <strong>' . $infoMaquina["Serie"] . '</strong></small>
                                        <br/>
                                        <button class="btn-sm ' . $this->colorEstadoMaquina($infoMaquina["Estado"]) . ' mt-2" type="button"  >' . $infoMaquina["Estado"] . '</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form  method="POST" action="ConsultarMaquinaria.php" class="col-lg-5 col-md-6" >
                            <div class="card">
                                `            <h3 class="card-title m-l-20"><span class="lstick"></span>Información: </h3>
                                <div class="card-body">
                                    <div class="form-body">
                                         <div class="form-group row" hidden="" >
                                            <label class="control-label text-left col-md-5">No. Activo:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Activo" name="NumeroActivo" value="' . $infoMaquina["NumeroActivo"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">Maquina:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Maquina" name="Maquina" value="' . $infoMaquina["Maquina"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">Marca:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Marca" name="Marca" value="' . $infoMaquina["Marca"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">Modelo:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Modelo" name="Modelo" value="' . $infoMaquina["Modelo"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">No. Serie:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Serie" name="Serie" value="' . $infoMaquina["Serie"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">Propietario:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="Propietario" name="Propietario" value="' . $infoMaquina["Propietario"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row" hidden="">
                                            <label class="control-label text-left col-md-5">ID:</label>
                                            <div class="col-md-7">
                                                <input class="typeahead form-control" type="text"  placeholder="ID" name="ID" value="' . $infoMaquina["Orden"] . '">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-5">Modificar Ubicación:</label>
                                            <div class="col-md-7">
                                                <select class="form-control custom-select"  name="Ubicacion">
                                                    <option value="' . $infoMaquina["Ubicacion"] . '">' . $infoMaquina["Ubicacion"] . '</option>
                                                   ' . $this->mostrarUbicacionesMaquinaria() . '
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-5">Modificar Estado:</label>
                                            <div class="col-md-7">
                                                <select class="form-control custom-select"  name="Estado">
                                                    <option value="' . $infoMaquina["Estado"] . '" >' . $infoMaquina["Estado"] . '</option>
                                                    ' . $this->mostrarEstadosMaquinaria() . '
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="form-group col-md-12 m-t-20">
                                        <label>Modificar Comentario:</label>
                                        <textarea class="form-control" rows="4" name="Comentario">' . $infoMaquina["Comentario"] . '</textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row m-b-15">
                                        <div class="offset-sm-4 col-md-9">
                                            <button type="submit" class="btn btn-info"> <i class="fa fa-check"></i> Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><span class="lstick"></span>Historial de Movimientos:</h5>
                                    <div class="col-lg-12">';
            $cont = 1;
            foreach ($histMovimientos as $r) {
                $acu = $acu . '   
                                    
                                      <div class="row">
                                            <div class="col-lg-1 text-center">
                                                <h3>' . $cont . '</h3>
                                            </div>
                                            <div class="col-lg-8">
                                                <strong>' . $this->acortarTexto($r["Ubicacion"], 10) . '</strong>
                                                <br><small><span>' . $this->fechaMx($r['UltimaActualizacion']) . '</span></small>
                                            </div>
                                            <div class="col-lg-2 text-success align-self-start">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                        </div>
                                        <hr class="m-t-10 m-b-15">';
                $cont ++;

                if (++$cont == 6)
                    break;
            }
            $acu = $acu . '   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            $acu = $acu . ' <div id="MaquinaID">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>No se encontraron coincidencias con sus criterios de búsqueda.</H4></div>
                         </div>';
        }

        return $acu;
    }

    public function consultarMaquina($ID) {
        $coincidencia = $this->modelo->consultarNomina($ID);
//        foreach ($coincidencia as $empleado) {
//            return $empleado["Importe"];
//        }
        return $coincidencia;
    }

    public function darFormatoMoneda($numero) {
        if ($numero) {
            $nombre_format = number_format($numero, 2, '.', ',');
            return '$ ' . $nombre_format;
        } else {
            return '$ ' . '0.00';
        }
    }

    public function darFormatoMoneda2($numero) {
        $nombre_format = number_format($numero, 2, '.', ',');
        return $nombre_format;
    }

    public function verificarFotoMaquina($id) {

        if (file_exists('../main/imagenesMaquinaria/' . $id . '.JPG')) {
            return "imagenesMaquinaria/$id.JPG";
        } else {
            return "imagenesMaquinaria/notfound.png";
        }
    }

    public function verificarFotoEmpleado($id) {

        if (file_exists('../../main/imagenesEmpleados/' . $id . '.jpg')) {
            return 'imagenesEmpleados/' . $id . '.jpg';
        } else {
            return 'imagenesEmpleados/notfound.jpg';
        }
    }

    public function colorEstadoMaquina($estado) {
//        AMARILLO |
//        | FALTAN PIE |
//        | NEGRO |
//        | PENDIENTE |
//        | ROJO |
//        | VERDE |
//        | x diagnost

        if ($estado == 'VERDE') {
            return 'btn-success';
        } else if ($estado == 'AMARILLO') {
            return 'btn-warning';
        } else if ($estado == 'ROJO') {
            return 'btn-danger';
        } else if ($estado == 'NEGRO') {
            return 'bg-dark text-white';
        } else {
            return 'btn-info';
        }
    }

    public function mostrarMaquinariaV2($estado) {
        $registros = $this->modelo->MostrarMaquinaria($estado);
        $Numerocoincidencias = $this->modelo->numMaquinas($estado);
        $acu = '                   
                                <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                             <h4 class="card-title text-center">Concentrado de Maquinaria</h4>
                                              <h5 class="card-subtitle  text-lg-right"><span class="text-danger">' . $Numerocoincidencias["numero"] . ' coincidencias</span> <a href="../excel/reporteMaquinaria.php?estado=' . $estado . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Activo</th>
                                                                <th>Maquina</th>
                                                                <th>Marca</th>
                                                                <th>Modelo</th>
                                                                <th>Serie</th>
                                                                <th>Estado</th>
                                                                <!--     <th>More</th> -->
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $r["NumeroActivo"] . '</td>
                                                    <td>' . $r["Maquina"] . '</td>
                                                    <td><span class="text-muted">' . $r["Marca"] . '</span> </td>
                                                    <td>' . $r["Modelo"] . '</td>
                                                    <td>' . $r["Serie"] . '</td>
                                                    <td class="text-center">
                                                        <button class="btn-sm ' . $this->colorEstadoMaquina($r["Estado"]) . '" type="button"  >
                                                            ' . $r["Estado"] . '
                                                        </button>
                                                    </td>
                                                     <!--    <td>
                                                        <button class=" btn-sm btn-rounded btn-primary" data-toggle="collapse" data-target="#collapseExample' . $r["Orden"] . '">
                                                           <i class="h5 mdi mdi-plus-circle-outline "></i>
                                                        </button> --->
                                                    </td>
                                                    <td>
                                                        <a href="ConsultarMaquinaria.php?ID=' . $r["NumeroActivo"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"> </a>

                                                    </td> 
                                                </tr>
                                                  <!--    <tr>
                                                    <td colspan="8" class="p-0">
                                                        <div class="collapse container m-b-40" id="collapseExample' . $r["Orden"] . '" >
                                                            <div class="m-t-40 row ">
                                                                <div class="col-4">
                                                                    <img src="' . $this->verificarFotoMaquina($r["NumeroActivo"]) . '" alt="" style="height: 180px;width: 300px;"  class="rounded animated bounce el-overlay">
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="row text-justify">
                                                                        
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Ubicacion: </span>' . $r["Ubicacion"] . '</p> 
                                                                            <p><span class="font-bold">Ultima Actualizacion: </span><br>' . $r["UltimaActualizacion"] . '</p>

                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Estado: </span>' . $r["Estado"] . '</p> 
                                                                            <p><span class="font-bold">Propietario: </span>' . $r["Propietario"] . '</p> 

                                                                        </div>
                                                                        <div class="col-12">
                                                                        <p><span class="font-bold tex-js">Comentario: </span>' . $r["Comentario"] . '</p>                                                                
                                                                        </div>
                                                                    </div
                                                                </div>

                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr> -->
                                                 
                                               
';
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $acu;
    }
    
    
    
    
     public function mostrarRefacciones($busqueda) {
        $registros = $this->modelo->MostrarMaquinaria($busqueda);
        $Numerocoincidencias = $this->modelo->numMaquinas($busqueda);
        $acu = '                   
                                <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                             <h4 class="card-title text-center">Concentrado de Maquinaria</h4>
                                              <h5 class="card-subtitle  text-lg-right"><span class="text-danger">' . $Numerocoincidencias["numero"] . ' coincidencias</span> <a href="../excel/reporteMaquinaria.php?estado=' . $estado . '" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Activo</th>
                                                                <th>Maquina</th>
                                                                <th>Marca</th>
                                                                <th>Modelo</th>
                                                                <th>Serie</th>
                                                                <th>Estado</th>
                                                                <!--     <th>More</th> -->
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   
                            <tr>
                                                    <td class="text-center">' . $r["NumeroActivo"] . '</td>
                                                    <td>' . $r["Maquina"] . '</td>
                                                    <td><span class="text-muted">' . $r["Marca"] . '</span> </td>
                                                    <td>' . $r["Modelo"] . '</td>
                                                    <td>' . $r["Serie"] . '</td>
                                                    <td class="text-center">
                                                        <button class="btn-sm ' . $this->colorEstadoMaquina($r["Estado"]) . '" type="button"  >
                                                            ' . $r["Estado"] . '
                                                        </button>
                                                    </td>
                                                     <!--    <td>
                                                        <button class=" btn-sm btn-rounded btn-primary" data-toggle="collapse" data-target="#collapseExample' . $r["Orden"] . '">
                                                           <i class="h5 mdi mdi-plus-circle-outline "></i>
                                                        </button> --->
                                                    </td>
                                                    <td>
                                                        <a href="ConsultarMaquinaria.php?ID=' . $r["NumeroActivo"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"> </a>

                                                    </td> 
                                                </tr>
                                                  <!--    <tr>
                                                    <td colspan="8" class="p-0">
                                                        <div class="collapse container m-b-40" id="collapseExample' . $r["Orden"] . '" >
                                                            <div class="m-t-40 row ">
                                                                <div class="col-4">
                                                                    <img src="' . $this->verificarFotoMaquina($r["NumeroActivo"]) . '" alt="" style="height: 180px;width: 300px;"  class="rounded animated bounce el-overlay">
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="row text-justify">
                                                                        
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Ubicacion: </span>' . $r["Ubicacion"] . '</p> 
                                                                            <p><span class="font-bold">Ultima Actualizacion: </span><br>' . $r["UltimaActualizacion"] . '</p>

                                                                        </div>
                                                                        <div class="col-6">
                                                                            <p><span class="font-bold">Estado: </span>' . $r["Estado"] . '</p> 
                                                                            <p><span class="font-bold">Propietario: </span>' . $r["Propietario"] . '</p> 

                                                                        </div>
                                                                        <div class="col-12">
                                                                        <p><span class="font-bold tex-js">Comentario: </span>' . $r["Comentario"] . '</p>                                                                
                                                                        </div>
                                                                    </div
                                                                </div>

                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr> -->
                                                 
                                               
';
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $acu;
    }

    public function mostrarMttosPreventivos() {
        $registros = $this->modelo->MostrarMttosPreventivos();
        $coincidencias = $this->modelo->numMP();
        $acu = '                <div class="row">      
                                    <div class="col-md-12">
                                      <form class="form-material" method="GET" action="Descargas.php">
                                         <div class="card">
                                            <div class="card-body">
                                             <h4 class="card-title text-center font-weight-bold">Reportes Mantenimiento Preventivo:</h4>
                                                <h5 class="card-subtitle  text-right"><span class="text-success font-weight-bold">' . $coincidencias["numero"] . ' coincidencias</span>
                                                    <a onclick="SelectAll(this)" class="btn-sm btn-info btn-rounded text-white ml-3 mr-2"><i class="fa  fa-paper-plane-o"></i> All</a> <button type="submit" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</button></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="">
                                                                <th class="font-weight-bold text-center">MP</th>
                                                                <th class="font-weight-bold text-center">Inspector</th>
                                                                <th class="font-weight-bold text-center">No. Maquina</th>
                                                                <th class="font-weight-bold text-center">Maquina</th>
                                                                <th class="font-weight-bold text-center">Fecha</th>
                                                                <th class="font-weight-bold text-center">Documento</th>
                                                                <th class="font-weight-bold text-center">Descargar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        foreach ($registros as $r) {

            $nombreInspector = $this->modelo->buscarUserMtto_Pre($r["ID_Mtto"]);
            $infoMaquina = $this->modelo->buscarMaquinariaID($r["ID_Maquina"]);
            $acu = $acu . '   
                            <tr>
                                                    <td class="font-weight-bold text-center ">' . $r["ID_Mtto"] . '</td>
                                                    <td class="font-medium text-center">' . $nombreInspector["Usuario"] . '</td>
                                                    <td class="font-medium text-center">' . $r["ID_Maquina"] . '</td>
                                                         <td class="font-medium text-center">' . $infoMaquina["Maquina"] . '</td>
                                                    <td class="font-medium text-center">' . $this->fechaMx($r["fecha"]) . '</td>
                                                    <td class="font-medium text-center">
                                                      <span class="label label-danger"><i class="font-medium fa fa-file-pdf-o"></i> .pdf</span>
                                                    </td>
                                                    <td class="form-check text-center">
                                                            <input class="form-check-input" type="checkbox" name="check[]" value="' . $r["ID_Mtto"] . '" id="check' . $r["ID_Mtto"] . '">
                                                            <label class="form-check-label" for="check' . $r["ID_Mtto"] . '"></label>
                                                    </td> 
                                                </tr>';
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>';
        return $acu;
    }

    public function mostrarMttosPreventivos2($busqueda, $criterio) {
        $registros = $this->modelo->MostrarMttosPreventivos2($busqueda, $criterio);
        $coincidencias = $this->modelo->numMP2($busqueda, $criterio);
        $acu = '                <div class="row">      
                                    <div class="col-md-12">
                                      <form class="form-material" method="GET" action="Descargas.php">
                                         <div class="card">
                                            <div class="card-body">
                                             <h4 class="card-title text-center font-weight-bold">Reportes Mantenimiento Preventivo:</h4>
                                                <h5 class="card-subtitle  text-right"><span class="text-success font-weight-bold">' . $coincidencias["numero"] . ' coincidencias</span>
                                                    <a onclick="SelectAll(this)" class="btn-sm btn-info btn-rounded text-white ml-3 mr-2"><i class="fa  fa-paper-plane-o"></i> All</a> <button type="submit" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</button></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="">
                                                                <th class="font-weight-bold text-center">MP</th>
                                                                <th class="font-weight-bold text-center">Inspector</th>
                                                                <th class="font-weight-bold text-center">No. Maquina</th>
                                                                <th class="font-weight-bold text-center">Maquina</th>
                                                                <th class="font-weight-bold text-center">Fecha</th>
                                                                <th class="font-weight-bold text-center">Documento</th>
                                                                <th class="font-weight-bold text-center">Descargar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        foreach ($registros as $r) {

            $nombreInspector = $this->modelo->buscarUserMtto_Pre($r["ID_Mtto"]);
            $infoMaquina = $this->modelo->buscarMaquinariaID($r["ID_Maquina"]);
            $acu = $acu . '   
                            <tr>
                                                    <td class="font-weight-bold text-center ">' . $r["ID_Mtto"] . '</td>
                                                    <td class="font-medium text-center">' . $nombreInspector["Usuario"] . '</td>
                                                    <td class="font-medium text-center">' . $r["ID_Maquina"] . '</td>
                                                     <td class="font-medium text-center">' . $infoMaquina["Maquina"] . '</td>
                                                    <td class="font-medium text-center">' . $this->fechaMx($r["fecha"]) . '</td>
                                                    <td class="font-medium text-center">
                                                      <span class="label label-danger"><i class="font-medium fa fa-file-pdf-o"></i> .pdf</span>
                                                    </td>
                                                    <td class="form-check text-center">
                                                            <input class="form-check-input" type="checkbox" name="check[]" value="' . $r["ID_Mtto"] . '" id="check' . $r["ID_Mtto"] . '">
                                                            <label class="form-check-label" for="check' . $r["ID_Mtto"] . '"></label>
                                                    </td> 
                                                </tr>';
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>';
        return $acu;
    }

    public function mostrarRefaccionesMec() {
        $registros = $this->modelo->MostrarRefacciones();
        $Numerocoincidencias = $this->modelo->numRefacciones();
        $acu = '                   
                    <div class="row">      
                        <div class="col-md-12">
                                         <div class="card">
                                            <div class="card-body">
                                             <h4 class="card-title text-center">Concentrado de Refacciones</h4>
                                              <h5 class="card-subtitle  text-lg-right"><span class="text-info font-weight-bold">' . $Numerocoincidencias["Num"] . ' Coincidencias Encontradas</span> <a href="../excel/reporteRefacciones.php" class="btn-sm btn-primary btn-rounded text-white ml-3 mr-2"><i class="fa fa-cloud-download"></i> Importar</a></h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Orden</th>
                                                                <th class="text-center">Estante</th>
                                                                <th class="text-center">Refaccion</th>
                                                                 <th class="text-center">Stock</th>
                                                                <th class="text-center">Clave</th>
                                                                <th class="text-center">Maquina</th>
                                                                <th>Modificar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   
                            <tr>
                                                    <td>' . $r["ID_Refaccion"] . '</td>
                                                    <td class="font-weight-bold text-center">' . $r["estante"] . '</td>
                                                    <td class="text-center">' . $r["descripcion"] . '</td>
                                                    <td class="text-center">
                                                       <button type="button" class="font-weight-bold ' . $this->verificarStock($r["stock"]) . ' btn-sm" >' . $r["stock"] . '</button>
                                                    </td>
                                                    <td class="text-center">' . $r["clave"] . '</td>    
                                                    <td class="text-center">' . $r["maquina"] . '</td>   
                                                    <td>
                                                       <a href="ConsultarMaquinaria.php?ID=' . $r["ID_Refaccion"] . '"><input type="button" class="btn-sm btn-info" value="Modificar"></a>
                                                    </td> 
                            </tr>                      
                                                 
                                               
';
        }
        $acu = $acu . ' </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';

        return $acu;
    }

    public function verificarStock($cantidad) {
        if ($cantidad > 0) {
            return 'btn-success';
        } else {
            return 'btn-danger';
        }
    }

    public function deshabilitarBoton($cantidad) {
        if ($cantidad < 1) {
            return 'disabled';
        }
    }

    public function siAutentificado() {
        if (isset($_SESSION["usuario"])) {
            return true;
        } else {
            return false;
        }
    }

    public function comprobarDepartamento($Departamento) {
        if ($_SESSION["usuario"]["Departamento"] == $Departamento) {
            return true;
        } else {
            return false;
        }
    }

    public function validarPaginaInicio() {
        $Departamento = $_SESSION["usuario"]["Departamento"];
        $PageMain = $this->modelo->paginaInicio($Departamento);
        return $PageMain["pageMain"];
    }

    public function mostrarColaboradores() {
        $registros = $this->modelo->tablaEmpleados();
        $acu = '  <div class="col-12">
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nombre del Colaborador</th>
                                                    <th>Nivel</th>
                                                    <th>Importe</th>
                                                    <th>Change</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '
                                                <tr>
                                                    <td><span class="">' . $r["ID"] . '</span></td>
                                                    <td>' . $r["Nombre"] . '</td>
                                                    <td><span class="">' . $r["Nivel"] . '</span> </td>
                                                    <td>' . $this->darFormatoMoneda($r["Importe"]) . '</td>
                                                    <td>
                                                        <button class="btn-sm btn-table btn-success"  onclick="cambiaDefecto(' . $r["ID"] . ')"><i class="fa fa-spin fa-refresh"></i> View</button>
                                                   
                                                    </td>
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function redireccionar($url) {
        header("Location: " . $url);
    }

    public function vistaPrevia($url) {
        echo "<script>window.open('" . $url . "', '_blank');</script>";
    }

    public function verificarUrl($URL) {

        $registro = $this->modelo->buscarURL($_SESSION["usuario"]["ID"], $URL);
        foreach ($registro as $r) {
            return $r["nombre"];
        }
    }

    public function acortarTexto($texto, $tamano) {
        if (strlen($texto) > $tamano) {
            return substr($texto, 0, $tamano) . '...';
        } else {
            return $texto;
        }
    }

    public function estadoRefac($id) {
        if ($id == 1) {
            return 'Activo';
        } else {
            return 'Obsoleto';
        }
    }

    public function buscarRefaccion($ID) {
        $r = $this->modelo->buscarRefaccion($ID);
        if ($r["ID_Refaccion"] <> "") {
            return ' <div class="row">
                        <div class="col-12">
                            <div class="col-lg-12" id="MaquinaID">
                                <div class="row el-element-overlay">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="card">
                                            <form action="ModificarRef.php" method="POST">
                                                <div class="row mt-2">
                                                    <div class="col-lg-7 form-material m-l-20"> <span class="lstick"></span><input type="text" value="' . $r["estante"] . '" class="form-control form-control-line font-weight-bold font-18" name="estante" id="estante"></div>
                                                    <div class="align-content-end col-lg-4"><input type="text" value="' . $r["clave"] . '" class="bg-dark text-white form-control text-right" name="clave" id="clave"></div>
                                                </div>
                                                <div class="el-card-item m-t-20">
                                                    <div class="el-card-content">
                                                        <textarea cols="25" rows="3" class="form-control text-center font-medium" name="descripcion" id="descripcion">' . $r["descripcion"] . '</textarea>
                                                        <div class="col-12 form-material">
                                                            <div class="row mt-3 ">
                                                                <div class="col-3 font-weight-bold p-r-0 p-l-20 text-left">Maquina:</div>
                                                                <div class="col-9" class=""><input type="text"  value="' . $r["maquina"] . '" class="form-control form-control-line text-center" name="maquina" id="maquina"></div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-3 font-weight-bold p-r-0 p-l-20 text-left">Marca:</div>
                                                                <div class="col-9" class=""><input type="text"  value="' . $r["marca"] . '" class="form-control form-control-line text-center" name="marca" id="marca"></div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-3 font-weight-bold p-r-0  p-l-20 text-left">Modelo:</div>
                                                                <div class="col-9" class=""><input type="text"  value="' . $r["modelo"] . '" class=" form-control form-control-line text-center" name="modelo" id="modelo"></div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <table class="table">
                                                                    <tr>
                                                                        <th>Verde</th>
                                                                        <th>Amarillo</th>
                                                                        <th>Rojo</th>
                                                                    </tr>
                                                                    <tr class="font-weight-bold">
                                                                        <td class="text-white bg-success">' . $r["status_ok"] . '</td>
                                                                        <td class="text-white bg-warning">' . $r["status_regular"] . '</td>
                                                                        <td class="text-white bg-danger">' . $r["status_malo"] . '</td>
                                                                    </tr>
                                                                </table>
                                                                <input type="text" value="' . $r["status_ok"] . '" name="status_ok" class="hide">
                                                                <input type="text" value="' . $r["status_regular"] . '" name="status_regular"class="hide">
                                                                <input type="text" value="' . $r["status_malo"] . '" name="status_malo" class="hide">
                                                                <input type="text" value="' . $r["stock"] . '" name="stock" class="hide">
                                                                 <input type="text" value="' . $r["ID_Refaccion"] . '" name="ID_Refaccion" class="hide">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-lg-3 mt-2">
                                                                    <span class="font-weight-bold h6">Stock: </span><button class="btn-sm btn-success mt-2" type="button"  ><span class="h5">' . $r["stock"] . '</span></button>
                                                                </div>
                                                                <div class="col-md-5 mt-2">
                                                                    <select class="form-control custom-select btn-light" id="ID_Estado" name="ID_Estado">
                                                                      <option class="text-center" value="' . $r["ID_Estado"] . '">' . $this->estadoRefac($r["ID_Estado"]) . '</option>
                                                                        <option class="text-center" value="1">Activo</option>
                                                                        <option class="text-center" value="2">Obsoleto</option>
                                                                    </select>
                                                                    <small class="form-control-feedback text-danger font-medium">Estado.</small>
                                                                </div>
                                                                <div class="col-lg-4 mt-3">
                                                                    <div class="form-actions">
                                                                        <button type="submit" class="btn btn-info btn-rounded" id="guardar"><i class="fa fa-check"></i> Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-l-0" style="">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><span class="lstick"></span>Historial de Entradas:</h5>
                                            </div>
                                            <div class="m-l-20 m-r-20">
                                                ' . $this->MostrarEntradasRefacciones($r["ID_Refaccion"]) . '
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 p-l-0">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><span class="lstick"></span>Historial de Salidas:</h5>
                                            </div>
                                            <div class="m-l-20 m-r-20">
                                               ' . $this->MostrarSalidasRefacciones($r["ID_Refaccion"]) . '
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-l-0 hide">
                                        <button class="btn btn-dark btn-rounded m-t-40"><a href="javascript:window.history.back();" class="text-white font-medium"><i class="fa fa-spin fa-spinner"></i> Back</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {
            return ' <div id="contenedor_spinner">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>No se encontraron coincidencias con sus criterios de búsqueda..</H4></div>
                         </div>
                        ';
        }
    }

    public function salir() {
        if (isset($_GET["salir"])) {
            session_destroy();
            $this->redireccionar("Login.php");
        }
    }

    /* public function modificarPersona() {
      if (isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["ID_Supervisor"])) {
      if ($_POST["Departamento"] <> "" && $_POST["Seccion"] <> "") {
      if ($this->modelo->modificarPersona($_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["ID_Supervisor"])) {
      echo $this->mensaje("Producto Agregado con Exito!!");
      $this->redireccionar("panel.php");
      } else {
      echo $this->mensaje("Error en la bd");
      }
      } else {
      echo $this->mensaje("No entra");
      }
      }
      } */

    public function modificarPersona2() {
        if (isset($_POST["ID_Usuario"]) && isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Operacion"]) && isset($_POST["ID_Supervisor"])) {
            if ($_POST["ID_Usuario"] <> "" && $_POST["ID"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Operacion"] <> "" && $_POST["ID_Supervisor"] <> "") {
                if ($this->modelo->modificarPersona2($_POST["ID_Usuario"], $_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Operacion"], $_POST["ID_Supervisor"])) {
                    echo $this->mensaje("Producto Agregado con Exito!!");
//                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function modificarPersonaAdmin() {
        if (isset($_POST["ID_Usuario"]) && isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Operacion"]) && isset($_POST["ID_Supervisor"])) {
            if ($_POST["ID_Usuario"] <> "" && $_POST["ID"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Operacion"] <> "" && $_POST["ID_Supervisor"] <> "") {
                if ($this->modelo->modificarPersonaAdmin($_POST["ID_Usuario"], $_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Operacion"], $_POST["ID_Supervisor"])) {
                    echo $this->mensaje("Producto Agregado con Exito!!");
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function modificarPersonaSupervisor() {
        if (isset($_POST["PasswordSup1"]) && isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Operacion"]) && isset($_POST["Dias"]) && isset($_POST["PasswordSup2"])) {
            if ($_POST["PasswordSup1"] <> "" && $_POST["ID"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Operacion"] <> "" && $_POST["Dias"] <> "" && $_POST["PasswordSup2"] <> "") {
                if ($this->modelo->modificarPersonaSupervisor($_POST["PasswordSup1"], $_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Operacion"], $_POST["Dias"], $_POST["PasswordSup2"])) {
                    echo $this->mensaje("Producto Agregado con Exito!!");
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function modificarPersonaInge() {
        if (isset($_POST["PasswordUsuario"]) && isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Operacion"]) && $_POST["Dias"] <> "" && isset($_POST["ID_Supervisor"])) {
            if ($_POST["PasswordUsuario"] <> "" && $_POST["ID"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Operacion"] <> "" && $_POST["ID_Supervisor"] <> "") {
                if ($this->modelo->modificarPersonaInge($_POST["PasswordUsuario"], $_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Operacion"], $_POST["Dias"], $_POST["ID_Supervisor"])) {
                    echo $this->mensaje('Producto Agregado con Exito!');
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        } elseif (isset($_POST["PasswordUsuario"]) && isset($_POST["ID"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Operacion"]) && isset($_POST["Horas"]) && isset($_POST["ID_Supervisor"])) {
            if ($_POST["PasswordUsuario"] <> "" && $_POST["ID"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Operacion"] <> "" && $_POST["Horas"] <> "" && $_POST["ID_Supervisor"] <> "") {
                if ($this->modelo->modificarPersonaIngeHoras($_POST["PasswordUsuario"], $_POST["ID"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Operacion"], $_POST["Horas"], $_POST["ID_Supervisor"])) {
                    echo $this->mensaje('Producto Agregado con Exito!');
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function aplazarTiempoInge() {
        if (isset($_POST["PasswordUsuario"]) && isset($_POST["ID"]) && $_POST["Dias"] <> "") {
            if ($_POST["PasswordUsuario"] <> "" && $_POST["ID"] <> "") {
                if ($this->modelo->aplazarTiempoInge($_POST["PasswordUsuario"], $_POST["ID"], $_POST["Dias"])) {
                    echo $this->mensaje("Se aplazo con Exito! ");
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        } elseif (isset($_POST["PasswordUsuario"]) && isset($_POST["ID"]) && isset($_POST["Horas"])) {
            if ($_POST["PasswordUsuario"] <> "" && $_POST["ID"] <> "" && $_POST["Horas"] <> "") {
                if ($this->modelo->aplazarHorasInge($_POST["PasswordUsuario"], $_POST["ID"], $_POST["Horas"])) {
                    echo $this->mensaje("Se aplazo con Exito! ");
                    $this->redireccionar("panel.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function IngresarPedidoTaxi() {
        if (isset($_POST["newPlaca"]) && isset($_POST["newTaxi"]) && isset($_POST["newNombreConductor"]) && isset($_POST["newPasajero"]) && isset($_POST["newDestino"]) && isset($_POST["newHora"]) && isset($_POST["newDia"]) && isset($_POST["newMes"]) && isset($_POST["newAno"]) && isset($_POST["Password"])) {
            if ($_POST["newPlaca"] <> "" && $_POST["newTaxi"] <> "" && $_POST["newPasajero"] <> "" && $_POST["newDestino"] <> "" && $_POST["newHora"] <> "" && $_POST["newDia"] <> "" && $_POST["newMes"] <> "" && $_POST["newAno"] <> "" && $_POST["Password"] <> "") {
                $fecha = $_POST["newDia"] . "/" . $_POST["newMes"] . "/" . $_POST["newAno"] . " " . $_POST["newHora"];
                if ($this->modelo->IngresarPedidoTaxi($_POST["newPlaca"], $_POST["newTaxi"], "", $fecha, $_POST["newPasajero"], $_POST["newDestino"], $_POST["Password"])) {
                    $this->redireccionar("panel.php");
                    echo $this->mensaje("Success!!");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("Debes completar todos los campos");
            }
        }
    }

    public function IngresarPedidoTaxi1() {
        if (isset($_POST["newPlaca"]) && isset($_POST["newTaxi"]) && isset($_POST["newNombreConductor"]) && isset($_POST["newPasajero1"]) && isset($_POST["newDestino1"]) && isset($_POST["newPasajero2"]) && isset($_POST["newDestino2"]) && isset($_POST["newPasajero3"]) && isset($_POST["newDestino3"]) && isset($_POST["newPasajero4"]) && isset($_POST["newDestino4"]) && isset($_POST["newPasajero5"]) && isset($_POST["newDestino5"]) && isset($_POST["newHora"]) && isset($_POST["newDia"]) && isset($_POST["newMes"]) && isset($_POST["newAno"]) && isset($_POST["Password"])) {
            if ($_POST["newPlaca"] <> "" && $_POST["newTaxi"] <> "" && $_POST["newPasajero1"] <> "" && $_POST["newDestino1"] <> "" && $_POST["newHora"] <> "" && $_POST["newDia"] <> "" && $_POST["newMes"] <> "" && $_POST["newAno"] <> "" && $_POST["Password"] <> "") {
                $fecha = $_POST["newAno"] . "-" . $_POST["newMes"] . "-" . $_POST["newDia"] . " " . $_POST["newHora"];
                if ($this->modelo->IngresarPedidoTaxi1($_POST["newPlaca"], $_POST["newTaxi"], $_POST["newNombreConductor"], $fecha, $_POST["newPasajero1"], $_POST["newDestino1"], $_POST["newPasajero2"], $_POST["newDestino2"], $_POST["newPasajero3"], $_POST["newDestino3"], $_POST["newPasajero4"], $_POST["newDestino4"], $_POST["newPasajero5"], $_POST["newDestino5"], $_POST["Password"])) {
                    $this->redireccionar("panel.php");
                    echo $this->mensaje("Success!!");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("Debes completar todos los campos");
            }
        }
    }

    public function RetornarEmpleado() {
        if (isset($_POST["PasswordUsuario"]) && isset($_POST["ID"])) {
            if ($_POST["PasswordUsuario"] <> "" && $_POST["ID"] <> "") {
                if ($this->modelo->retornarEmpleado($_POST["PasswordUsuario"], $_POST["ID"])) {
                    $this->redireccionar("panel.php");
                    echo $this->mensaje("Success!!");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function actualizarPersona() {
        if (isset($_POST["ID"]) && isset($_POST["Nombre"]) && isset($_POST["Nivel"]) && isset($_POST["SueldoBase"]) && isset($_POST["SueldoTarea"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Puesto"]) && isset($_POST["Sexo"]) && isset($_POST["Operacion"]) && isset($_POST["ID_Supervisor"])) {
            if ($_POST["Nombre"] <> "" && $_POST["Nivel"] <> "" && $_POST["SueldoBase"] <> "" && $_POST["SueldoTarea"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Puesto"] <> "" && $_POST["Sexo"] <> "" && $_POST["Operacion"] <> "" && $_POST["ID_Supervisor"] <> "") {
                if ($this->modelo->actualizarEmpleado($_POST["ID"], $_POST["Nombre"], $_POST["Nivel"], $_POST["SueldoBase"], $_POST["SueldoTarea"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Puesto"], $_POST["Operacion"], $_POST["Sexo"], $_POST["ID_Supervisor"])) {
                    echo $this->mensaje("Producto Agregado con Exito!!");
                    $this->redireccionar("Plantilla.php");
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function agregarMaquinaria() {
        if (isset($_POST["NumeroActivo"]) && isset($_POST["Maquina"]) && isset($_POST["Marca"]) && isset($_POST["Modelo"]) && isset($_POST["Serie"]) && isset($_POST["Ubicacion"]) && isset($_POST["Estado"]) && isset($_POST["Comentario"]) && isset($_POST["Propietario"])) {
            if ($_POST["NumeroActivo"] <> "" && $_POST["Maquina"] <> "" && $_POST["Marca"] <> "" && $_POST["Modelo"] <> "" && $_POST["Serie"] <> "" && $_POST["Ubicacion"] <> "" && $_POST["Estado"] <> "" && $_POST["Propietario"] <> "") {
                if ($_FILES["Foto"] <> "") {
                    if ($this->modelo->agregarMaquinaria($_POST["NumeroActivo"], $_POST["Maquina"], $_POST["Marca"], $_POST["Modelo"], $_POST["Serie"], $_POST["Ubicacion"], $_POST["Estado"], $_POST["Comentario"], $_POST["Propietario"])) {
                        $nombre = substr($_POST["NumeroActivo"], 4);
                        copy($_FILES["Foto"]["tmp_name"], "imagenesMaquinaria/$nombre.jpg");
                        $this->redireccionar("Maquinaria.php");
                    } else {
                        echo $this->mensaje("Error en la bd");
                    }
                } else {
                    if ($this->modelo->agregarMaquinaria($_POST["NumeroActivo"], $_POST["Maquina"], $_POST["Marca"], $_POST["Modelo"], $_POST["Serie"], $_POST["Ubicacion"], $_POST["Estado"], $_POST["Comentario"], $_POST["Propietario"])) {
                        $this->redireccionar("Maquinaria.php");
                    } else {
                        echo $this->mensaje("Error en la bd");
                    }
                }
            }
//            else {
//                echo $this->mensaje("No entra");
//            }
        }
    }

    public function ultimoEmpleado() {
        $ultimo = $this->modelo->UltimoEmpleado();
        $acu = '';
        foreach ($ultimo as $empleado) {
            return $empleado["ID"];
        }
    }

    public function numEmpleadosUltimaSemana() {
        $ultimo = $this->modelo->numEmpleadosUltimaSemana();
        return number_format($ultimo["numero"]);
    }

    public function numMaquinas() {
        $ultimo = $this->modelo->numMaquina();
        return number_format($ultimo["numero"]);
    }

    public function numRefacciones() {
        $ultimo = $this->modelo->numRefacciones();
        return number_format($ultimo["Num"]);
    }

    public function actualizarMaquinaria() {
        if (isset($_POST["ID"]) && isset($_POST["Maquina"]) && isset($_POST["Marca"]) && isset($_POST["Modelo"]) && isset($_POST["Serie"]) && isset($_POST["Ubicacion"]) && isset($_POST["Estado"]) && isset($_POST["Comentario"]) && isset($_POST["Propietario"])) {
            if ($_POST["ID"] <> "" && $_POST["Maquina"] <> "" && $_POST["Marca"] <> "" && $_POST["Modelo"] <> "" && $_POST["Serie"] <> "" && $_POST["Ubicacion"] <> "" && $_POST["Estado"] <> "" && $_POST["Propietario"] <> "") {
                if ($this->modelo->actualizarMaquinaria($_POST["NumeroActivo"], $_POST["Maquina"], $_POST["Marca"], $_POST["Modelo"], $_POST["Serie"], $_POST["Ubicacion"], $_POST["Estado"], $_POST["Comentario"], $_POST["Propietario"], $_POST["ID"])) {

                    $this->redireccionar('ConsultarMaquinaria.php?ID=' . $_POST["NumeroActivo"] . '&Success=YES');
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function registrarUsuaurio() {
        if (isset($_POST["User"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Password"]) && isset($_POST["Privilegios"])) {
            if ($_POST["User"] <> '' && $_POST["Departamento"] <> '' && $_POST["Seccion"] <> '' && $_POST["Password"] <> '' && $_POST["Privilegios"] <> '') {
                if ($this->modelo->registrarUsuario($_POST["User"], $_POST["Departamento"], $_POST["Seccion"], md5($_POST["Password"]), $_POST["Privilegios"])) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            }
        }
    }

    public function registrarModulo() {
        if (isset($_POST["modulo"]) && isset($_POST["icon"])) {
            if ($_POST["modulo"] <> '' && $_POST["icon"]) {
                if ($this->modelo->registrarModulo($_POST["modulo"], $_POST["icon"])) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            }
        }
    }

    public function registrarInterfaz() {
        if (isset($_POST["interfaz"]) && isset($_POST["url"]) && isset($_POST["ID_Modulo"])) {
            if ($_POST["interfaz"] <> '' && $_POST["url"] <> '' && $_POST["ID_Modulo"] <> '') {
                if ($this->modelo->registrarInterfaz($_POST["interfaz"], $_POST["url"], $_POST["ID_Modulo"])) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            }
        }
    }

    public function registrarPerfil() {
        if (isset($_POST["perfil"])) {
            if ($_POST["perfil"] <> '') {
                if ($this->modelo->registrarPerfil($_POST["perfil"])) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            }
        }
    }

    public function registrarPerfil_Interfaz() {
        if (isset($_POST["ID_Perfil"])) {
            if ($_POST["ID_Perfil"] <> '') {
                //Depurar 
                $this->modelo->elimiterAll_Perfil_Interfaz($_POST["ID_Perfil"]);

                $arreglo = $_POST["ID_Interfaz"];
                $num = count($arreglo);
                $cont = 0;
                for ($index = 0; $index < $num; $index++) {
                    if ($this->modelo->registrarPerfil_Interfaz($_POST["ID_Perfil"], $arreglo[$index])) {
                        $cont++;
                    }
                }
                if (($num + 1) === $cont) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            }
        }
    }

    public function registrarPerfil_Usuario() {
        if (isset($_POST["ID_Perfil"]) && isset($_POST["ID_Usuario"])) {
            if ($_POST["ID_Perfil"] <> '' && $_POST["ID_Usuario"] <> '') {
                if ($this->modelo->registrarPerfil_Usuario($_POST["ID_Perfil"], $_POST["ID_Usuario"])) {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
                }
            } else {
                $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
            }
        } else {
            $this->redireccionar('ControlPerfiles.php?status=' . md5('bad'));
        }
    }

    public function registrarModulo_ChecklistMP() {
        if (isset($_POST["modulo"]) && isset($_POST["descripcion"])) {
            if ($_POST["modulo"] <> '') {
                if ($this->modelo->registrarModulo_ChecklistMP($_POST["modulo"], $_POST["descripcion"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            } else {
                $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
            }
        } else {
            $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
        }
    }

    public function actualizarModulo_ChecklistMP() {
        if (isset($_POST["ID_Modulo"]) && isset($_POST["modulo"]) && isset($_POST["descripcion"])) {
            if ($_POST["ID_Modulo"] <> '' && $_POST["modulo"] <> '') {
                if ($this->modelo->actualizarModulo_ChecklistMP($_POST["ID_Modulo"], $_POST["modulo"], $_POST["descripcion"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            } else {
                $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
            }
        } else {
            $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
        }
    }
    
    
     public function eliminarModulo_ChecklistMP() {
        if (isset($_POST["ID_Modulo"])) {
            if ($_POST["ID_Modulo"] <> '') {
                if ($this->modelo->eliminarModulo_ChecklistMP($_POST["ID_Modulo"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            } else {
                $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
            }
        } else {
            $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
        }
    }

    public function registrarActividadModulo_ChecklistMP() {
        if (isset($_POST["ID_Modulo"]) && isset($_POST["actividad"])) {
            if ($_POST["ID_Modulo"] <> '' && $_POST["actividad"] <> '') {
                if ($this->modelo->registrarActividadModulo_ChecklistMP($_POST["ID_Modulo"], $_POST["actividad"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            } else {
                $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
            }
        } else {
            $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
        }
    }

    public function actualizarActividadModulo_ChecklistMP() {
        if (isset($_POST["ID_Actividad"]) && isset($_POST["actividad"])) {
            if ($_POST["ID_Actividad"] <> '' && $_POST["actividad"] <> '') {
                if ($this->modelo->actualizarActividadModulo_ChecklistMP($_POST["ID_Actividad"], $_POST["actividad"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            }
        }
    }
    
    public function eliminarActividadModulo_ChecklistMP() {
        if (isset($_POST["ID_Actividad"])) {
            if ($_POST["ID_Actividad"] <> '') {
                if ($this->modelo->eliminarActividadModulo_ChecklistMP($_POST["ID_Actividad"])) {
                    $this->redireccionar('EditChecklist.php?status=' . md5('success'));
                } else {
                    $this->redireccionar('EditChecklist.php?status=' . md5('bad'));
                }
            }
        }
    }
    

    public function registrarSalida() {
        if (isset($_POST["ID_Refaccion"]) && isset($_POST["cantidad"]) && isset($_POST["unidad_medida"]) && isset($_POST["linea"]) && isset($_POST["area"]) && isset($_POST["nombre"]) && isset($_POST["folio_salida"]) && isset($_POST["numeroMaquina"]) && isset($_POST["total"])) {
            if ($_POST["ID_Refaccion"] <> " " && $_POST["cantidad"] <> " " && $_POST["unidad_medida"] <> "" && $_POST["linea"] <> "" && $_POST["area"] <> "" && $_POST["nombre"] <> "") {
                if ($this->modelo->registrarSalida($_POST["ID_Refaccion"], $_POST["cantidad"], $_POST["unidad_medida"], $_POST["linea"], $_POST["area"], $_POST["nombre"], $_POST["folio_salida"], $_POST["numeroMaquina"], 0.00, $_POST["total"])) {
                    $this->redireccionar('SalidasRef.php?Success=YES');
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function registrarEntrada() {
        if (isset($_POST["ID_Refaccion"]) && isset($_POST["cantidad"]) && isset($_POST["unidad_medida"]) && isset($_POST["factura"]) && isset($_POST["orden_compra"]) && isset($_POST["proveedor"]) && isset($_POST["precio_unitario"]) && isset($_POST["subtotal"]) && isset($_POST["IVA"]) && isset($_POST["total"]) && isset($_POST["estado"])) {
            if ($_POST["ID_Refaccion"] <> " " && $_POST["cantidad"] <> " " && $_POST["unidad_medida"] <> "" && $_POST["proveedor"] <> "" && $_POST["estado"] <> "") {
                if ($this->modelo->registrarEntrada($_POST["ID_Refaccion"], $_POST["cantidad"], $_POST["unidad_medida"], $_POST["factura"], $_POST["orden_compra"], $_POST["proveedor"], $_POST["precio_unitario"], $_POST["subtotal"], $_POST["IVA"], $_POST["total"], $_POST["estado"])) {
                    $this->redireccionar('EntradasRef.php?Success=YES');
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function actualizarRefaccion() {
        if (isset($_POST["ID_Refaccion"]) && isset($_POST["estante"]) && isset($_POST["clave"]) && isset($_POST["descripcion"]) && isset($_POST["maquina"]) && isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["status_ok"]) && isset($_POST["status_regular"]) && isset($_POST["status_malo"]) && isset($_POST["stock"])) {
            if ($_POST["ID_Refaccion"] <> " " && $_POST["clave"] <> " " && $_POST["descripcion"] <> "" && $_POST["estante"] <> "" && $_POST["ID_Estado"] <> "") {
                if ($this->modelo->actualizarRefaccion($_POST["ID_Refaccion"], $_POST["estante"], $_POST["clave"], $_POST["descripcion"], $_POST["maquina"], $_POST["marca"], $_POST["modelo"], $_POST["status_ok"], $_POST["status_regular"], $_POST["status_malo"], $_POST["stock"], $_POST["ID_Estado"])) {
                    $this->redireccionar('ModificarRef.php?Success=YES');
                } else {
                    echo $this->mensaje("Error en la bd");
                }
            } else {
                echo $this->mensaje("No entra");
            }
        }
    }

    public function agregarPersonaReclutamiento() {
        if (isset($_POST["Nombre"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Puesto"]) && isset($_POST["Operacion"]) && isset($_POST["CURP"])) {
            if (isset($_POST["SueldoBase"])) {
                if ($this->modelo->ingresarNuevoEmpleado($_POST["Nombre"], $_POST["Nivel"], $_POST["SueldoBase"], $_POST["SueldoTarea"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Puesto"], $_POST["Operacion"], $_POST["CURP"], $_POST["Telefono"], $_POST["TelefonoEmergencia"], $_POST["ID_Supervisor"])) {
                    
                }
            } else {
                if ($_POST["Nombre"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Puesto"] <> "" && $_POST["Operacion"] <> "" && $_POST["CURP"] <> "") {
                    if ($_FILES["Foto"] <> "") {
                        $numeroEmpleado = $_POST["numeroEmpleado"];
                        copy($_FILES["Foto"]["tmp_name"], "imagenesEmpleados/$numeroEmpleado.jpg");
                        if ($this->modelo->ingresarNuevoEmpleado($_POST["Nombre"], '', '', '', $_POST["Departamento"], $_POST["Seccion"], $_POST["Puesto"], $_POST["Operacion"], $_POST["CURP"], $_POST["Telefono"], $_POST["TelefonoEmergencia"], '')) {
                            
                        }
                    }
                } else {
                    echo $this->mensaje("Completa todo los Campos");
                }
            }
        }
    }

    public function agregarPersonaAdmin() {
        if (isset($_POST["Nombre"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Puesto"]) && isset($_POST["Operacion"]) && isset($_POST["CURP"]) && isset($_POST["Telefono"]) && isset($_POST["TelefonoEmergencia"]) && isset($_POST["SueldoBase"]) && isset($_POST["SueldoTarea"]) & isset($_POST["ID_Supervisor"])) {
            if ($_POST["Nombre"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Puesto"] <> "" && $_POST["Operacion"] <> "" && $_POST["CURP"] <> "") {
                if ($this->modelo->ingresarNuevoEmpleado($_POST["Nombre"], $_POST["Nivel"], $_POST["SueldoBase"], $_POST["SueldoTarea"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Puesto"], $_POST["Operacion"], $_POST["CURP"], $_POST["Telefono"], $_POST["TelefonoEmergencia"], $_POST["ID_Supervisor"])) {
                    
                }
            } else {
                echo $this->mensaje("Completa todo los Campos");
            }
        }
    }

//    public function agregarPersona() {
//        if (isset($_POST["Nombre"]) && isset($_POST["Nivel"]) && isset($_POST["SueldoBase"]) && isset($_POST["SueldoTarea"]) && isset($_POST["Departamento"]) && isset($_POST["Seccion"]) && isset($_POST["Puesto"]) && isset($_POST["Sexo"]) && isset($_POST["Operacion"]) && isset($_POST["ID_Supervisor"])) {
//            if ($_POST["Nombre"] <> "" && $_POST["Nivel"] <> "" && $_POST["SueldoBase"] <> "" && $_POST["SueldoTarea"] <> "" && $_POST["Departamento"] <> "" && $_POST["Seccion"] <> "" && $_POST["Puesto"] <> "" && $_POST["Sexo"] <> "" && $_POST["Operacion"] <> "" && $_POST["ID_Supervisor"] <> "") {
//                if ($this->modelo->ingresarNuevoEmpleado($_POST["Nombre"], $_POST["Nivel"], $_POST["SueldoBase"], $_POST["SueldoTarea"], $_POST["Departamento"], $_POST["Seccion"], $_POST["Puesto"], $_POST["Operacion"], $_POST["Sexo"], $_POST["ID_Supervisor"])) {
//                    echo $this->mensaje("Producto Agregado con Exito!!");
//                    $this->redireccionar("panel.php");
//                }
//            } else {
//                echo $this->mensaje("Completa todo los Campos");
//            }
//        }
//    }
//    public function ingresarCorte() {
//        if (isset($_POST["corte"]) && isset($_POST["descripcion"]) && isset($_POST["cantidad"]) && isset($_POST["departamento"])) {
//            if ($_POST["corte"] <> "" && $_POST["descripcion"] <> "" && $_POST["cantidad"] <> 0 && $_POST["departamento"] <> "") {
//                if ($this->modelo->ingresarCorte($_POST["corte"],$_POST["departamento"],$_POST["descripcion"], $_POST["cantidad"], $_POST["password"])) {
//                    echo $this->mensaje("Producto Agregado con Exito!!");
//                }
//            } else {
//                echo $this->mensaje("Completa todo los Campos");
//            }
//        } else {
//            echo $this->mensaje("no existen las variables");
//            
//        }
//    }


    public function ingresarCorte() {
        if (isset($_POST["corte"]) && isset($_POST["departamento"]) && isset($_POST["descripcion"]) && isset($_POST["cantidad"]) && isset($_POST["semana"]) && isset($_POST["password"])) {
            if ($_POST["corte"] <> "" && $_POST["departamento"] <> "" && $_POST["descripcion"] <> "" && $_POST["cantidad"] <> "" && $_POST["semana"] <> "" && $_POST["password"] <> "") {
//                if ($this->modelo->ingresarCorte($_POST["corte"], $_POST["departamento"], $_POST["descripcion"], $_POST["cantidad"], $_POST["password"])) {
                if ($this->modelo->ingresarCorte($_POST["corte"], $_POST["departamento"], $_POST["descripcion"], $_POST["cantidad"], $_POST["semana"], $_POST["password"])) {
                    
                }
//                echo $this->mensaje("Todos los campos estan bien");
            }
//          echo  $this->mensaje("entro");
        }
    }

    public function actualizarCorte() {
        if (isset($_POST["newTela"]) && isset($_POST["newComentarioTela"]) && isset($_POST["newTelaStatus"]) && isset($_POST["newMolde"]) && isset($_POST["newComentarioMolde"]) && isset($_POST["newMoldeStatus"]) && isset($_POST["newTrazo"]) && isset($_POST["newComentarioTrazo"]) && isset($_POST["newTrazoStatus"]) && isset($_POST["newCantidadReal"]) && isset($_POST["newCantidadRealStatus"]) && isset($_POST["newMesaCorte"]) && isset($_POST["newComentarioMesaCorte"]) && isset($_POST["newMesaCorteStatus"]) && isset($_POST["newFoleo"]) && isset($_POST["newComentarioFoleo"]) && isset($_POST["newFoleoStatus"]) && isset($_POST["newPock"]) && isset($_POST["newComentarioPock"]) && isset($_POST["newPockStatus"]) && isset($_POST["newFusion"]) && isset($_POST["newComentarioFusion"]) && isset($_POST["newFusionStatus"]) && isset($_POST["newFusionPretina"]) && isset($_POST["newComentarioFusionPretina"]) && isset($_POST["newFusionPretinaStatus"]) && isset($_POST["newPretinaCortada"]) && isset($_POST["newComentarioPretinaCortada"]) && isset($_POST["newPretinaCortadaStatus"]) && isset($_POST["newMuestra"]) && isset($_POST["newComentarioMuestra"]) && isset($_POST["newMuestraStatus"]) && isset($_POST["newSpec"]) && isset($_POST["newComentarioSpec"]) && isset($_POST["newSpecStatus"]) && isset($_POST["newBordado"]) && isset($_POST["newComentarioBordado"]) && isset($_POST["newBordadoStatus"]) && isset($_POST["newAvios"]) && isset($_POST["newComentarioAvios"]) && isset($_POST["newAviosStatus"]) && isset($_POST["newMoldes"]) && isset($_POST["newComentarioMoldes"]) && isset($_POST["newMoldesStatus"]) && isset($_POST["newCorte"]) && isset($_POST["newPassword"])) {

            if ($_POST["newTela"] <> "" && $_POST["newMolde"] <> "" && $_POST["newTrazo"] <> "" && $_POST["newMesaCorte"] <> "" && $_POST["newFoleo"] <> "" && $_POST["newPock"] <> "" &&
                    $_POST["newFusion"] <> "" && $_POST["newFusionPretina"] <> "" && $_POST["newMuestra"] <> "" && $_POST["newSpec"] <> "" && $_POST["newBordado"] <> "" && $_POST["newAvios"] <> "" &&
                    $_POST["newMoldes"] <> "") {

                $Tela = date("d/m/Y", strtotime($_POST["newTela"])) . ' ' . $_POST["newComentarioTela"];
                $Molde = date("d/m/Y", strtotime($_POST["newMolde"])) . ' ' . $_POST["newComentarioMolde"];
                $Trazo = date("d/m/Y", strtotime($_POST["newTrazo"])) . ' ' . $_POST["newComentarioTrazo"];
                $MesaCorte = date("d/m/Y", strtotime($_POST["newMesaCorte"])) . ' ' . $_POST["newComentarioMesaCorte"];
                $Foleo = date("d/m/Y", strtotime($_POST["newFoleo"])) . ' ' . $_POST["newComentarioFoleo"];
                $Pock = date("d/m/Y", strtotime($_POST["newPock"])) . ' ' . $_POST["newComentarioPock"];
                $Fusion = date("d/m/Y", strtotime($_POST["newFusion"])) . ' ' . $_POST["newComentarioFusion"];
                $FusionPretina = date("d/m/Y", strtotime($_POST["newFusionPretina"])) . ' ' . $_POST["newComentarioFusionPretina"];
                $PretinaCortada = date("d/m/Y", strtotime($_POST["newPretinaCortada"])) . ' ' . $_POST["newComentarioPretinaCortada"];
                $Muestra = date("d/m/Y", strtotime($_POST["newMuestra"])) . ' ' . $_POST["newComentarioMuestra"];
                $Spec = date("d/m/Y", strtotime($_POST["newSpec"])) . ' ' . $_POST["newComentarioSpec"];
                $Bordado = date("d/m/Y", strtotime($_POST["newBordado"])) . ' ' . $_POST["newComentarioBordado"];
                $Avios = date("d/m/Y", strtotime($_POST["newAvios"])) . ' ' . $_POST["newComentarioAvios"];
                $Moldes = date("d/m/Y", strtotime($_POST["newMoldes"])) . ' ' . $_POST["newComentarioMoldes"];

                echo $this->mensaje("existen");

                if ($this->modelo->actualizarCorte($_POST["newCorte"], $Tela, $_POST["newTelaStatus"], $Molde, $_POST["newMoldeStatus"], $Trazo, $_POST["newTrazoStatus"], $_POST["newCantidadReal"], $_POST["newCantidadRealStatus"], $MesaCorte, $_POST["newMesaCorteStatus"], $Foleo, $_POST["newFoleoStatus"], $Pock, $_POST["newPockStatus"], $Fusion, $_POST["newFusionStatus"], $FusionPretina, $_POST["newFusionPretinaStatus"], $PretinaCortada, $_POST["newPretinaCortadaStatus"], $Muestra, $_POST["newMuestraStatus"], $Spec, $_POST["newSpecStatus"], $Bordado, $_POST["newBordadoStatus"], $Avios, $_POST["newAviosStatus"], $Moldes, $_POST["newMoldesStatus"], $_POST["newPassword"])) {


                    echo $this->mensaje($Tela);
                } else {
                    echo $this->mensaje("NO ENTRA");
                }
            } else {

                $Tela = $_POST["newTela"] . ' ' . $_POST["newComentarioTela"];
                $Molde = $_POST["newMolde"] . ' ' . $_POST["newComentarioMolde"];
                $Trazo = $_POST["newTrazo"] . ' ' . $_POST["newComentarioTrazo"];
                $MesaCorte = $_POST["newMesaCorte"] . ' ' . $_POST["newComentarioMesaCorte"];
                $Foleo = $_POST["newFoleo"] . ' ' . $_POST["newComentarioFoleo"];
                $Pock = $_POST["newPock"] . ' ' . $_POST["newComentarioPock"];
                $Fusion = $_POST["newFusion"] . ' ' . $_POST["newComentarioFusion"];
                $FusionPretina = $_POST["newFusionPretina"] . ' ' . $_POST["newComentarioFusionPretina"];
                $PretinaCortada = $_POST["newPretinaCortada"] . ' ' . $_POST["newComentarioPretinaCortada"];
                $Muestra = $_POST["newMuestra"] . ' ' . $_POST["newComentarioMuestra"];
                $Spec = $_POST["newSpec"] . ' ' . $_POST["newComentarioSpec"];
                $Bordado = $_POST["newBordado"] . ' ' . $_POST["newComentarioBordado"];
                $Avios = $_POST["newAvios"] . ' ' . $_POST["newComentarioAvios"];
                $Moldes = $_POST["newMoldes"] . ' ' . $_POST["newComentarioMoldes"];


                if ($this->modelo->actualizarCorte($_POST["newCorte"], $Tela, $_POST["newTelaStatus"], $Molde, $_POST["newMoldeStatus"], $Trazo, $_POST["newTrazoStatus"], $_POST["newCantidadReal"], $_POST["newCantidadRealStatus"], $MesaCorte, $_POST["newMesaCorteStatus"], $Foleo, $_POST["newFoleoStatus"], $Pock, $_POST["newPockStatus"], $Fusion, $_POST["newFusionStatus"], $FusionPretina, $_POST["newFusionPretinaStatus"], $PretinaCortada, $_POST["newPretinaCortadaStatus"], $Muestra, $_POST["newMuestraStatus"], $Spec, $_POST["newSpecStatus"], $Bordado, $_POST["newBordadoStatus"], $Avios, $_POST["newAviosStatus"], $Moldes, $_POST["newMoldesStatus"], $_POST["newPassword"])) {


                    echo $this->mensaje($Tela);
                } else {
                    echo $this->mensaje("NO ENTRA");
                }
            }
        } else {
            echo $this->mensaje("no existen");
        }
    }

    public function modificarTarifario() {
        if (isset($_POST["newRuta"]) && isset($_POST["newCostoDia"]) && isset($_POST["Password"]) && isset($_POST["ClaveModificar"])) {
            if ($this->modelo->modificarTarifario($_POST["newRuta"], $_POST["newCostoDia"], $_POST["Password"], $_POST["ClaveModificar"])) {
                echo $this->mensaje("TARIFARIO MODIFICADO");
                $this->redireccionar("Tarifario.php");
            } else {
                echo $this->mensaje("ERROR EN LA BASE DE DATOS");
            }
        }
    }

    public function agregarNuevaRuta() {
        if (isset($_POST["newRuta"]) && isset($_POST["newCostoDia"]) && isset($_POST["Password"])) {
            if ($this->modelo->agregarNuevaRuta($_POST["newRuta"], $_POST["newCostoDia"], $_POST["Password"])) {
                echo $this->mensaje("TARIFARIO MODIFICADO");
                $this->redireccionar("Tarifario.php");
            } else {
                echo $this->mensaje("ERROR EN LA BASE DE DATOS");
            }
        }
    }

    public function modificarCorte() {
        if (isset($_POST["newCorte"]) && isset($_POST["newLinea"]) && isset($_POST["newDescripcion"]) && isset($_POST["newCantidad"]) && isset($_POST["newSemana"]) && isset($_POST["newAvance"]) && isset($_POST["newPassword"]) && isset($_POST["CorteModify"])) {

//              
            if ($this->modelo->modificarCorte($_POST["newCorte"], $_POST["newLinea"], $_POST["newDescripcion"], $_POST["newCantidad"], $_POST["newSemana"], $_POST["newAvance"], $_POST["newPassword"], $_POST["CorteModify"])) {
                $this->redireccionar("ActualizarCorte.php?id=" . $_POST["newCorte"]);
            } else {
                echo $this->mensaje("ERROR EN LA BASE DE DATOS");
            }
        }
    }

    public function mostrarPersonas($ideSupervisor) {
        $registros = $this->modelo->EmpleadoAdmin(1000);
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Nombre Completo</th>                                                    
                                                    <th class="text-center">Puesto</th>
                                                    <th class="text-center">Modificar</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ID"] . '</strong></td>
                                                    <td>' . $r["Nombre"] . '</td>
                                                    <td>' . $r["Puesto"] . '</td>
                                                    <td><h3 class="text-center"><a href="ModificarEmpleadoSupervisor.php?id=' . $r["ID"] . '"><i class="fa  fa-arrows"></i></a></h3></td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function mostrarMaquinaria() {
        $registros = $this->modelo->MostrarMaquinaria();
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Maquina</th>                                                    
                                                    <th class="text-center">Modelo</th>
                                                        <th class="text-center">Ubicacion</th>
                                                          <th class="text-center">Estado</th>
                                                    <th class="text-center">Modificar</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["NumeroActivo"] . '</strong></td>
                                                    <td class="text-center">' . $r["Maquina"] . '</td>
                                                    <td class="text-center">' . $r["Modelo"] . '</td>
                                                          <td class="text-center">' . $r["Ubicacion"] . '</td>
                                                               <td class="text-center">' . $r["Estado"] . '</td>
                                                    <td class="text-center"><h3 class="text-center"><a href="ModifcarMaquinaria.php?id=' . $r["Orden"] . '"><i class="fa  fa-arrows"></i></a></h3></td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';

        return $acu;
    }

    public function mostrarMaquinariaAdminPro() {
        $registros = $this->modelo->MostrarMaquinaria();
        $acu = '';
        foreach ($registros as $r) {
//           $color = "";
//            if ( $r["Estado"]="Verde") {
//               $color="success";
//            }elseif ($r["Estado"]="Rojo") {
//                $color="danger";
//            }

            $acu = $acu . '            <tr>
                                                <td>' . $r["Orden"] . '</td>
                                                <td>' . $r["Maquina"] . '</td>
                                                <td>' . $r["Modelo"] . '</td>
                                                <td>' . $r["Serie"] . '</td>
                                                <td>' . $r["Ubicacion"] . '</td>
                                                <td><span class="label label-table label-success">' . $r["Estado"] . '</span> </td>
                                                <td class="text-center">
                                                    <a href="../Login_v16/login.php"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
';
        }
        return $acu;
    }

    public function mostrarPersonasAdmin() {
        $registros = $this->modelo->EmpleadoAdmin(1000);
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Modificar</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ID"] . '</strong></td>
                                                    
                                                    <td class="text-center">' . $r["Nombre"] . '</td>
                                                    <td><h3 class="text-center"><a href="ModificarEmpleado.php?id=' . $r["ID"] . '"><i class="fa  fa-arrows"></i></a></h3></td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function mostrarCorte($privilegios) {
        $registros = $this->modelo->MostrarCortes($privilegios);
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Corte </th>
                                                    <th class="text-center">Linea</th>
                                                    <th class="text-center">Descripcion</th>
                                                    <th class="text-center">Acutualizar</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["Corte"] . '</strong></td>
                                                    <td class="text-center">' . $r["Linea"] . '</td>
                                                    <td class="text-center">' . $r["Descripcion"] . '</td>
                                                   <td><h3 class="text-center"><a href="ActualizarCorte.php?id=' . $r["Corte"] . '"><i class="fa  fa-refresh"></i></a></h3></td>
                                                  
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function Tarifario() {
        $registros = $this->modelo->mostrarTarifario();
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Clave</th>
                                                    <th class="text-center">Ruta</th>
                                                    <th class="text-center">Costo</th>
                                                    <th class="text-center">Acutualizar</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["Clave"] . '</strong></td>
                                                    <td class="text-center">' . $r["Ruta"] . '</td>
                                                    <td class="text-center">' . $r["CostoDia"] . '</td>
                                                   <td><h3 class="text-center"><a href="ActualizarTarifario.php?id=' . $r["Clave"] . '"><i class="fa  fa-refresh"></i></a></h3></td>
                                                  
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function mostrarOperacionesAdmin() {
        $registros = $this->modelo->OperacionesAdmin(2000);
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Clave </th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Tarea</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ORDEN"] . '</strong></td>
                                                        <td class="text-center">' . $r["Clave_Operacion"] . '</td>
                                                    <td class="text-center">' . $r["Operacion"] . '</td>
                                                    <td class="text-center">' . $r["Tarea"] . '</td>
                                                   </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function mostrarOperacionesOptions() {
        $registros = $this->modelo->OperacionesAdmin(2000);
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["Operacion"] . '">' . $r["Clave_Operacion"] . ' ' . $r["Operacion"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarOptionsModulos() {
        $registros = $this->modelo->mostrarModulos();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<option value="' . $r["ID_Modulo"] . '">' . $r["modulo"] . '</option>';
        }
        return $acu;
    }

    public function mostrarOptionsModulosChecklist() {
        $registros = $this->modelo->mostrarModulosChecklist();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<option value="' . $r["ID_Modulo"] . '">' . $r["modulo"] . '</option>';
        }
        return $acu;
    }

    public function mostrarOptionsActividadChecklist() {
        $registros = $this->modelo->mostrarActividadesChecklist2();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<option value="' . $r["ID_Actividad"] . '">' . $r["actividad"] . '</option>';
        }
        return $acu;
    }

    public function mostrarChecklist() {
        $registros = $this->modelo->mostrarModulosChecklist();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<div class="text-center font-medium mt-2">' . $r["modulo"] . '</div>'
                    . '<hr>';


            $actividades = $this->modelo->mostrarActividadesChecklist($r["ID_Modulo"]);

            $cont = 0;
            foreach ($actividades as $a) {
                $acu = $acu . '<div class="small">' . ($cont + 1) . '.- ' . $a["actividad"] . '</div>   ';
                $cont++;
            }
        }
        return $acu;
    }

    public function mostrarChecklistMP() {
        $registros = $this->modelo->mostrarModulosChecklist();
        $acu = '';
        $count = 1;
        foreach ($registros as $r) {
            $acu = $acu . ' <div class="row m-t-20 font-medium">
                                <div class="col-6 "><label for=""class="font-medium">' . $count . '. ' . $r["modulo"] . '</label></div>
                                <div class="col-2">B</div>
                                <div class="col-2">F</div>
                                <div class="col-2">N/A</div>
                            </div>
                            <hr class="m-t-0"> ';


            $actividades = $this->modelo->mostrarActividadesChecklist($r["ID_Modulo"]);

            $cont = 1;
            foreach ($actividades as $a) {
                $acu = $acu . ' <div class="row">
                                    <div class="col-6"><label for="" class="" style="font-size: 1em" id="ACT-' . $a["ID_Actividad"] . '">' . $count . '.' . $cont . ' ' . $a["actividad"] . '</label></div>
                                    <div class="col-2"> <input type="radio" class="check" id="flat-radio-1" name="ACT-' . $a["ID_Actividad"] . '" data-radio="iradio_flat-green" value="BUENO"></div>
                                    <div class="col-2">  <input type="radio" class="check" id="flat-radio-2" name="ACT-' . $a["ID_Actividad"] . '" data-radio="iradio_flat-red" value="MALO"></div>
                                    <div class="col-2">  <input type="radio" class="check" id="flat-radio-3" name="ACT-' . $a["ID_Actividad"] . '"  data-radio="iradio_flat" value="NO APLICA"></div>
                                </div>';
                $cont++;
            }

            $count++;
        }
        return $acu;
    }

    public function registrarMtto_Preventivo() {
        if (isset($_POST["ID_Maquina"]) && isset($_POST["fecha"]) && isset($_POST["tiempo_requerido"]) && isset($_POST["descripcion"]) && isset($_POST["piezas"]) && isset($_POST["observaciones"])) {
            if ($_POST["ID_Maquina"] <> '' && $_POST["fecha"] <> '' && $_POST["tiempo_requerido"]) {
                //Consultar el ultimo mantenimiento realizado
                $ultimo = 0;
                if ($this->modelo->ultimo_Mtto_Preventivo()) {
                    $ultimo = $this->modelo->ultimo_Mtto_Preventivo();
                }
                $ID_Mtto = ($ultimo + 1);
                $ID_Usuario = $_SESSION["usuario"]["ID"];
                if ($this->modelo->registrarMtto_Preventivo($ID_Mtto, $ID_Usuario, $_POST["ID_Maquina"], $_POST["fecha"], $_POST["tiempo_requerido"], utf8_encode($_POST["descripcion"]), utf8_encode($_POST["piezas"]), utf8_encode($_POST["observaciones"]))) {

                    $actividad = $this->modelo->mostrarActividadesChecklist2();
                    $cont = 0;
                    foreach ($actividad as $a) {
                        $valorAct = 'ACT-' . $a["ID_Actividad"];
                        $texto = $texto . $valorAct . '&&&';
                        if ($this->modelo->registrarMtto_Preventivo_Checklist($ID_Mtto, $a["ID_Actividad"], $_POST[$valorAct], '')) {
                            $cont++;
                        }
                    }
//                    $this->redireccionar('ChecklistMP.php?ID_Mtto=' . $ID_Mtto . '&Registrados=' . $cont . '');
//                    $this->redireccionar('ChecklistMP.php?status=' . md5('success'));
//                    $this->vistaPrevia('../fpdf181/ReporteMP.php?ID_Mtto=' . $ID_Mtto);
                    $this->redireccionar('../fpdf181/ReporteMP.php?ID_Mtto=' . $ID_Mtto);
                }
            }
        }
    }

    public function mostrarOptionsPerfiles() {
        $registros = $this->modelo->mostrarPerfiles();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<option value="' . $r["ID_Perfil"] . '">' . $r["perfil"] . '</option>';
        }
        return $acu;
    }

    public function mostrarOptionsUsuarios() {
        $registros = $this->modelo->mostrarUsuarios();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . '<option value="' . $r["ID"] . '">' . $r["Usuario"] . '</option>';
        }
        return $acu;
    }

    public function mostrarModulos($ID_Perfil) {
        $registros = $this->modelo->modulosUsuario();
        $acu = '';
        $cont = 1;
        foreach ($registros as $r) {
            $acu = $acu . '<h5 class="card-subtitle text-center">' . $r["modulo"] . '</h5>';
            $interfaz = $this->modelo->interfazUsuario($r["modulo"]);
            if ($interfaz) {

                foreach ($interfaz as $i) {
                    $acu = $acu . ' <div class="demo-checkbox">
                                        <input type="checkbox" id="basic_checkbox_' . $cont . '" name="ID_Interfaz[]" value="' . $i["ID_Interfaz"] . '"  ' . $this->habilitar($ID_Perfil, $i["ID_Interfaz"]) . '/>
                                        <label for="basic_checkbox_' . $cont . '">' . $i["nombre"] . '</label>
                                    </div>';
                    $cont++;
                }
            }
        }
        return $acu;
    }

    public function habilitar($ID_Perfil, $ID_Interfaz) {
        if ($this->modelo->interfazPerfil($ID_Perfil, $ID_Interfaz)) {
            return 'checked';
        } else {
            return;
        }
    }

    public function mostrarModulos2() {
        $registros = $this->modelo->modulosUsuario();
        $acu = '';
        $cont = 1;
        foreach ($registros as $r) {
            $acu = $acu . '<h5 class="card-subtitle text-center">' . $r["modulo"] . '</h5>';
            $interfaz = $this->modelo->interfazUsuario($r["modulo"]);
            if ($interfaz) {

                foreach ($interfaz as $i) {
                    $acu = $acu . ' <div class="demo-checkbox">
                                        <input type="checkbox" id="basic_checkbox_' . $cont . '" name="chk[]" value="' . $i["ID_Interfaz"] . '"/>
                                        <label for="basic_checkbox_' . $cont . '">' . $i["nombre"] . '</label>
                                    </div>';
                    $cont++;
                }
            }
        }
        return $acu;
    }

    public function mostrarRefaccionesOptions() {
        $registros = $this->modelo->Refacciones();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["ID_Refaccion"] . '">' . $r["estante"] . ' ' . $r["descripcion"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarUbicacionesMaquinaria() {
        $registros = $this->modelo->UbicacionesMaquinaria();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["Ubicacion"] . '"> ' . $r["Ubicacion"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarEstadosMaquinaria() {
        $registros = $this->modelo->EstadosMaquinaria();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["Estado"] . '"> ' . $r["Estado"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarSemanas2018() {
        $registros = $this->modelo->Semanas2018();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["CLAVE"] . '">' . $r["CLAVE"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarDestinosTarifario() {
        $registros = $this->modelo->DestinosTarifario();
        $acu = '';
        foreach ($registros as $r) {
            $acu = $acu . ' <option value="' . $r["Clave"] . '">' . $r["Clave"] . ' ' . $r["Ruta"] . '</option> ';
        }
        return $acu;
    }

    public function mostrarPlantillaAdmin() {
        $registros = $this->modelo->EmpleadoAdmin(1000);
        $acu = '<thead>
                                                <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Departamento</th>
                                                    <th class="text-center">Actualizar</th>

                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ID"] . '</strong></td>
                                                    <td class="text-center">' . $r["Nombre"] . '</td>
                                                    <td class="text-center">' . $r["Departamento"] . '</td>
                                                    <td><h3 class="text-center"><a href="ActualizarEmpleado.php?id=' . $r["ID"] . '"><i class="fa fa-pencil-square-o"></i></a></h3></td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function mostrarAgregar() {

        return ' <div class="col-sm-3">
                                            <form action="AgregarEmpleado.php">

<input type="submit" value="Agregar Persona">

</form>
                                        </div>';
    }

    public function mostrarAgregarMaquinaria() {

        return ' <div class="col-sm-3">
                                            <form action="AgregarMaquinaria.php">

<input type="submit" value="Agregar Maquina">

</form>
                                        </div>';
    }

    public function mostrarAgregar2() {

        return '        <li class="">
                            <a href="AgregarEmpleado.php"> <i class="menu-icon fa fa-user"></i>Agregar Empleado </a>
                          
                        </li>
                        ';
    }

    public function mostrarMaquinariaIcon() {

        return '        <li class="">
                            <a href="Maquinaria.php"> <i class="menu-icon fa  fa-camera"></i>Maquinaria Hera</a>
                          
                        </li>
                        ';
    }

    public function mostrarAgregarCorte() {

        return '        <li class="">
                            <a href="IngresarCorte.php"> <i class="menu-icon fa fa-plus"></i>Agregar Corte</a>
                          
                        </li>
                        ';
    }

    public function mostrarCortes() {

        return '        <li class="">
                            <a href="MostrarCortes.php"> <i class="menu-icon fa fa-folder"></i>Cortes Activos</a>
                          
                        </li>
                        ';
    }

    public function mostrarTarifario() {

        return '        <li class="">
                            <a href="Tarifario.php"> <i class="menu-icon fa fa-location-arrow"></i>Tarifario Taxis</a>
                          
                        </li>
                        ';
    }

    public function mostrarAgregarTarifa() {

        return '        <li class="">
                            <a href="AgregarNuevaRuta.php"> <i class="menu-icon fa fa-flag"></i>Nueva Ruta</a>
                          
                        </li>
                        ';
    }

    public function mostrarAgregarPedidoTaxi() {

        return '        <li class="">
                            <a href="CrearPedidoTaxi.php"> <i class="menu-icon fa fa-ticket"></i>Registrar Pedido</a>
                          
                        </li>
                        ';
    }

    public function mostrarModificaciones() {
        return '       <li class="">
                            <a href="ConsultarEmpleado.php"> <i class="menu-icon fa   fa-money"></i>Nomina</a>
                          
                        </li>
                        <li class="">
                            <a href="Modificacion.php"> <i class="menu-icon fa  fa-reply-all"></i>Empleados Prestados </a>
                          
                        </li>
                        ';
    }

    public function mostrarPlantilla2() {
        return '<li class="">
                            <a href="Plantilla.php"> <i class="menu-icon fa fa-archive"></i>Plantilla de Empleados </a>
                          
                        </li>';
    }

    public function mostrarOperaciones2() {
        return '<li class="">
                            <a href="Operaciones.php"> <i class="menu-icon fa fa-gears (alias)"></i>Plantilla de Operaciones </a>
                          
                        </li>';
    }

    public function mostrarReportes() {
        return '  <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Reportes</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cloud-download"></i><a href="../excel/reporteEmpleados.php">Plantilla de Trabajadores</a></li>
                            <li><i class="menu-icon fa fa-cloud-download"></i><a href="../excel/ReporteInge.php">Reporte Ingenieria</a></li>
                            <li><i class="menu-icon fa fa-cloud-download"></i><a href="../excel/reporteRegistros.php">Registros</a></li>
                            <li data-toggle="modal" data-target="#ModalTaxi"><a><i class="menu-icon fa fa-cloud-download"></i>Reporte de Pedidos</a></li>
                        </ul>
                    </li>
                     <div class="modal fade" id="ModalTaxi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalTaxi">Fecha:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="../excel/Pedidos.php" method="GET">
                                        <div class="modal-body">
                                            <div class="col-sm-12">
                                                <div class="col-sm-5">
                                                    <input type="date"  name="fecha1" value="">
                                                </div>
                                                <div class="col-sm-2 text-center">
                                                    <label class=" form-control-label text-center"><strong>Al:</strong></label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="date"  name="fecha2" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Generar Reporte</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
    }

    public function mostrarReportesFoleo() {
        return ' <li class="">
                            <a href="RelacionBultos.php"> <i class="menu-icon fa fa-gears (alias)"></i>Relacion Bultos</a>
                        </li> ';
    }

    public function verPrestamos() {
        $registros = $this->modelo->Modificaciones();
        $acu = ' <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Fecha Inicio</th>
                                                    <th class="text-center">Fecha Final </th>
                                                    <th class="text-center">Tiempo<br>Prestamo</th>
                                                    <th class="text-center">Restan</th>
                                                    <th class="text-center">Barra de Retroceso</th>
                                                    <th class="text-center">Modificar</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {

            date_default_timezone_set('America/Mexico_City');

            $final = new DateTime($r["FechaFinalMF"]);
            $datetime1 = new DateTime(date("Y-m-d H:i:s"));
            $interval = $datetime1->diff($final);

            $numeroHoras = (int) $interval->format('%h');
            $numeroDias = (int) $interval->format('%D');
            $numeroMinutos = (int) $interval->format('%i');

            $totalMinutosFaltantes = ($numeroHoras * 60) + ($numeroMinutos) + (($numeroDias * 24) * 60);

            $inicio = new DateTime($r["FechaInicioMF"]);
            $diferencia = $inicio->diff($final);
            $numeroHorasTotal = (int) $diferencia->format('%h');
            $numeroDiasTotal = (int) $diferencia->format('%D');
            $numeroMinutosTotal = (int) $diferencia->format('%i');

            $totalMinutos = ($numeroHorasTotal * 60) + ($numeroMinutosTotal) + (($numeroDiasTotal * 24) * 60);
            $porcentaje = ($totalMinutosFaltantes / $totalMinutos) * 100;

            $porcentaje = number_format($porcentaje, 0);


            if ($datetime1 > $final) {
                $porcentaje = 0;
                $simbolo = ' <td><h5 class="text-danger text-center">Plazo Vencido</h5></td>';
            } else {
                $simbolo = '<td class="text-center"><div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width:' . $porcentaje . '%" aria-valuenow="' . $porcentaje . '" aria-valuemin="0" aria-valuemax="100">.</div></td>';
            }

            /* Tiempo del  prestamo */


            if ($numeroDiasTotal >= 1) {
                if ($numeroHorasTotal >= 1) {
//                       echo 'existen dias y horas <br>';
                    $expresion = $numeroDiasTotal . ' DIA(S)<br>' . $numeroHorasTotal . ' HORA(S)';
                } else {
//                    echo 'existen solo dias<br>';
                    $expresion = $numeroDiasTotal . ' DIA(S)<br>';
                }
            } elseif ($numeroHorasTotal >= 1) {
//                   echo 'existen solo horas <br>';
                $expresion = $numeroHorasTotal . ' HORA(S)';
            }


            $acu = $acu . '   <tr>
                  
                                                    <td class="text-center"><strong>' . $r["IDMF"] . '</strong></td>                                                   
                                                    <td class="text-center">' . $r["NombreMF"] . '</td>
                                                    <td class="text-center">' . $r["FechaInicioMF"] . '</td>
                                                    <td class="text-center">' . $r["FechaFinalMF"] . '</td>
                                                    <td class="text-center"> <strong>' . $expresion . '</strong></td>
                                                    <td class="text-center"> <strong>' . $porcentaje . '%</strong></td>' . $simbolo . '
                                                    <td><h3 class="text-center"><a href="ModificarEmpleado.php?id=' . $r["IDMF"] . '"><i class="fa  fa-arrows"></i></a></h3></td>
                                              
               
                                                </tr>
                                                
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function verRegistros() {
        $registros = $this->modelo->Registros();
        $acu = ' <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Evento</th>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ID_Log"] . '</strong></td>                                                   
                                                    <td class="text-center">' . $r["Tipo"] . '</td>
                                                    <td class="text-center">' . $r["Evento"] . '</td>
                                                    <td class="text-center"><strong>' . $r["ID_Supervisor"] . '</strong></td>
                                                    <td class="text-center"> ' . $r["Nombre"] . '</td>
                                                    <td class="text-center">' . $r["Fecha"] . '</td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    public function verRegistrosSupervisor($ideSupervisor) {
        $registros = $this->modelo->RegistrosSupervisor(1000, $ideSupervisor);
        $acu = ' <tr>
                                                    <th class="text-center">Número </th>
                                                    <th class="text-center">Tipo</th>
                                                    <th class="text-center">Evento</th>                                                 
                                                    <th class="text-center">Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td class="text-center"><strong>' . $r["ID_Log"] . '</strong></td>
                                                    <td class="text-center">' . $r["Tipo"] . '</td>
                                                    <td class="text-center">' . $r["Evento"] . '</td>                                                  
                                                    <td class="text-center">' . $r["Fecha"] . '</td>
               
                                                </tr>
';
        } $acu = $acu . '</tbody>';
        return $acu;
    }

    /* <td>' . $r["Tipo"] . '</td> */

    public function mostrarRegi($privilegios) {
        if ($privilegios == 1) {
            return ' <a class="nav-link" href="Registro.php"><i class="fa fa -cog"></i>Registro</a>';
        } else {
            return '<a class="nav-link" href="Registro.php"><i class="fa fa -cog"></i>Registro</a>';
        }
    }

    public function emularMaquinar($texto, $cantidad) {
        $cantidad = (int) $cantidad;
        $texto = (String) $texto;
        $acu = "";

        for ($index = 0; $index < $cantidad; $index++) {
            $acu = $acu . $texto;
        }
        return $acu;
    }

    public function stats($tabla, $columna, $condicion) {
        $registros = $this->modelo->obtenerStats($tabla, $columna, $condicion);
        foreach ($registros as $contador) {
            return $contador['count(*)'];
        }
    }

    public function MostrarSalidasRefacciones($ID_Refaccion) {
        $acu = '';
        $registros = $this->modelo->MostrarSalidasRefacciones($ID_Refaccion);
        foreach ($registros as $r) {
            $acu = $acu .
                    ' <div class="col-lg-12 p-0 ">
                                                    <div class="row align-content-center">
                                                        <div class="col-lg-1 h4 m-t-10">
                                                            <div class="row text-center">
                                                                <div class="col-12 align-content-center">
                                                                    <i class="fa fa-level-down text-danger"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 text-center">
                                                            <div class="row">
                                                                <div class="col-12 p-l-10">
                                                                    <small class="font-normal">' . $this->acortarTexto($r['nombre'], 26) . '</small>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-12 text-center">
                                                                    <div class="font-10 font-weight-bold">' . $this->fechaMx($r['fecha']) . '</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 text-success text-center p-0">
                                                            <button class=" btn-info mt-2" type="button"  ><span class="h5 btn-sm">' . $r['cantidad'] . '</span></button>
                                                        </div>
                                                    </div>
                                                    <hr class="m-t-10 m-b-15">
                                                </div>';
        }
        return $acu;
    }

    public function MostrarEntradasRefacciones($ID_Refaccion) {
        $acu = '';
        $registros = $this->modelo->MostrarEntradasRefacciones($ID_Refaccion);
        foreach ($registros as $r) {
            $acu = $acu .
                    ' <div class="col-lg-12 p-0 ">
                                                    <div class="row align-content-center">
                                                        <div class="col-lg-1 h4 m-t-10">
                                                            <div class="row text-center">
                                                                <div class="col-12 align-content-center">
                                                                    <i class="fa fa-level-up text-success"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 text-center">
                                                            <div class="row">
                                                                <div class="col-12 p-l-10">
                                                                    <small class="font-normal">' . $this->acortarTexto($r['proveedor'], 26) . '</small>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-12 text-center">
                                                                    <div class="font-10 font-weight-bold">' . $this->fechaMx($r['fecha']) . '</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 text-success text-center p-0">
                                                            <button class=" btn-info mt-2" type="button"  ><span class="h5 btn-sm">' . $r['cantidad'] . '</span></button>
                                                        </div>
                                                    </div>
                                                    <hr class="m-t-10 m-b-15">
                                                </div>';
        }
        return $acu;
    }

    public function ObtenerPersona() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $persona = $this->modelo->obtenerPersona(($_GET["id"]));
            return $persona;
        }
//        $this->redireccionar("panel.php?");
    }

    public function ObtenerMaquina() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $maquina = $this->modelo->obtenermaquina(($_GET["id"]));
            return $maquina;
        }
//        $this->redireccionar("panel.php?");
    }

    public function ObtenerCorte() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $corte = $this->modelo->obtenerCorte(($_GET["id"]));
            return $corte;
        }
//        $this->redireccionar("panel.php?");
    }

    public function ObtenerTarifario() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $tarifario = $this->modelo->obtenerTarifario(($_GET["id"]));
            return $tarifario;
        }
//        $this->redireccionar("panel.php?");
    }

    public function ObtenerPersonaMF() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $persona = $this->modelo->obtenerPersonaMF(($_GET["id"]));
            return $persona;
        }
//        $this->redireccionar("panel.php?");
    }

//*Estos metodos corresponden a la plantilla anterior
    public function mostrarTeam() {
        $regis = $this->modelo->consultaProductos(100);
    }

    public function ultimoDestino() {
        $ultimo = $this->modelo->ultimoDestino();
        return $ultimo;
    }

    public function subirCurriculum() {
        if (isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_FILES["foto"])) {
            if ($_POST["nombre"] <> "" && $_POST["precio"] <> "") {
                if ($_FILES["foto"]["name"] <> "") {
                    if (copy($_FILES["foto"]["tmp_name"], "../images/" . $_FILES["foto"]["name"])) {
                        if ($this->modelo->insertarProducto($_POST["nombre"], "/images/" . $_FILES["foto"]["name"], $_POST["precio"])) {
                            $this->redireccionar("index2.php");
                            echo $this->mensaje("Producto Agregado con Exito!!");
                        } else {
                            echo $this->mensaje("Error en la bd");
                        }
                    } else {
                        echo $this->mensaje("No se guardo la foto y el registro");
                    }
                } else {
                    echo $this->mensaje("Debes subir una foto");
                }
            } else {
                echo $this->mensaje("Debes llenar todos los campos");
            }
        }
    }

    public function subirRelacionBultos() {
        if (isset($_FILES["archivo"])) {
            if ($_FILES["archivo"] <> "") {
                date_default_timezone_set('America/Mexico_City');
                $datetime1 = date("Y-m-d");
                $datetime2 = date("H");
                $datetime3 = date("i");
                $datetime4 = date("s");
                $fecha = $datetime1 . '_' . $datetime2 . '-' . $datetime3 . '-' . $datetime3;
                rename("../archivosExcel/RelacionBultos.xlsx", "../archivosExcel/$fecha.xlsx");
                if (copy($_FILES["archivo"]["tmp_name"], "../archivosExcel/RelacionBultos.xlsx")) {
                    
                }
            } else {
                echo $this->mensaje("Debes llenar todos los campos");
            }
        }
    }

    public function mostrarProductosAlmacen() {
        $registros = $this->modelo->consultaProductos(3);
        $acu = "";
        foreach ($registros as $r) {
            $acu = $acu . '   <tr>
                                                    <td>' . $r["ID_Producto"] . '</td>
                                                    <td>' . $this->acortarTexto($r["Nombre"], 100) . '</td>
                                                      <td>$' . $r["Precio"] . '</td>
                                                    <td><h4><a href="productoM.php?id=' . $r["ID_Producto"] . '"><i class="fa fa-edit"></i></a></h4></td>
                                                    <td><h4><a href="productoE.php?id=' . $r["ID_Producto"] . '"><i class="fa fa-trash"></i></a></h4></td>
               
                                                </tr>
';
        }
        return $acu;
    }

    public function comentariosNuevos($cantidad) {
        $reg = $this->modelo->consultaComentarios($cantidad);
        $acu = "";
        foreach ($reg as $r) {
            $acu .= ' <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <input id="checkbox' . $r["ID_Comentario"] . '</" type="checkbox">
                                                                <label for="checkbox' . $r["ID_Comentario"] . '</"></label>
                                                            </div>
                                                        </td>
                                                        <td><b>' . $r["nombre"] . '</b>' . $r["comentario"] . '</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>';
        }
        return $acu;
    }

    public function ObtnerPersona() {
        if (isset($_GET["id"])) {
            $id = (int) ($_GET["id"]);
            $persona = $this->modelo->obtenerProducto(($_GET["id"]));
            return $persona;
        }
        $this->redireccionar("index2.php");
    }

    public function modificarCurriculum() {
        if (isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_FILES["foto"])) {
            if ($_POST["nombre"] <> "" && $_POST["precio"] <> "") {
                if ($_FILES["foto"]["name"] <> "") {
                    if (copy($_FILES["foto"]["tmp_name"], "../images/" . $_FILES["foto"]["name"])) {
                        if ($this->modelo->modificarProducto($_POST["id"], $_POST["nombre"], $_POST["precio"], "/images/" . $_FILES["foto"]["name"])) {
                            $this->redireccionar("index2.php");
                            echo $this->mensaje("Producto Agregado con Exito!!");
                        } else {
                            echo $this->mensaje("Error en la bd");
                        }
                    } else {
                        echo $this->mensaje("No se guardo la foto y el registro");
                    }
                } else {
                    if ($this->modelo->modificarProducto($_POST["id"], $_POST["nombre"], $_POST["precio"])) {
                        $this->redireccionar("index2.php");
                        echo $this->mensaje("Producto Agregado con Exito!!");
                    } else {
                        echo $this->mensaje("Error en la bd");
                    }
                }
            } else {
                echo $this->mensaje("Debes llenar todos los campos");
            }
        }
    }

    public function EliminarProducto() {

        if (isset($_POST["id"])) {

            $id = (int) ($_POST["id"]);
            $persona = $this->modelo->eliminarProducto($_POST["id"]);
            $this->mensaje("Producto Eliminado");
        }
    }

    public function PanelIzquierdo() {
        return '<aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="./"><img src="images/logo gris.png" alt="Logo" width="100px" height="30px"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                </div>

                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="panel.php"> <i class="menu-icon fa fa-users"></i>Empleados</a>
                        </li>
                        <li class="">
                            <a href="Registro.php"> <i class="menu-icon fa fa-archive"></i>Registros </a>

                        </li>

                        <?php
                        if ($usernameSesion["Privilegios"] == 1) {
                            echo $BD->mostrarAgregar2();
                            echo $BD->mostrarPlantilla2();
                            echo $BD->mostrarOperaciones2();
                        }
                        ?>  

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside>';
    }

}
