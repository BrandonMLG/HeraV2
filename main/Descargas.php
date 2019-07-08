



<?php
session_start();
include '../Logica/BackEnd.php';
include '../Modelo/Modelo.php';
$BE = new BackEnd();


//if (isset($_GET["check"])) {
//    $arreglo = $_GET["check"];
//}
//if (isset($arreglo)) {
//    $num = count($arreglo);
//    for ($i = 0; $i < $num; $i++) {
//        
//        $ID_Mtto = $arreglo[$i];
//        echo 'iDM'.$ID_Mtto;
//        if (file_exists("../fpdf181/documentos/MP-" . $ID_Mtto . ".pdf")) {
//            header("Content-disposition: attachment; filename=MP-" . $ID_Mtto . ".pdf");
//            header("Content-type: application/zip");
//            readfile("../fpdf181/documentos/MP-" . $ID_Mtto . ".pdf");
//        }
//    else {
//
////   $BE->redireccionar('ReportesMP.php');
//        echo "<script type=\"text/javascript\">alert(\"No se encontro el archivo: MP-" . $ID_mtto . "\");</script>";
//    }
//    }
//}
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
        <title>Descargas</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            function realizaProceso(ID_Mtto) {
                var req = new XMLHttpRequest(ID_Mtto);
                req.open("GET", "../fpdf181/documentos/MP-" + ID_Mtto + ".pdf", true);
                req.responseType = "blob";

                req.onload = function (event) {
                    var blob = req.response;
                    console.log(blob.size);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "MP-" + ID_Mtto + ".pdf";
                    link.click();
                };
                req.send();
            }

            function mttos() {
                var arreglo = <?php echo json_encode($_GET["check"]); ?>;
                var a = arreglo.length;
                for (var i = 0; i < a; i++) {
                    realizaProceso(arreglo[i]);
                }
                 location.href ="ReportesMP.php";
            }
        </script>
    </head>

    <body class="fix-header card-no-border fix-sidebar" onload="mttos()">
        <?php echo $_GET["check"][0] ?>
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
    </body> 
</html>