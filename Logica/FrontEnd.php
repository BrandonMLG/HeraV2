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
class FrontEnd {

    private $modelo;

    public function __construct() {
        $this->modelo = new Modelo();
    }

    
    public function procesarFormulario(){
        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"])){
            if($this->modelo->insertarComentario($_POST["name"], $_POST["email"],$_POST["phone"],$_POST["comentario"])){
                return $this->mensaje("Gracias por tu Comentario");
            }else{
                return $this->mensaje("Error en el sistema");
            }
        }
    }
    
    public function marcasAlmacen() {
        $registros = $this->modelo->consultaProducto2s(4);
        $acu = "";
        foreach ($registros as $r) {
            $acu = $acu . '<div class="col-3"><a href=""><img src="' . $r["Imagen"] . '" alt="" class="col-sm-auto col-md-auto col-lg-auto"></a></div>';
        }
        return $acu;
    }
    

    public function productosAlmacen() {
        $registros = $this->modelo->consultaProductos(3);
        $acu = "";
        foreach ($registros as $r) {
            $acu = $acu . '<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="">
                        <P class="w-100"><strong>' . $this->acortarTexto($r["Nombre"],100)  . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <a href="producto.php?ide=' . $r["ID_Producto"] . '"><p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
        }
        return $acu;
    }

    public function productosAlmacen2() {
        $registros = $this->modelo->consultaProductos2(12);
        $acu = "";
        foreach ($registros as $r) {
            $acu = $acu . '<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="">
                        <P class="w-100"><strong>' . $r["Nombre"] . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <a href="productosninas.php?ide=' . $r["ID_Producto2"] . '"><p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
        }
        return $acu;
    }

    public function productosAlmacen3() {
        $registros = $this->modelo->consultaProductos3(12);
        $acu = "";
        foreach ($registros as $r) {
            $acu = $acu . '<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="">
                        <P class="w-100"><strong>' . $r["Nombre"] . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <a href="productosninos.php?ide=' . $r["ID_Producto2"] . '"><p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
        }
        return $acu;
    }

    public function productoIndividual($ide) {
        $r = $this->modelo->obtenerProducto($ide);
        return'<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="" >
                        <P class="w-100"><strong>' . $r["Nombre"] . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                       <a href="producto.php"> <p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
    }

    public function productoIndividual2($ide) {
        $r = $this->modelo->obtenerProducto2($ide);
        return'<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="">
                        <P class="w-100"><strong>' . $r["Nombre"] . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                       <a href="producto.php"> <p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
    }

    public function productoIndividual3($ide) {
        $r = $this->modelo->obtenerProducto3($ide);
        return'<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="' . $r["Imagen"] . '" alt="">
                        <P class="w-100"><strong>' . $r["Nombre"] . '</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                       <a href="producto.php"> <p class="text-danger"><strong> $' . $r["Precio"] . '</strong></p></a>
                    </div>';
    }

    public function menu() {

        return '<ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost:443/proyectos/MyPaginaWeb/index.php#">NEW <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost:443/proyectos/MyPaginaWeb/marcas.php">BRAND</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link " href="http://localhost:443/proyectos/MyPaginaWeb/ninas.php">NIÑAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="http://localhost:443/proyectos/MyPaginaWeb/ninos.php">NIÑOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">SALE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">MATTEL VAULT</a>
                        </li>
                    </ul>';
    }

    public function slider() {
        return '<div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="imagenes/slider1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="imagenes/slider2.jpg" alt="Second slide">
                        </div>

                    </div>';
    }

    public function marcas() {
        return '<div class="row">
                    <div class="col-3"><a href=""><img src="imagenes/1.png" alt="" class="col-sm-auto col-md-auto col-lg-auto"></a></div>
                    <div class="col-3"><a href=""><img src="imagenes/2.png" alt="" class="col-sm-auto col-md-auto col-lg-auto"></a></div>
                    <div class="col-3"><a href=""><img src="imagenes/3.png" alt="" class="col-sm-auto col-md-auto col-lg-auto"></a></div>
                    <div class="col-3"><a href=""><img src="imagenes/4.jpg" alt="" class="col-sm-auto col-md-auto col-lg-auto"></a></div>


                </div>';
    }

    public function imagenes() {
        return '<img class="col-md-auto "src="imagenes/Imagen3.jpg" alt=""  width="100px" >
                <img class=" col-md-auto " src="imagenes/mattelvaultdesktop.jpg" alt="">';
    }

    public function productos() {
        return '<div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="imagenes/producto1.jpg" alt="">
                        <P class="w-100"><strong>Jurassic World Super Colossal Tyrannosaurus Rex</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <p class="text-danger"><strong> $54.99</strong></p>
                    </div>
                    <div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="imagenes/producto2.jpg" alt="">
                        <P class="w-100"><strong>Jurassic World Chomp n Roar Mask Velociraptor "Blue"</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <p class="text-danger"><strong> $34.99</strong></p>
                    </div>
                    <div class="card text-center p-3 ml-5 col-sm-auto col-md-auto col-lg-auto" style=" width: 18rem;"  ><img src="imagenes/producto3.jpg" alt="">
                        <P class="w-100"><strong>Jurassic World Thrash n Throw Tyrannosaurus Rex™ Figure</strong></P>
                        <p><span class="text-success"><strong>IN STOCK</strong></span> </p>
                        <p class="text-danger"><strong>$39.99</strong></p>
                    </div>';
    }

    public function footer() {
        return '<div class="container">
                    <div class="row ">
                        <div class="col-12">
                            <p class="text-center small">Home for Mattel Toys & More | Use of this site signifies your acceptance of the terms and conditions of use. ©2018 Mattel All Rights Reserved.</p>
                            <h4 class="text-center pb-4"><strong>THE MATTEL FAMILY OF BRANDS</strong></h4>
                        </div>
                    </div>
                </div>

                <div class="container"> 
                     <div class="row">
                            <div class="col-2 "><a href=""><img src="imagenes/fd1.png" alt="" class=""></a></div>
                            <div class="col-2 "><a href=""><img src="imagenes/fd2.png" alt="" class=""></a></div>
                            <div class="col-2 "><a href=""><img src="imagenes/fd3.png" alt="" class=""></a></div>
                            <div class="col-2 "><a href=""><img src="imagenes/fd7.png" alt="" class=""></a></div>
                            <div class="col-2 "><a href=""><img src="imagenes/fd5.png" alt="" class=""></a></div>
                            <div class=" col-2 "><a href=""><img src="imagenes/fd6.png" alt="" class=""></a></div>
                        </div>
                </div>';
    }
    
    
      public function acortarTexto($texto,$tamano) {
        return substr($texto, 0, $tamano).'...';
    }
    
    public function mensaje($msj) {
        
        return "<script>alert('.$msj.')</script>";
    }
   
}
