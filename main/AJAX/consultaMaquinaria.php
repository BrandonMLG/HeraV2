<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$FE = new Modelo();

$contenido = '';
$acu = '';
if (isset($_POST['busqueda'])) {

    $infoMaquina = $FE->buscarMaquinariaID($_POST['busqueda']);

     if ($_POST['busqueda'] === '') {
            $acu = $acu . ' <div id="contenedor_spinner">
            <div id="contenedor_carga">
                            <div id="carga"></div>
                        </div>
                        <div class="text-center mt-2" id="pelota"><H4>Por favor ingresa el <strong>Código de la Maquina</strong> que deseas modificar.</H4></div>
                         </div>
                        ';
        }
    if ($_POST['busqueda'] <> '') {
        if ($infoMaquina["NumeroActivo"] <> "") {
            $histMovimientos = $FE->historialMovMaquinaria($_POST['busqueda']);

            $acu = '<div class="col-lg-12" id="">
                    <div class="row el-element-overlay">
                        <!--                        <div class="col-md-12">
                                                    <h4 class="card-title">Modificación de Maquinaria</h4>
                                                    <h6 class="card-subtitle m-b-20 text-muted">Efectua los cambios que requieras y guardalos presionando <code>accept</code></h6>
                                                </div>-->
                        <div class="col-xl-4  col-md-6">
                            <div class="card">
                                <h3 class="card-title m-l-20 m-t-20"><span class="lstick"></span>' . $infoMaquina["NumeroActivo"] . '</h3>
                                <div class="ribbon ribbon-right ribbon-default m-t-10"><strong>' . $infoMaquina["Marca"] . '</strong></div>
                                <div class="el-card-item m-t-10">
                                    <div class="el-overlay-1"> <img src="' . $BE->verificarFotoMaquina($infoMaquina["NumeroActivo"]) . '" alt="user"/>

                                    </div>
                                    <div class="el-card-content">
                                        <h3 class="box-title">' . $infoMaquina["Maquina"] . '</h3> <small>Modelo: <strong>' . $infoMaquina["Modelo"] . '</strong> </small><small> Serie: <strong>' . $infoMaquina["Serie"] . '</strong></small>
                                        <br/>
                                        <button class="btn-sm ' . $BE->colorEstadoMaquina($infoMaquina["Estado"]) . ' mt-2" type="button"  >' . $infoMaquina["Estado"] . '</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form  method="POST" action="ConsultarMaquinaria.php" class="col-lg-5 col-md-6">
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
                                                   ' . $BE->mostrarUbicacionesMaquinaria() . '
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-5">Modificar Estado:</label>
                                            <div class="col-md-7">
                                                <select class="form-control custom-select"  name="Estado">
                                                    <option value="' . $infoMaquina["Estado"] . '" >' . $infoMaquina["Estado"] . '</option>
                                                    ' . $BE->mostrarEstadosMaquinaria() . '
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
                                    <div class="col-sm-12">';
            $cont = 1;
            foreach ($histMovimientos as $r) {
                $acu = $acu . '   
                                    
                                      <div class="row">
                                            <div class="col-lg-1 text-center">
                                                <h3>' . $cont . '</h3>
                                            </div>
                                            <div class="col-lg-8">
                                                <strong>' . $BE->acortarTexto($r["Ubicacion"], 10) . '</strong>
                                                <br><small><span>' . $BE->fechaMx($r['UltimaActualizacion']) . '</span></small>
                                            </div>
                                            <div class="col-lg-2 text-success align-self-start">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                        </div>
                                        <hr class="m-t-10 m-b-15">';
       
                  if (++$cont == 6) break;
            }
            $acu = $acu . '   </div>
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