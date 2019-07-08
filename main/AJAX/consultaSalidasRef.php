<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$FE = new Modelo();

$contenido = '';

$acu = '';


if (isset($_POST['busqueda'])) {



    if ($_POST['busqueda'] === '') {
        $acu = $acu . ' <div id="contenedor_spinner">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Código de la Maquina</strong> que deseas modificar.</H4></div>
                         </div>
                        ';
    }
    if ($_POST['busqueda'] <> '' && $_POST['busqueda'] <> 'select') {

        $r = $FE->buscarRefaccion($_POST['busqueda']);
        if ($r["ID_Refaccion"] <> "") {
            $acu = '<div class="row">
                        <div class="col-12">
                            <div class="col-lg-12" id="MaquinaID">
                                <div class="row el-element-overlay">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <h3 class="card-title m-l-20 m-t-20 font-weight-bold"><span class="lstick"></span>' . $r["estante"] . '</h3>
                                            <div class="ribbon ribbon-right ribbon-default m-t-10"><strong>Clave: ' . $r["clave"] . '</strong></div>
                                            <div class="el-card-item m-t-10">
                                                <div class="el-card-content">
                                                    <h4 class="box-title">' . $r["descripcion"] . '</h4>
                                                    <div class="col-12">
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold">Maquina:</div>
                                                            <div class="col-6">' . $r["maquina"] . '</div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold ">Marca:</div>
                                                            <div class="col-6">' . $r["marca"] . '</div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-6 font-weight-bold">Modelo:</div>
                                                            <div class="col-6">' . $r["modelo"] . '</div>
                                                        </div>
                                                        <div class="row mt-4">
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
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <span class="font-weight-bold h6">Disponibles: </span><button class="btn-sm '.$BE->verificarStock($r["stock"]).' mt-2 animated" type="button" id="disponible" ><span class="h5">' . $r["stock"] . '</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form  method="POST" action="SalidasRef.php" class="col-lg-5 col-md-6" >
                                        <div class="card">
                                            `     <h3 class="card-title m-l-20">
                                                <span class="lstick"></span>Información:
                                            </h3>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-sm-12">
                                                                <div class="row" id="rowCantidad">
                                                                    <label class="control-label  col-sm-12 text-center font-medium">Cantidad:</label>
                                                                    <input type="text" autocomplete="off" class="col-sm-12  form-control text-center font-weight-bold m-r-10" name="cantidad" id="cantidad" onkeyup="validarCantidad('.$r["stock"].');">
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
                                                                    <label class="control-label  col-sm-12 text-center font-medium">Línea:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center m-r-10" name="linea" id="linea" autocomplete="on" >
                                                                </div>  
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label col-sm-12 text-center font-medium">Área:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center m-l-10" name="area" id="area" autocomplete="on" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-t-20">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label  col-sm-12 text-center font-medium">Nombre:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center m-r-10" name="nombre" id="nombre" autocomplete="on">
                                                                </div>  
                                                            </div>
                                                            <div class="col-lg-4 col-sm-12">
                                                                <div class="row">
                                                                    <label class="control-label col-sm-12 text-center font-medium">Folio:</label>
                                                                    <input type="text" class="col-sm-12  form-control text-center m-l-10" name="folio_salida" id="folio_salida" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-t-20">
                                                        <div class="row">
                                                            <div class="col-lg-5 col-sm-12 m-r-10">
                                                                <div class="row">
                                                                    <label class="text-center col-sm-12 font-medium"><span class="font-weight-bold">#</span> Maquina:</label>
                                                                    <input name="numeroMaquina" type="text" class="form-control text-center col-12  p-0 m-0" id="numeroMaquina" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 m-l-5">
                                                                <div class="row">
                                                                    <label class="text-center col-sm-12 font-medium">Precio Uni:</label>
                                                                    <input name="precio_unitario" type="text" class="form-control text-center col-12  p-0 m-0" id="precio_unitario"  autocomplete="off">
                                                                </div>
                                                            </div>                                                      
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-actions">
                                                        <div class="row m-t-20">
                                                            <div class="offset-lg-4 offset-sm-7 m-b-20">
                                                                <button type="submit" class="btn btn-info" id="guardar" '.$BE->deshabilitarBoton($r["stock"]) .'> <i class="fa fa-check"></i> Guardar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" value="0.00" id="total" name="total" class="hide">
                                                <input type="text" value="'.$r['ID_Refaccion'].'" id="ID_Refaccion" name="ID_Refaccion" class="hide">
                                            </div>
                                        </div>
                                    </form>

                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><span class="lstick"></span>Historial de Movimientos:</h5>
                   
                                                ' . $BE->MostrarSalidasRefacciones($r["ID_Refaccion"]) . ' 
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {
            $acu = $acu . ' <div id="contenedor_spinner">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>No se encontraron coincidencias con sus criterios de búsqueda..</H4></div>
                         </div>
                        ';
        }
    }
}

echo $acu;
?>