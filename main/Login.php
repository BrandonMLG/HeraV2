<?php
session_start();
include_once '../Modelo/Modelo.php';
include_once '../Logica/BackEnd.php';
$BE = new BackEnd();
$BE->autentificar2();

if ($BE->siAutentificado()) {
    $BE->redireccionar("Inicio.php");
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
        <?php echo $BE->faviconLogo() ?>
        <title>Inicio de Sesión</title>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- page css -->
        <link href="css/pages/login-register-lock.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">

        <!-- You can change the theme colors from here -->
        <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
        <script>
            function verificar() {
                var usuario = $(`#usuario`).val();
                var password = $(`#password`).val();
                var ver = false;
                if (usuario !== '' && password !== '') {
                    document.getElementById('boton').disabled = false;
                } else {
                    document.getElementById('boton').disabled = true;
                }
            }
        </script>
        <script>
            function status() {
                var status = "<?php echo $_GET["status"] ?>"
       
                    if (status == "<?php echo md5("errorUser") ?>") {
                        document.getElementById("mensaje").innerHTML = '<i class="fa  fa-exclamation-circle"></i> Usuario Invalido';
                    } else if (status == "<?php echo md5("errorPass") ?>") {
                        document.getElementById("mensaje").innerHTML = '<i class="fa  fa-exclamation-circle"></i> Contraseña Invalida';
                    }
                }

        </script>

    </head>

    <body class="card-no-border" onload="status()">
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
        <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../assets/images/background/fondo.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" action="Login.php" method="POST">
                        <a  href="javascript:void(0)" class="text-center db m-t-40 "><img  height="120px"src="../assets/images/users/HERA4.png" alt="Home" class="m-t-40 animated fadeInDown" /><br/><img src="../assets/images/letrasAzul.png" alt="Home" class="animated fadeInRight"/></a>
                        <div class="form-group m-t-40 m-b-10">
                            <div class="col-lg-12 tex-center">
                                <input class="form-control text-center" type="text"  autocomplete="off" required="" placeholder="Username" id="usuario" name="usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input class="form-control text-center" type="password" autocomplete="off"required="" placeholder="Password" id="password" name="password" >
                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded text-white" type="submit" id="boton">Iniciar Sesión</button>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-lg-12">
                                <label class="small font-weight-bold text-danger align-center" id="mensaje"></label>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!--Custom JavaScript -->
        <script type="text/javascript">
                                    $(function () {
                                        $(".preloader").fadeOut();
                                    });
                                    $(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                    });
                                    // ============================================================== 
                                    // Login and Recover Password 
                                    // ============================================================== 
                                    $('#to-recover').on("click", function () {
                                        $("#loginform").slideUp();
                                        $("#recoverform").fadeIn();
                                    });
        </script>

    </body>

</html>