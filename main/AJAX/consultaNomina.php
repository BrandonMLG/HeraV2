<?php

include '../../Logica/BackEnd.php';
include '../../Modelo/Modelo.php';

$BE = new BackEnd;
$contenido = '';

if (isset($_POST['busqueda'])) {

    if ($_POST['busqueda'] <> '') {
        $empleado = $BE->consultarEmpleadoNominaCompletaIncidencias($_POST['busqueda'], $_POST['semana']);
        $Existe = $empleado["Semana"];

        if ($Existe <> '') {
            $Numero = $empleado["ID"];
            $Nombre = $empleado["Nombre"];
            $Departamento = $empleado["Departamento"];
            $Nivel = $empleado["Nivel"];
            //*Formato Moneda
            $SueldoBase = $empleado["SueldoBase"];
            $SueldoB = $BE->darFormatoMoneda($SueldoBase);
            //*Formato Moneda
            $BonoProduccionC = $empleado["BonoProduccionC"];
            $BonoProduccionC = $BE->darFormatoMoneda($BonoProduccionC);
            $BonoProduccionCSF = $empleado["BonoProduccionC"];

            $Efi_Lunes = $empleado["Efi_Lunes"];
            $Efi_Martes = $empleado["Efi_Martes"];
            $Efi_Miercoles = $empleado["Efi_Miercoles"];
            $Efi_Jueves = $empleado["Efi_Jueves"];
            $Efi_Viernes = $empleado["Efi_Viernes"];
            //*Formato Moneda
            $Bono_Puntualidad = $empleado["Bono_Puntualidad"];
            $Bono_Puntualidad = $BE->darFormatoMoneda($Bono_Puntualidad);

            $Permiso_Tiempo = $empleado["Permiso_Tiempo"];
            //*Formato Moneda
            $Permiso_Descuento = $empleado["Permiso_Descuento"];
            $Permiso_Descuento = $BE->darFormatoMoneda($Permiso_Descuento);

            //*Formato Moneda
            $Subtotal = $empleado["Subtotal"];
            $Subtotal = $BE->darFormatoMoneda($Subtotal);


            $RebasePiezas = $empleado["RebasePiezas"];
            //*Formato Moneda
            $BonoRebase = $empleado["BonoRebase"];
            $BonoRebase = $BE->darFormatoMoneda($BonoRebase);
            //*Formato Moneda 
            $BonoRendimiento = $empleado["BonoRendimiento"];
            $BonoRendimiento = $BE->darFormatoMoneda($BonoRendimiento);
            //*Formato Moneda
            $Dif = $empleado["Dif"];
            $Dif = $BE->darFormatoMoneda($Dif);
            //*Formato Moneda
            $BonoProduccion = $empleado["BonoProduccion"];
            $BonoProduccion = $BE->darFormatoMoneda($BonoProduccion);
            //*Formato Moneda
            $PagoDiaFestivo = $empleado["PagoDiaFestivo"];
            $PagoDiaFestivo = $BE->darFormatoMoneda($PagoDiaFestivo);
            //*Formato Moneda
            $Descuentos = $empleado["Descuentos"];
            $Descuentos = $BE->darFormatoMoneda($Descuentos);
            //*Formato Moneda
            $PrimaVacacional = $empleado["PrimaVacacional"];
            $PrimaVacacional = $BE->darFormatoMoneda($PrimaVacacional);
            //*Formato
            $PrimaDominical = $empleado["PrimaDominical"];
            $PrimaDominical = $BE->darFormatoMoneda($PrimaDominical);

            $Horas_Dobles = $empleado["Horas_Dobles"];
            $Horas_Sencillas = $empleado["Horas_Sencillas"];
            $Horas_Triples = $empleado["Horas_Triples"];
            //*Formato 
            $Importe = $empleado["Importe"];
            $Importe = $BE->darFormatoMoneda($Importe);
            $HorasLunes = $empleado["lunes"];
            $HorasMartes = $empleado["martes"];
            $HorasMiercoles = $empleado["miercoles"];
            $HorasJueves = $empleado["jueves"];
            $HorasViernes = $empleado["viernes"];
            $HorasSabado = $empleado["sabado"];
            $HorasDomingo = $empleado["domingo"];



            //*Formato Moneda
            $Impo_HorasSencillas = $empleado["Impo_HorasSencillas"];
            $Impo_HorasSencillas = $BE->darFormatoMoneda($Impo_HorasSencillas);
            //*Formato Moneda
            $Impo_HorasDobles = (($SueldoBase / 67.2) * 2) * $Horas_Dobles;
            $Impo_HorasDobles = $BE->darFormatoMoneda($Impo_HorasDobles);
            //*Formato Moneda
            $Impo_HorasTriples = (($SueldoBase / 67.2) * 3) * $Horas_Triples;
            $Impo_HorasTriples = $BE->darFormatoMoneda($Impo_HorasTriples);


            //*Incidencias
            $IncLunes = $empleado["IncLunes"];
            $IncMartes = $empleado["IncMartes"];
            $IncMiercoles = $empleado["IncMiercoles"];
            $IncJueves = $empleado["IncJueves"];
            $IncViernes = $empleado["IncViernes"];

            $DifLun = $BE->bonosEfi($Efi_Lunes, $BonoProduccionCSF, $IncLunes);
            $DifMar = $BE->bonosEfi($Efi_Martes, $BonoProduccionCSF, $IncMartes);
            $DifMie = $BE->bonosEfi($Efi_Miercoles, $BonoProduccionCSF, $IncMiercoles);
            $DifJue = $BE->bonosEfi($Efi_Jueves, $BonoProduccionCSF, $IncJueves);
            $DifVie = $BE->bonosEfi($Efi_Viernes, $BonoProduccionCSF, $IncViernes);



            $contenido = $contenido . '
                     <div class="row p-b-0">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 animated bounceInDown">
                            <div class="card">
                                <div class="card-header text-center">
                                    <i class="fa fa-address-card"></i><strong class="card-title pl-2">Perfil</strong>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        <img class="rounded-circle mx-auto d-block " src="'.$BE->verificarFotoEmpleado($Numero).'" alt="Card image cap">
                                        <h6 class="text-center mb-1 mt-2">'.$Nombre.'</h6>
                                        <div class="text-center"><i class="fa fa-map-marker"></i>'.$Departamento.'</div>
                                    </div>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class=" ti-user h3"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Sueldo:</div></div>
                                                    <div class="row"><div class="col-xl-12"><span class="font-bold">'.$SueldoB.'</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-star h3"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Asistencia:</div></div>
                                                    <div class="row"><div class="col-xl-12"><span class="font-bold">'.$Bono_Puntualidad.'</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center m-t-15">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-flag-alt h3"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Prima Vac:</div></div>
                                                    <div class="row"><div class="col-xl-12"><span class="font-bold">'.$PrimaVacacional.'</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-hand-point-right h3"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Dia Festivo:</div></div>
                                                    <div class="row"><div class="col-xl-12"><span class="font-bold">'.$PagoDiaFestivo.'</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <i class="fa  fa-bookmark"></i><strong class="card-title pl-2">Calculos Extras:</strong>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-primary rounded m-r-20 m-l-40" data-toggle="modal" data-target="#exampleModal">Rebases</button>
                                            <button type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModal2">Tiempo Extra</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12  ">
                            <button type="button" class="font-18 m-t-30 m-b-20 btn btn-rounded btn-block btn-info animated pulse"><span class="pr-2">Importe:</span>'.$Importe.'</button>
                            <div class="card animated bounceInUp">
                                <div class="card-header text-center">
                                    <i class="fa  fa-bar-chart-o"></i><strong class="card-title pl-2">Eficiencia Semanal</strong>
                                </div>
                                <div class="card-body">
                                    <h5 class="">Lunes: ' . $DifLun . '<span class="pull-right">' . $Efi_Lunes . '%</span></h5>
                                    <div class="progress" id="altura6">
                                        <div class="progress-bar bg-info wow animated progress-animated" style="width: '.$Efi_Lunes.'%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div>
                                    <h5 class="m-t-30">Martes: '.$DifMar.'<span class="pull-right">'.$Efi_Martes.'%</span></h5>
                                    <div class="progress" id="altura6">
                                        <div class="progress-bar bg-info wow animated progress-animated" style="width:'.$Efi_Martes.'%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div>
                                    <h5 class="m-t-30">Miercoles: '.$DifMie.'<span class="pull-right">'.$Efi_Miercoles.'%</span></h5>
                                    <div class="progress" id="altura6">
                                        <div class="progress-bar bg-info wow animated progress-animated" style="width: '.$Efi_Miercoles.'%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div>
                                    <h5 class="m-t-30">Jueves: '.$DifJue.'<span class="pull-right">'.$Efi_Jueves.'%</span></h5>
                                    <div class="progress" id="altura6">
                                        <div class="progress-bar bg-info wow animated progress-animated" style="width: '.$Efi_Jueves.'%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div>
                                    <h5 class="m-t-30">Viernes: '.$DifVie.'<span class="pull-right">'.$Efi_Viernes.'%</span></h5>
                                    <div class="progress" id="altura6">
                                        <div class="progress-bar bg-info wow animated progress-animated" style="width:'.$Efi_Viernes.'%; height:6px;" role="progressbar"> <span class="sr-only">60% Complete</span> </div>
                                    </div>
                                    <hr>
                                    <div class="row text-center m-t-15">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-crown h2"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Prima Dom:</div></div>
                                                    <div class="row"><div class="col-xl-12 h5"><span class="font-bold">' . $PrimaDominical . '</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-stats-up h2"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Rebase:</div></div>
                                                    <div class="row"><div class="col-xl-12 h5"><span class="font-bold">'.$BonoRebase.'</span></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 animated bounceInRight">
                            <div class="card">
                                <div class="card-header text-center">
                                    <i class="fa   fa-fire"></i><strong class="card-title pl-2">Tiempo Extra</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center m-t-15">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-alarm-clock text-info h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row text-center"><div class="col-xl-12">Dobles: <span class="label label-rounded label-success pull-right">'.$Horas_Dobles.'</span></div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="font-bold">'.$Impo_HorasDobles.'</span></h4></div></div></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-alarm-clock text-info h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row text-center"><div class="col-xl-12">Triples: <span class="label label-rounded label-success pull-right">'.$Horas_Triples.'</span></div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="font-bold">'.$Impo_HorasTriples.'</span></h4></div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-12">
                                            <p class="text-center">
                                                <span class="font-bold">Lun: </span>'.$HorasLunes.'
                                                <span class="font-bold">Mar: </span>'.$HorasMartes.'
                                                <span class="font-bold">Mie: </span>'.$HorasMiercoles.'
                                                <span class="font-bold">Jue: </span>'.$HorasJueves.'<br>
                                                <span class="font-bold">Vie: </span>'.$HorasViernes.'
                                                <span class="font-bold">Sab: </span>'.$HorasSabado.'
                                                <span class="font-bold">Dom: </span>'.$HorasDomingo.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-center">
                                    <i class="fa   fa-info"></i><strong class="card-title pl-2">Percepciones</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center m-t-10">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-flag-alt-2 text-warning h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Bono Pro:</div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="">'.$BonoProduccion.'</span></h4></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                             <div class="row">
                                                <div class="col-xl-3"><i class="ti-stats-down text-danger h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Descuentos</div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="">'.$Descuentos.'</span></h4></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center m-t-15">
                                        <div class="col-xl-6">
                                            <div class="row">
                                                <div class="col-xl-3"><i class="ti-bolt text-megna h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Comple:</div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="">'.$BonoRendimiento.'</span></h4></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                             <div class="row">
                                                <div class="col-xl-3"><i class="ti-share text-info h1"></i></div>
                                                <div class="col-xl-9">
                                                    <div class="row"><div class="col-xl-12">Diferencia:</div></div>
                                                    <div class="row"><div class="col-xl-12"><h4><span class="">'.$Dif.'</span></h4></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Calculo de Rebases</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form name="form1">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Piezas:</label>
                                            <input type="text" class="form-control" id="piezas" name="piezas" onkeyup="Calculo(' . $SueldoBase . ');">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Tarea:</label>
                                            <textarea class="form-control" name="tarea" onkeyup="Calculo(' . $SueldoBase . ');"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Importe:</label>
                                            <textarea class="form-control" name="importe"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onClick="limpiarRebase();">Clean</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Calculo de Tiempo Extra</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form name="form2">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Horas Dobles:</label>
                                            <input type="text" class="form-control" id="numeroDobles" name="numeroDobles" onkeyup="CalculoTiempoExtraDobles(' . $SueldoBase . ')">
                                            <input type="text" class="form-control mt-3" name="pagoDobles" value="$0.00">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Horas Triples:</label>
                                            <input type="text" class="form-control" id="recipient-name1" name="numeroTriples" onkeyup="CalculoTiempoExtraTriples(' . $SueldoBase . ');">
                                            <input type="text" class="form-control mt-3" name="pagoTriples" value="$0.00">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onClick="limpiarTiempoExtra();">Clean</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {
            $contenido = '<div id="">
                    <div id="contenedor_carga">
                        <div id="carga"></div>
                    </div>
                    <div class="text-center mt-2" id="pelota"><H4>No se encontraron coincidencias con sus criterios de búsqueda.</H4></div>
                </div>';
        }
    }else{
         $contenido = '';
    }
}
    echo $contenido;
?>