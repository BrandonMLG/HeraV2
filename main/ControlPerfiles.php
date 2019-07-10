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
        <?php echo $BE->faviconLogo(); ?> 
        <title>Inicio</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
        <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
        <!--c3 CSS -->
        <link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="css/pages/dashboard1.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/blue.css" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!--Script personas-->
        <script src="jsPersonal/script.js"></script>
        <!-- toast CSS -->
        <link href="../assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!--Ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            function realizaProceso() {
                var valorBusqueda = $('#ID_Perfil').val();
                var parametros = {
                    "busqueda": valorBusqueda,
                };
                $.ajax({
                    data: parametros, //datos que se envian a traves de ajax
                    url: 'AJAX/mostrarModulos.php', //archivo que recibe la peticion
                    type: 'post', //método de envio
                    // beforeSend: function () {
                    //     $("#tabla_resultado").html("<div class='text-center h5'>   Procesando, espere por favor...</div>");
                    // },
                    success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#tabla_resultado").html(response);

                    }
                });
            }
        </script>





        <![endif]-->
    </head>

    <body class="fix-header fix-sidebar card-no-border">
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
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text --><span>
                                <!-- dark Logo text -->
                                <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->    
                                <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto">
                            <!-- This is  -->
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <div class="text-center col-lg-8 col-sm-5 col-md-6">
                            <p class="h3 text-white">
                                Inicio
                            </p>
                        </div>




                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">
                            <!-- ============================================================== -->
                            <!-- Search -->

                            <!-- ============================================================== -->
                            <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                                <form class="app-search">
                                    <input type="text" class="form-control" placeholder="Search & enter" id="Busqueda" autofocus="on" autocomplete="off"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                            </li>
                            <!-- ============================================================== -->
                            <!-- Comment -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                    <ul>
                                        <li>
                                            <div class="drop-title">Notifications</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- End Comment -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Messages -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                </a>
                                <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
                                    <ul>
                                        <li>
                                            <div class="drop-title">You have 4 new messages</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="user-img"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                                </a>
                                                <!-- Message -->
                                                <a href="#">
                                                    <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- End Messages -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- mega menu -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                                <div class="dropdown-menu animated bounceInDown">
                                    <ul class="mega-dropdown-menu row">
                                        <li class="col-lg-3 col-xlg-2 m-b-30">
                                            <h4 class="m-b-20">CAROUSEL</h4>
                                            <!-- CAROUSEL -->
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <div class="container"> <img class="d-block img-fluid" src="../assets/images/big/img1.jpg" alt="First slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="../assets/images/big/img2.jpg" alt="Second slide"></div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="container"><img class="d-block img-fluid" src="../assets/images/big/img3.jpg" alt="Third slide"></div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                            </div>
                                            <!-- End CAROUSEL -->
                                        </li>
                                        <li class="col-lg-3 m-b-30">
                                            <h4 class="m-b-20">ACCORDION</h4>
                                            <!-- Accordian -->
                                            <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Collapsible Group Item #1
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high. </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingTwo">
                                                        <h5 class="mb-0">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Collapsible Group Item #2
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Collapsible Group Item #3
                                                            </a>
                                                        </h5> </div>
                                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-lg-3  m-b-30">
                                            <h4 class="m-b-20">CONTACT US</h4>
                                            <!-- Contact -->
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" placeholder="Enter email"> </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </form>
                                        </li>
                                        <li class="col-lg-3 col-xlg-4 m-b-30">
                                            <h4 class="m-b-20">List style</h4>
                                            <!-- List style -->
                                            <ul class="list-style-none">
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- End mega menu -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Language -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                                <div class="dropdown-menu dropdown-menu-right animated bounceInDown"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="../assets/images/users/1.jpg" alt="user"></div>
                                                <div class="u-text">
                                                    <h4>Steave Jobs</h4>
                                                    <p class="text-muted">varun@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                        <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                        <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="Inicio.php?salir=1"><i class="fa fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="../assets/images/users/profile.png" alt="user" /><span class="hide-menu">Steave Jobs </span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="javascript:void()">My Profile </a></li>
                                    <li><a href="javascript:void()">My Balance</a></li>
                                    <li><a href="javascript:void()">Inbox</a></li>
                                    <li><a href="javascript:void()">Account Setting</a></li>
                                    <li><a href="javascript:void()">Logout</a></li>
                                </ul>
                            </li>
                            <li class="nav-devider"></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-trending-up"></i><span class="hide-menu">Depto Nominas<span class="label label-rouded label-success pull-right">1</span></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="ConsultarNomina.php">Consulta Nomina</a></li>
                                </ul>
                            </li>
                            <li class="nav-devider"></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-barcode-scan"></i><span class="hide-menu">Extras<span class="label label-rouded label-warning pull-right">1</span></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="Maquinaria.php">Maquinaria Hera</a></li>
                                    <li><a href="ConsultarMaquinaria.php">Modificar Maquinaria</a></li>
                                </ul>

                            </li>
                            <li class="nav-devider"></li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Ui Elements <span class="label label-rouded label-danger pull-right">25</span></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-user-card.html">User Cards</a></li>
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-tab.html">Tab</a></li>
                                    <li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
                                    <li><a href="ui-tooltip-stylish.html">Tooltip stylish</a></li>
                                    <li><a href="ui-sweetalert.html">Sweet Alert</a></li>
                                    <li><a href="ui-notification.html">Notification</a></li>
                                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                                    <li><a href="ui-nestable.html">Nestable</a></li>
                                    <li><a href="ui-range-slider.html">Range slider</a></li>
                                    <li><a href="ui-timeline.html">Timeline</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-horizontal-timeline.html">Horizontal Timeline</a></li>
                                    <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                    <li><a href="ui-session-ideal-timeout.html">Session Ideal Timeout</a></li>
                                    <li><a href="ui-bootstrap.html">Bootstrap Ui</a></li>
                                    <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                                    <li><a href="ui-bootstrap-switch.html">Bootstrap Switch</a></li>
                                    <li><a href="ui-list-media.html">List Media</a></li>
                                    <li><a href="ui-ribbons.html">Ribbons</a></li>
                                    <li><a href="ui-grid.html">Grid</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                    <li><a href="ui-date-paginator.html">Date-paginator</a></li>
                                    <li><a href="ui-dragable-portlet.html">Dragable Portlet</a></li>
                                </ul>
                            </li>
                            <li class="nav-devider"></li>

                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>

            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->


                <!-- ============================================================== -->
                <div class="container-fluid p-b-0">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><strong>1.- Registrar Usuario</strong></h4>
                                    <form class="form-material m-t-40" method="POST" action="procesarFormulario.php">
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="User (GT)" name="User" autocomplete="off"> </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Nombre" name="Nombre" autocomplete="off"> </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Departamento" name="Departamento" autocomplete="off"> </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Seccion" name="Seccion" autocomplete="off"> </div>
                                        <div class="form-group col-12">
                                            <input type="password" class="form-control form-control-line" value="" placeholder="Password" name="Password" autocomplete="off"> </div>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="1" placeholder="Privilegios" name="Privilegios" autocomplete="off"> </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label>Input Select</label>
                                                                                    <select class="form-control">
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                        <option>4</option>
                                                                                        <option>5</option>
                                                                                    </select>
                                                                                </div>-->
                                        <!--                                        <div class="form-group">
                                                                                    <label>File upload</label>
                                                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                                        <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                                                            <input type="hidden">
                                                                                            <input type="file" name="..."> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Helping text</label>
                                                                                    <input type="text" class="form-control form-control-line"> <span class="help-block text-muted"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span> </div>-->
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="1" placeholder="formValue" name="formValue">
                                        </div>    
                                        <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-user-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body"> 
                                    <h4 class="card-title"><strong>3.- Agregar Interfaz</strong></h4>
                                    <form action="procesarFormulario.php" method="POST" class="form-material m-t-40 m-b-20"> 
                                        <div class="form-group col-12"> 
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Nombre del Interfaz" name="interfaz" autocomplete="off">
                                        </div>
                                        <div class="form-group col-12"> 
                                            <input type="text" class="form-control form-control-line" value="" placeholder="URL" name="url" autocomplete="off">
                                        </div>
                                        <div class="form-group text-center">
                                            <label>Modulo</label>
                                            <select class="form-control text-center" name="ID_Modulo">
                                                <option>Select..</option>
                                                <?php echo $BE->mostrarOptionsModulos(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="3" placeholder="formValue" name="formValue">
                                        </div>
                                        <div class="col-md-3 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-flag-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body"> 
                                    <h4 class="card-title"><strong>5.- Agregar Interfaz-Perfil</strong></h4>
                                    <form action="procesarFormulario.php" method="POST" class="form-material m-t-40 m-b-20"> 
                                        <div class="text-center col-12 m-b-30">
                                            <select class="form-control" name="ID_Perfil" id="ID_Perfil" onchange="realizaProceso()">
                                                <option value="0">PROFILE</option>
                                                <?php echo $BE->mostrarOptionsPerfiles() ?>
                                            </select>
                                        </div>
                                        <section id="tabla_resultado"></section>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="5" placeholder="formValue" name="formValue">
                                        </div>
                                        <div class="col-md-3 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-flag-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title m-t-30"><strong>2.- Registrar Modulo</strong></h4>
                                    <form action="procesarFormulario.php" method="POST" class="form-material m-t-40 m-b-20"> 
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Nombre del Modulo" name="modulo" autocomplete="off"> </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Icon" name="icon" autocomplete="off"> </div>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="2" placeholder="formValue" name="formValue">
                                        </div> 
                                        <div class="col-md-2 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-folder-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-t-40"><strong>4.- Registrar Perfil</strong></h4>
                                    <form action="procesarFormulario.php" method="POST" class="form-material m-t-40 m-b-20"> 
                                        <div class="form-group col-12"> 
                                            <input type="text" class="form-control form-control-line" value="" placeholder="Nombre del Perfil" name="perfil" autocomplete="off">
                                        </div>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="4" placeholder="formValue" name="formValue">
                                        </div> 
                                        <div class="col-md-3 offset-md-3"><button type="submit" class="btn btn-info"><i class="fa fa-vcard-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title m-t-40"><strong>6.- Vincular Perfil-Usuario</strong></h4>
                                    <form action="procesarFormulario.php" method="POST" class="form-material m-t-40 m-b-20"> 
                                        <div class="text-center col-12">
                                            <label>Nombre Perfil</label>
                                            <select class="form-control text-center" name="ID_Perfil">
                                                <option></option>
                                                <?php echo $BE->mostrarOptionsPerfiles() ?>
                                            </select>
                                        </div>
                                        <div class="text-center col-12">
                                            <label>Nombre Usuario</label>
                                            <select class="form-control text-center" name="ID_Usuario">
                                                <option></option>
                                                <?php echo $BE->mostrarOptionsUsuarios() ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 hide">
                                            <input type="text" class="form-control form-control-line" value="6" placeholder="formValue" name="formValue">
                                        </div> 
                                        <div class="col-md-3 offset-md-3 m-t-20"><button type="submit" class="btn btn-info"><i class="fa fa-vcard-o"></i> Save</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>        

                    <!--                    <div class="row">
                                            <div class="col-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex no-block">
                                                            <div class="m-r-20 align-self-center h3 text-info"><span class="lstick m-r-20 "></span><i class="fa fa-users"></i></div>
                                                            <div class="align-self-center">
                                                                <h6 class="text-muted m-t-10 m-b-0">Total Empleados:</h6>
                                                                <h2 class="m-t-0 text-center"><?php echo $BE->numEmpleadosUltimaSemana(); ?></h2></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex no-block">
                                                            <div class="m-r-20 align-self-center h3 text-megna"><span class="lstick m-r-20"></span><i class="fa fa-barcode"></i></div>
                                                            <div class="align-self-center">
                                                                <h6 class="text-muted m-t-10 m-b-0">Total Maquinaria:</h6>
                                                                <h2 class="m-t-0 text-center"><?php echo $BE->numMaquinas(); ?></h2></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex no-block">
                                                            <div class="m-r-20 align-self-center h3 text-primary"><span class="lstick m-r-20"></span><i class="fa fa-gears"></i></div>
                                                            <div class="align-self-center">
                                                                <h6 class="text-muted m-t-10 m-b-0">Total Refacciones:</h6>
                                                                <h2 class="m-t-0 text-center"><?php echo $BE->numRefacciones(); ?></h2></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex no-block">
                                                            <div class="m-r-20 align-self-center h3 text-muted"><span class="lstick m-r-20"></span><i class="fa fa-bank"></i></div>
                                                            <div class="align-self-center">
                                                                <h6 class="text-muted m-t-10 m-b-0">Total Maquinaria:</h6>
                                                                <h2 class="m-t-0 text-center"><?php echo $BE->numMaquinas(); ?></h2></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-xlg-4">
                                                <div class="card">
                                                    <div class="card-body little-profile text-center">
                                                        <div class="pro-img m-t-20"><img src="../assets/images/users/HERA4.png" alt="user"></div>
                                                        <h3 class="m-b-0">Heracles</h3>
                                                        <h6 class="text-muted">Diseño Web 2.0</h6>
                                                        <ul class="list-inline soc-pro m-t-30">
                                                            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                                            <li><a href="javascript:void(0)"><i class="fa fa-facebook-square"></i></a></li>
                                                            <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                                            <li><a href="javascript:void(0)"><i class="fa fa-youtube-play"></i></a></li>
                                                            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="text-center bg-light">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6  p-20 b-r">
                                                                <h4 class="m-b-0 font-medium">35000</h4><small>Followers</small></div>
                                                            <div class="col-lg-6 col-md-6  p-20">
                                                                <h4 class="m-b-0 font-medium">180</h4><small>Following</small></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <a href="javascript:void(0)" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">Welcome</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="card">
                                                    <div class="card-body m-t-0">
                                                        <h4 class="card-title"><span class="lstick"></span>Despersión:</h4>
                                                        <div id="visitor" style="height:290px; width:100%;"></div>
                                                        <table class="table vm font-14">
                                                            <tr>
                                                                <td class="b-0">Linea 1</td>
                                                                <td class="text-right font-medium b-0">38.5%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Linea 2</td>
                                                                <td class="text-right font-medium">53.9%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Linea 3</td>
                                                                <td class="text-right font-medium">7.7%</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="b-0">Linea 4</td>
                                                                <td class="text-right font-medium b-0">38.5%</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="col-lg-12">
                                                    <div class="card bg-info text-white op-5">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="stats">
                                                                    <h1 class="text-white">3257+</h1>
                                                                    <h6 class="text-white">Consultar Nomina</h6>
                                                                    <button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Check list</button>
                                                                </div>
                                                                <div class="stats-icon text-right ml-auto"><i class="fa fa-money display-5 op-3 text-dark"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card bg-success text-white op-5">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="stats">
                                                                    <h1 class="text-white">6509+</h1>
                                                                    <h6 class="text-white">Entradas de Ref</h6>
                                                                    <button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Check list</button>
                                                                </div>
                                                                <div class="stats-icon text-right ml-auto"><i class="fa fa-level-up display-5 op-3 text-dark"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card bg-danger text-white op-5">
                                                        <div class="card-body">
                                                            <div class="d-flex">
                                                                <div class="stats">
                                                                    <h1 class="text-white">9062+</h1>
                                                                    <h6 class="text-white">Salidas de Ref</h6>
                                                                    <button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Check list</button>
                                                                </div>
                                                                <div class="stats-icon text-right ml-auto"><i class="fa fa-level-down display-5 op-3 text-dark"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->


                    <?php echo $BE->alertaCerrarSesion(); ?>

                    <!-- .right-sidebar -->
                    <div class="right-sidebar">
                        <div class="slimscrollright">
                            <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                            <div class="r-panel-body">
                                <ul id="themecolors" class="m-t-20">
                                    <li><b>With Light sidebar</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                    <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                                </ul>
                                <ul class="m-t-20 chatonline">
                                    <li><b>Chat option</b></li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer"> © 2017 Admin Pro by wrappixel.com </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
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
        <!-- Bootstrap popper Core JavaScript -->
        <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
        <script src="../assets/plugins/toast-master/js/jquery.toast.js"></script>
        <script src="js/toastr.js"></script>

        <!-- Session-timeout-idle -->
        <script src="../assets/plugins/session-timeout/idle/jquery.idletimeout.js"></script>
        <script src="../assets/plugins/session-timeout/idle/jquery.idletimer.js"></script>

        <!-- ============================================================== -->
        <!-- This page plugins -->

        <!-- ============================================================== -->
        <!--sparkline JavaScript -->
        <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!--morris JavaScript -->
        <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
        <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
        <!--c3 JavaScript -->
        <script src="../assets/plugins/d3/d3.min.js"></script>
        <script src="../assets/plugins/c3-master/c3.min.js"></script>
        <!-- Popup message jquery -->
        <script src="../assets/plugins/toast-master/js/jquery.toast.js"></script>
        <!-- ============================================================== -->
        <!-- Style switcher -->
        <!-- ============================================================== -->
        <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


        <script>
                                                document.addEventListener('keyup', event => {
                                                    if (event.ctrlKey && event.keyCode === 66) {

                                                        document.getElementById("botonBusqueda").focus();
                                                    }
                                                }, false);
        </script>

        <!--c3 JavaScript -->
        <script src="../assets/plugins/d3/d3.min.js"></script>
        <script src="../assets/plugins/c3-master/c3.min.js"></script>
        <script>
                                                var UIIdleTimeout = function () {
                                                    return {
                                                        init: function () {
                                                            var o;
                                                            $("body").append(""), $.idleTimeout("#idle-timeout-dialog", ".modal-content button:last", {
                                                                idleAfter: 180,
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


                                                $(function () {
                                                    "use strict";
                                                    // ============================================================== 
                                                    // Sales overview
                                                    // ============================================================== 
                                                    new Chartist.Line('#sales-overview2', {
                                                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                                                        , series: [
                                                            {meta: "Colaboradores:", data: [0, 150, 110, 240, 200, 200, 300, 200, 380, 300, 400, 380]}
                                                        ]
                                                    }, {
                                                        low: 0
                                                        , high: 400
                                                        , showArea: true
                                                        , divisor: 10
                                                        , lineSmooth: false
                                                        , fullWidth: true
                                                        , showLine: true
                                                        , chartPadding: 30
                                                        , axisX: {
                                                            showLabel: true
                                                            , showGrid: false
                                                            , offset: 50
                                                        }
                                                        , plugins: [
                                                            Chartist.plugins.tooltip()
                                                        ],
                                                        // As this is axis specific we need to tell Chartist to use whole numbers only on the concerned axis
                                                        axisY: {
                                                            onlyInteger: true
                                                            , showLabel: true
                                                            , scaleMinSpace: 50
                                                            , showGrid: true
                                                            , offset: 10,
                                                            labelInterpolationFnc: function (value) {
                                                                return (value / 100) + ''
                                                            },

                                                        }

                                                    });
                                                    // ============================================================== 
                                                    // Visitor
                                                    // ============================================================== 

                                                    var chart = c3.generate({
                                                        bindto: '#visitor',
                                                        data: {
                                                            columns: [
                                                                ['LINEA 1', 3],
                                                                ['LINEA 2', 10],
                                                                ['LINEA 3', 40],
                                                                ['LINEA 4', 50],
                                                                ['Otros', 50],
                                                            ],

                                                            type: 'donut',
                                                            onclick: function (d, i) {
                                                                console.log("onclick", d, i);
                                                            },
                                                            onmouseover: function (d, i) {
                                                                console.log("onmouseover", d, i);
                                                            },
                                                            onmouseout: function (d, i) {
                                                                console.log("onmouseout", d, i);
                                                            }
                                                        },
                                                        donut: {
                                                            label: {
                                                                show: false
                                                            },
                                                            title: "Scatter",
                                                            width: 30,

                                                        },

                                                        legend: {
                                                            hide: true
                                                                    //or hide: 'data1'
                                                                    //or hide: ['data1', 'data2']
                                                        },
                                                        color: {
                                                            pattern: ['#eceff1', '#ffff00', '#745af2', '#26c6da', '#1e88e5']
                                                        }
                                                    });

                                                    // ============================================================== 
                                                    // Website Visitor
                                                    // ============================================================== 

                                                    var chart = new Chartist.Line('.website-visitor', {
                                                        labels: [1, 2, 3, 4, 5, 6, 7, 8],
                                                        series: [
                                                            [0, 5, 6, 8, 25, 9, 8, 28]
                                                                    , [0, 3, 1, 2, 8, 1, 5, 1]
                                                        ]}, {
                                                        low: 0,
                                                        high: 28,
                                                        showArea: true,
                                                        fullWidth: true,
                                                        plugins: [
                                                            Chartist.plugins.tooltip()
                                                        ],
                                                        axisY: {
                                                            onlyInteger: true
                                                            , scaleMinSpace: 40
                                                            , offset: 20
                                                            , labelInterpolationFnc: function (value) {
                                                                return (value / 1) + 'k';
                                                            }
                                                        },
                                                    });
                                                    // Offset x1 a tiny amount so that the straight stroke gets a bounding box
                                                    // Straight lines don't get a bounding box 
                                                    // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
                                                    chart.on('draw', function (ctx) {
                                                        if (ctx.type === 'area') {
                                                            ctx.element.attr({
                                                                x1: ctx.x1 + 0.001
                                                            });
                                                        }
                                                    });

                                                    // Create the gradient definition on created event (always after chart re-render)
                                                    chart.on('created', function (ctx) {
                                                        var defs = ctx.svg.elem('defs');
                                                        defs.elem('linearGradient', {
                                                            id: 'gradient',
                                                            x1: 0,
                                                            y1: 1,
                                                            x2: 0,
                                                            y2: 0
                                                        }).elem('stop', {
                                                            offset: 0,
                                                            'stop-color': 'rgba(255, 255, 255, 1)'
                                                        }).parent().elem('stop', {
                                                            offset: 1,
                                                            'stop-color': 'rgba(38, 198, 218, 1)'
                                                        });
                                                    });
                                                });
        </script>
    </body>

</html>