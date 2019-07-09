<?php

class Modelo {

    private $user = 'root';
    private $password = '';
    private $bd = 'Hera';
    protected $conexion;

    function __construct() {
        $this->conexion = new PDO('mysql:host=localhost;dbname=' . $this->bd, $this->user, $this->password);
        $this->conexion->exec('set character set UTF8');
    }

    public function cerrarConexion() {
        $this->conexion = null;
    }

    public function tablaEmpleados() {

        $sentencia = $this->conexion->query('SELECT * from NominaCompleta  ORDER BY CAST(ID as int)');

        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function paginaInicio($Departamento) {
        $sentencia = $this->conexion->query('SELECT pageMain from pagesMain where Departamento ="' . $Departamento . '"');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $empleado) {
            return $empleado;
        }
    }

    /* function  probar(){

      foreach($this->conexion->query('select clave,nombre,apellido from  alumnos') as $fila) {
      print_r($fila);
      }
      }

      function consultaPreparada(){
      $valor='HOLA';
      $sentencia = $this->conexion->query('select clave,nombre,apellido from  alumnos where clave>?');
      $sentencia->bindParam(1, $valor);
      $sentencia->execute();
      $reg = $sentencia ->fetchAll(PDO::FETCH_ASSOC);
      foreach ($reg as $fila ){
      echo ($fila ['nombre'].'<hr>');
      }

      }
     */
    /* public function UltimoEmpleado() {
      $sentencia = $this->conexion->query(' Select max(ID) from empleado' );

      $sentencia->execute();
      $valor = (string) $sentencia;

      return $valor;
      } */

    public function Reporte() {
        new PHPExcel();
    }

    public function UltimoEmpleado() {
        $sentencia = $this->conexion->query('SELECT ID FROM EMPLEADO ORDER BY ID DESC LIMIT 1');

        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function numEmpleadosUltimaSemana() {
        $sentencia = $this->conexion->query('select semana,count(*) as numero from nominacompleta group by semana order by semana desc limit 1');

        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $num) {
            return $num;
        }
    }

    public function numMaquinas($estado,$ubicacion) {
        $sentencia = $this->conexion->query('select count(*) as numero from maquinaria WHERE estado like "%' . $estado . '%" AND ubicacion like "%'.$ubicacion.'%"');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $num) {
            return $num;
        }
    }

    public function numMP() {
        $sentencia = $this->conexion->query('select count(*) as numero from mtto_preventivo');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $num) {
            return $num;
        }
    }

    public function numMP2($busqueda, $criterio) {

        if ($criterio == 'Maquina') {
            $sentencia = $this->conexion->query('SELECT COUNT(*)as numero FROM mtto_preventivo WHERE ID_Maquina ="' . $busqueda . '"');
            $sentencia->execute();
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $num) {
                return $num;
            }
        } else {
            $sentencia = $this->conexion->query('SELECT COUNT(*) as numero FROM mtto_preventivo WHERE ID_Usuario = (Select ID from Usuario WHERE usuario like "%' . $busqueda . '%" limit 1)');
            $sentencia->execute();
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $num) {
                return $num;
            }
        }
    }

    public function consultarEmpleadoNominaCompleta($ID) {
        $ID = (int) $ID;
        $sentencia = $this->conexion->query('SELECT * FROM NominaCompleta inner join tiempoExtra
                on nominaCompleta.ID=tiempoExtra.id WHERE 
		nominaCompleta.ID =' . $ID . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $empleado) {
            return $empleado;
        }
    }

    public function consultarEmpleadoNominaCompletaIncidencias($ID, $Semana) {
        $ID = (int) $ID;
        $Semana = (int) $Semana;
        $sentencia = $this->conexion->query('SELECT * FROM NominaCompleta inner join tiempoExtra
                on nominaCompleta.ID=tiempoExtra.id WHERE 
		nominaCompleta.ID =' . $ID . ' AND nominaCompleta.Semana =' . $Semana . ' AND tiempoextra.Semana =' . $Semana . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $empleado) {
            return $empleado;
        }
    }

    public function returnUltimaSemana() {

        $sentencia = $this->conexion->query('SELECT max(semana) as Semana FROM NominaCompleta');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $semana) {
            return $semana;
        }
    }

    public function returnSemanasNomina() {

        $sentencia = $this->conexion->query('SELECT Semana FROM nominacompleta GROUP BY Semana ORDER BY Semana DESC');
        $sentencia->execute();
        return $sentencia;
    }

    public function consultarMaquinaria($ID) {

        $sentencia = $this->conexion->query('SELECT * FROM Maquinaria WHERE 
		NumeroActivo  Like "' . $ID . '"');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $maquinaria) {
            return $maquinaria;
        }
    }

    public function buscarMaquinaria($busqueda, $criterio, $estado, $ubicacion) {
        $sentencia = $this->conexion->query('SELECT * FROM Maquinaria WHERE 
		' . $criterio . ' = "' . $busqueda . '" AND estado LIKE "%' . $estado . '%" AND ubicacion LIKE "%'.$ubicacion.'%" ORDER BY Modelo, Estado');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarMtto_Pre($ID_Mtto) {
        $sentencia = $this->conexion->query('SELECT * FROM mtto_preventivo WHERE ID_Mtto=' . $ID_Mtto . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $info) {
            return $info;
        }
    }

    public function buscarUserMtto_Pre($ID_Mtto) {
        $sentencia = $this->conexion->query('Select * from usuario inner join mtto_preventivo on usuario.ID = mtto_preventivo.ID_Usuario where mtto_preventivo.ID_Mtto = ' . $ID_Mtto . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $info) {
            return $info;
        }
    }

    public function buscarModulosMtto_Pre($ID_Mtto) {
        $sentencia = $this->conexion->query('Select modulo_checklist.* from mtto_preventivo  '
                . 'inner join mtto_checklist on mtto_preventivo.ID_Mtto = mtto_checklist.ID_Mtto  '
                . 'inner join actividad_checklist on mtto_checklist.ID_Actividad = actividad_checklist.ID_Actividad '
                . 'inner join modulo_checklist on actividad_checklist.ID_Modulo = modulo_checklist.ID_Modulo '
                . 'where mtto_preventivo.ID_Mtto =' . $ID_Mtto . ' GROUP BY modulo_checklist.modulo');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarActividadesMtto_Pre($ID_Mtto, $ID_Modulo) {
        $sentencia = $this->conexion->query('Select mtto_checklist.ID_Actividad as "ID_Actividad",
                                                    mtto_checklist.status as "status", 
                                                    mtto_checklist.comentario as "comentario", 
                                                     actividad_checklist.actividad as "actividad" from mtto_preventivo  inner join mtto_checklist 
                                                    on mtto_preventivo.ID_Mtto = mtto_checklist.ID_Mtto 
                                                     inner join actividad_checklist on mtto_checklist.ID_Actividad = actividad_checklist.ID_Actividad 
                                                     inner join modulo_checklist on actividad_checklist.ID_Modulo = modulo_checklist.ID_Modulo 
                                                     where mtto_preventivo.ID_Mtto = ' . $ID_Mtto . ' AND modulo_checklist.ID_Modulo = ' . $ID_Modulo . '');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarMaquinaMtto_Pre($ID_Mtto) {
        $sentencia = $this->conexion->query('Select * from maquinaria where NumeroActivo=(Select ID_Maquina from mtto_preventivo WHERE ID_Mtto=' . $ID_Mtto . ')');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $maquinaria) {
            return $maquinaria;
        }
    }

    public function buscarURL($ID_Usuario, $url) {
        $sentencia = $this->conexion->query('Select interfaz.nombre, interfaz.url  FROM usuario INNER JOIN  perfil_usuario ON
                                                usuario.ID = perfil_usuario.ID_Usuario 
                                                INNER JOIN perfil ON perfil_usuario.ID_Perfil = perfil.ID_Perfil
                                                INNER JOIN perfil_interfaz ON perfil.ID_Perfil = perfil_interfaz.ID_Perfil
                                                INNER JOIN interfaz ON perfil_interfaz.ID_Interfaz = interfaz.ID_Interfaz
                                                WHERE usuario.ID =' . $ID_Usuario . ' and interfaz.url = "' . $url . '"');

        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarMaquinariaID($ID) {
        $sentencia = $this->conexion->query('SELECT * FROM Maquinaria WHERE 
		NumeroActivo = "' . $ID . '"');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $maquinaria) {
            return $maquinaria;
        }
    }

    public function buscarRefaccion($ID_Refaccion) {
        $sentencia = $this->conexion->query('SELECT * FROM refaccion WHERE 
		ID_Refaccion = ' . $ID_Refaccion . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $maquinaria) {
            return $maquinaria;
        }
    }

    public function historialMovMaquinaria($ID) {
        $sentencia = $this->conexion->query('SELECT * FROM RotacionMaquinaria WHERE NumeroActivo = "' . $ID . '" ORDER BY UltimaActualizacion DESC');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modulosUsuario() {
        $sentencia = $this->conexion->query('SELECT * FROM modulo');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function interfazUsuario($modulo) {
        $sentencia = $this->conexion->query('SELECT * FROM interfaz WHERE ID_Modulo =(SELECT ID_Modulo FROM modulo WHERE modulo = "' . $modulo . '")');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function interfazPerfil($ID_Perfil, $ID_Interfaz) {
        $sentencia = $this->conexion->query('SELECT * FROM interfaz INNER JOIN perfil_interfaz ON interfaz.ID_Interfaz = perfil_interfaz.ID_Interfaz'
                . ' WHERE perfil_interfaz.ID_Perfil =' . $ID_Perfil . ' AND interfaz.ID_Interfaz = ' . $ID_Interfaz . '');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function numCoincidenciasbuscarMaquinaria($busqueda, $criterio, $estado,$ubicacion) {
        $sentencia = $this->conexion->query('SELECT COUNT(*) as Num FROM Maquinaria WHERE ' . $criterio . ' = "' . $busqueda . '" AND estado LIKE "%' . $estado . '%" AND ubicacion LIKE "%'.$ubicacion.'%"');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
            return $numero;
        }
    }

    public function numMaquina() {
        $sentencia = $this->conexion->query('SELECT COUNT(*) as numero FROM Maquinaria');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
            return $numero;
        }
    }

    public function numRefacciones() {
        $sentencia = $this->conexion->query('SELECT COUNT(*) as Num FROM refaccion');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
            return $numero;
        }
    }

    public function numRefaccionesEncontradas($criterioBusqueda, $filtro, $estado) {
        if ($estado <> 0) {
            $sentencia = $this->conexion->query('SELECT COUNT(*) as Num FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%" and ID_Estado = ' . $estado . '');
            $sentencia->execute();
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
                return $numero;
            }
        } else {
            $sentencia = $this->conexion->query('SELECT COUNT(*) as Num FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%"');
            $sentencia->execute();
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
                return $numero;
            }
        }
    }
    
    
     public function numRefaccionesEncontradasMec($criterioBusqueda, $filtro) {
            $sentencia = $this->conexion->query('SELECT COUNT(*) as Num FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%"');
            $sentencia->execute();
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $numero) {
                return $numero;
        }
    }

    public function ingresarNuevoEmpleado($Nombre, $Nivel, $SueldoBase, $SueldoTarea, $Departamento, $Seccion, $Puesto, $Operacion, $CURP, $Telefono, $TelefonoEmergecia, $ID_Supervisor) {
        $Nivel = (int) $Nivel;
        $SueldoBase = (int) $SueldoBase;
        $SueldoTarea = (int) $SueldoTarea;
        $ID_Supervisor = (int) $ID_Supervisor;
        $sentencia = $this->conexion->prepare('call CrearEmpleado (? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)');
        $sentencia->bindParam(1, $Nombre);
        $sentencia->bindParam(2, $Nivel);
        $sentencia->bindParam(3, $SueldoBase);
        $sentencia->bindParam(4, $SueldoTarea);
        $sentencia->bindParam(5, $Departamento);
        $sentencia->bindParam(6, $Seccion);
        $sentencia->bindParam(7, $Puesto);
        $sentencia->bindParam(8, $Operacion);
        $sentencia->bindParam(9, $CURP);
        $sentencia->bindParam(10, $Telefono);
        $sentencia->bindParam(11, $TelefonoEmergecia);
        $sentencia->bindParam(12, $ID_Supervisor);
        return $sentencia->execute();
    }

    public function actualizarEmpleado($ID, $Nombre, $Nivel, $SueldoBase, $SueldoTarea, $Departamento, $Seccion, $Puesto, $Operacion, $Sexo, $ID_Supervisor) {
        $ID = (int) $ID;
        $Nivel = (int) $Nivel;
        $SueldoBase = (int) $SueldoBase;
        $SueldoTarea = (int) $SueldoTarea;
        $ID_Supervisor = (int) $ID_Supervisor;
        $sentencia = $this->conexion->prepare('call actualizarEmpleado (? ,? , ? , ? , ? , ? , ? , ? , ? , ? , ?)');
        $sentencia->bindParam(1, $ID);
        $sentencia->bindParam(2, $Nombre);
        $sentencia->bindParam(3, $Nivel);
        $sentencia->bindParam(4, $SueldoBase);
        $sentencia->bindParam(5, $SueldoTarea);
        $sentencia->bindParam(6, $Departamento);
        $sentencia->bindParam(7, $Seccion);
        $sentencia->bindParam(8, $Puesto);
        $sentencia->bindParam(9, $Operacion);
        $sentencia->bindParam(10, $Sexo);
        $sentencia->bindParam(11, $ID_Supervisor);
        return $sentencia->execute();
    }

    public function actualizarMaquinaria($Orden, $Maquina, $Marca, $Modelo, $Serie, $Ubicacion, $Estado, $Comentario, $Propietario, $ID) {
        $ID = (int) $ID;
        $sentencia = $this->conexion->prepare('call actualizarMaquinaria (? , ? , ? , ? , ? , ? , ? , ? , ?,? )');
        $sentencia->bindParam(1, $Orden);
        $sentencia->bindParam(2, $Maquina);
        $sentencia->bindParam(3, $Marca);
        $sentencia->bindParam(4, $Modelo);
        $sentencia->bindParam(5, $Serie);
        $sentencia->bindParam(6, $Ubicacion);
//         $sentencia->bindParm(6, $UltimaActualizacion);
        $sentencia->bindParam(7, $Comentario);
        $sentencia->bindParam(8, $Estado);
        $sentencia->bindParam(9, $Propietario);
        $sentencia->bindParam(10, $ID);
        return $sentencia->execute();
    }

    public function registrarUsuario($Usuario, $Departamento, $Seccion, $Password, $Privilegios) {
        $sentencia = $this->conexion->prepare('CALL registrar_Usuario (?, ?, ?, ?, ?)');
        $sentencia->bindParam(1, $Usuario);
        $sentencia->bindParam(2, $Departamento);
        $sentencia->bindParam(3, $Seccion);
        $sentencia->bindParam(4, $Password);
        $sentencia->bindParam(5, $Privilegios);
        return $sentencia->execute();
    }

    public function registrarSalida($ID_Refaccion, $cantidad, $unidad_medida, $linea, $area, $nombre, $numeroMaquina, $folio_salida, $precio_unitario, $costo_total) {
        $ID_Refaccion = (int) $ID_Refaccion;
        $cantidad = (int) $cantidad;
        $precio_unitario = floatval($precio_unitario);
        $costo_total = floatval($costo_total);

        $sentencia = $this->conexion->prepare("CALL insert_Salida_Refaccion (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $sentencia->bindParam(1, $ID_Refaccion);
        $sentencia->bindParam(2, $cantidad);
        $sentencia->bindParam(3, $unidad_medida);
        $sentencia->bindParam(4, $linea);
        $sentencia->bindParam(5, $area);
        $sentencia->bindParam(6, $nombre);
        $sentencia->bindParam(7, $numeroMaquina);
        $sentencia->bindParam(8, $folio_salida);
        $sentencia->bindParam(9, $precio_unitario);
        $sentencia->bindParam(10, $costo_total);
        return $sentencia->execute();
    }

    public function registrarModulo($modulo, $icon) {
        $sentencia = $this->conexion->prepare("INSERT INTO modulo (modulo, icon) VALUES (?, ?);");
        $sentencia->bindParam(1, $modulo);
        $sentencia->bindParam(2, $icon);
        return $sentencia->execute();
    }

    public function mostrarModulos() {
        $sentencia = $this->conexion->prepare("SELECT * FROM modulo");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarModulosChecklist() {
        $sentencia = $this->conexion->prepare("SELECT * FROM modulo_checklist WHERE activo =1");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarActividadesChecklist($ID_Modulo) {
        $sentencia = $this->conexion->prepare("select * from actividad_checklist where ID_Modulo = " . $ID_Modulo . " AND activo = 1");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarActividadesChecklist2() {
        $sentencia = $this->conexion->prepare("select * from actividad_checklist WHERE activo = 1");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarPerfiles() {
        $sentencia = $this->conexion->prepare("SELECT * FROM perfil");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarUsuarios() {
        $sentencia = $this->conexion->prepare("SELECT * FROM usuario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarInterfaz($nombre, $url, $ID_Modulo) {
        $sentencia = $this->conexion->prepare("INSERT INTO interfaz(nombre,url,ID_Modulo) VALUES(?, ?, ?);");
        $sentencia->bindParam(1, $nombre);
        $sentencia->bindParam(2, $url);
        $sentencia->bindParam(3, $ID_Modulo);
        return $sentencia->execute();
    }

    public function registrarPerfil($perfil) {
        $sentencia = $this->conexion->prepare("INSERT INTO perfil (perfil) VALUES(?);");
        $sentencia->bindParam(1, $perfil);
        return $sentencia->execute();
    }

    public function registrarPerfil_Interfaz($ID_Perfil, $ID_Interfaz) {
        $sentencia = $this->conexion->prepare("INSERT INTO perfil_interfaz (ID_Perfil, ID_Interfaz) VALUES (?,?);");
        $sentencia->bindParam(1, $ID_Perfil);
        $sentencia->bindParam(2, $ID_Interfaz);
        return $sentencia->execute();
    }

    public function elimiterAll_Perfil_Interfaz($ID_Perfil) {
        $sentencia = $this->conexion->prepare("DELETE FROM perfil_interfaz WHERE ID_Perfil = ?");
        $sentencia->bindParam(1, $ID_Perfil);
        return $sentencia->execute();
    }

    public function registrarPerfil_Usuario($ID_Perfil, $ID_Usuario) {
        $sentencia = $this->conexion->prepare("INSERT INTO perfil_usuario (ID_Perfil,ID_Usuario) VALUES (?,?);");
        $sentencia->bindParam(1, $ID_Perfil);
        $sentencia->bindParam(2, $ID_Usuario);
        return $sentencia->execute();
    }

    public function registrarModulo_ChecklistMP($modulo, $descripcion) {
        $sentencia = $this->conexion->prepare("INSERT INTO modulo_checklist(modulo,descripcion) VALUES(UPPER(?),?)");
        $sentencia->bindParam(1, $modulo);
        $sentencia->bindParam(2, $descripcion);
        return $sentencia->execute();
    }

    Public function actualizarModulo_ChecklistMP($ID_Modulo, $modulo, $descripcion) {
        $sentencia = $this->conexion->prepare('UPDATE modulo_checklist SET modulo=?, descripcion=? WHERE ID_Modulo = ?');
        $sentencia->bindParam(1, $modulo);
        $sentencia->bindParam(2, $descripcion);
        $sentencia->bindParam(3, $ID_Modulo);
        return $sentencia->execute();
    }

    Public function eliminarModulo_ChecklistMP($ID_Modulo) {
        $sentencia2 = $this->conexion->prepare('UPDATE modulo_checklist SET activo=0 WHERE ID_Modulo = ?');
        $sentencia2->bindParam(1, $ID_Modulo);
        return $sentencia2->execute();
    }

    public function registrarActividadModulo_ChecklistMP($ID_Modulo, $actividad) {
        $sentencia = $this->conexion->prepare("INSERT INTO actividad_checklist(ID_Modulo,actividad) VALUES (?,?)");
        $sentencia->bindParam(1, $ID_Modulo);
        $sentencia->bindParam(2, $actividad);
        return $sentencia->execute();
    }

    public function actualizarActividadModulo_ChecklistMP($ID_Actividad, $actividad) {
        $sentencia = $this->conexion->prepare("UPDATE actividad_checklist SET actividad=? WHERE ID_Actividad =?");
        $sentencia->bindParam(1, $actividad);
        $sentencia->bindParam(2, $ID_Actividad);
        return $sentencia->execute();
    }
    
      public function eliminarActividadModulo_ChecklistMP($ID_Actividad) {
        $sentencia = $this->conexion->prepare("UPDATE actividad_checklist SET activo= 0 WHERE ID_Actividad =?");
        $sentencia->bindParam(1, $ID_Actividad);
        return $sentencia->execute();
    }

    public function registrarMtto_Preventivo($ID_Mtto, $ID_Usuario, $ID_Maquina, $fecha, $tiempo_requerido, $descipcion, $piezas, $observaciones) {
        $sentencia = $this->conexion->prepare("INSERT INTO mtto_preventivo(ID_Mtto, ID_Usuario, ID_Maquina, fecha, tiempo_requerido,descripcion,piezas,observaciones)"
                . " VALUES (?,?,?,?,?,?,?,?)");
        $sentencia->bindParam(1, $ID_Mtto);
        $sentencia->bindParam(2, $ID_Usuario);
        $sentencia->bindParam(3, $ID_Maquina);
        $sentencia->bindParam(4, $fecha);
        $sentencia->bindParam(5, $tiempo_requerido);
        $sentencia->bindParam(6, $descipcion);
        $sentencia->bindParam(7, $piezas);
        $sentencia->bindParam(8, $observaciones);
        return $sentencia->execute();
    }

    public function registrarMtto_Preventivo_Checklist($ID_Mtto, $ID_Actividad, $status, $comentario) {
        $sentencia = $this->conexion->prepare("INSERT INTO mtto_checklist (ID_Mtto, ID_Actividad, status, comentario) VALUES (?,?,?,?)");
        $sentencia->bindParam(1, $ID_Mtto);
        $sentencia->bindParam(2, $ID_Actividad);
        $sentencia->bindParam(3, $status);
        $sentencia->bindParam(4, $comentario);
        return $sentencia->execute();
    }

    public function ultimo_Mtto_Preventivo() {
        $sentencia = $this->conexion->query('SELECT max(ID_Mtto) as ID_Mtto FROM mtto_preventivo');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $mtto) {
            return $mtto["ID_Mtto"];
        }
    }

    public function registrarEntrada($ID_Refaccion, $cantidad, $unidad_medida, $factura, $orden_compra, $proveedor, $precio_unitario, $subtotal, $IVA, $total, $estatus) {
        $ID_Refaccion = (int) $ID_Refaccion;
        $cantidad = (int) $cantidad;

        $sentencia = $this->conexion->prepare("CALL insert_Entrada_Refaccion (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $sentencia->bindParam(1, $ID_Refaccion);
        $sentencia->bindParam(2, $cantidad);
        $sentencia->bindParam(3, $unidad_medida);
        $sentencia->bindParam(4, $factura);
        $sentencia->bindParam(5, $orden_compra);
        $sentencia->bindParam(6, $proveedor);
        $sentencia->bindParam(7, $precio_unitario);
        $sentencia->bindParam(8, $subtotal);
        $sentencia->bindParam(9, $IVA);
        $sentencia->bindParam(10, $total);
        $sentencia->bindParam(11, $estatus);
        return $sentencia->execute();
    }

    public function actualizarRefaccion($ID_Refaccion, $estante, $clave, $descripcion, $maquina, $marca, $modelo, $status_ok, $status_regular, $status_malo, $stock, $ID_Estado) {
        $ID_Refaccion = (int) $ID_Refaccion;

        $sentencia = $this->conexion->prepare("CALL update_refaccion (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $sentencia->bindParam(1, $ID_Refaccion);
        $sentencia->bindParam(2, $estante);
        $sentencia->bindParam(3, $clave);
        $sentencia->bindParam(4, $descripcion);
        $sentencia->bindParam(5, $maquina);
        $sentencia->bindParam(6, $marca);
        $sentencia->bindParam(7, $modelo);
        $sentencia->bindParam(8, $status_ok);
        $sentencia->bindParam(9, $status_regular);
        $sentencia->bindParam(10, $status_malo);
        $sentencia->bindParam(11, $stock);
        $sentencia->bindParam(12, $ID_Estado);
        return $sentencia->execute();
    }

    public function agregarMaquinaria($NumeroActivo, $Maquina, $Marca, $Modelo, $Serie, $Ubicacion, $Estado, $Comentario, $Propietario) {

        $sentencia = $this->conexion->prepare('CALL ingresarMaquinaria (? , ? , ? , ? , ? , ? , ? , ? , ? )');
        $sentencia->bindParam(1, $NumeroActivo);
        $sentencia->bindParam(2, $Maquina);
        $sentencia->bindParam(3, $Marca);
        $sentencia->bindParam(4, $Modelo);
        $sentencia->bindParam(5, $Serie);
        $sentencia->bindParam(6, $Ubicacion);
//         $sentencia->bindParm(6, $UltimaActualizacion);
        $sentencia->bindParam(7, $Comentario);
        $sentencia->bindParam(8, $Estado);
        $sentencia->bindParam(9, $Propietario);
        return $sentencia->execute();
    }

    public function Empleado($cantidad, $ide) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM Empleado where Estado=1 and ID_Supervisor=' . $ide . ' order by id asc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ModulosUsuarios($ID_Usuario) {
        $ID_Usuario = (int) $ID_Usuario;
        $sentencia = $this->conexion->query('SELECT modulo.modulo, modulo.icon FROM usuario INNER JOIN  perfil_usuario ON
                                            usuario.ID = perfil_usuario.ID_Usuario 
                                            INNER JOIN perfil ON perfil_usuario.ID_Perfil = perfil.ID_Perfil
                                            INNER JOIN perfil_interfaz ON perfil.ID_Perfil = perfil_interfaz.ID_Perfil
                                            INNER JOIN interfaz ON perfil_interfaz.ID_Interfaz = interfaz.ID_Interfaz
                                            INNER JOIN modulo ON interfaz.ID_Modulo = modulo.ID_Modulo
                                            WHERE usuario.ID = ' . $ID_Usuario . ' group by modulo.modulo');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InterfazUsuarios($ID_Usuario, $modulo) {
        $ID_Usuario = (int) $ID_Usuario;
        $sentencia = $this->conexion->query('Select interfaz.nombre, interfaz.url FROM usuario INNER JOIN  perfil_usuario ON
                                            usuario.ID = perfil_usuario.ID_Usuario 
                                            INNER JOIN perfil ON perfil_usuario.ID_Perfil = perfil.ID_Perfil
                                            INNER JOIN perfil_interfaz ON perfil.ID_Perfil = perfil_interfaz.ID_Perfil
                                            INNER JOIN interfaz ON perfil_interfaz.ID_Interfaz = interfaz.ID_Interfaz
                                            INNER JOIN modulo ON interfaz.ID_Modulo = modulo.ID_Modulo
                                            WHERE usuario.ID =' . $ID_Usuario . ' and modulo.modulo = "' . $modulo . '"');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function EmpleadoAdmin($cantidad) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM Empleado where Estado=1  order by id asc limit ' . $cantidad);

        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MostrarMaquinaria($estado,$ubicacion) {
        $sentencia = $this->conexion->query('SELECT * FROM Maquinaria WHERE estado like "%' . $estado . '%" AND ubicacion like "%'.$ubicacion.'%"');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MostrarMttosPreventivos() {
        $sentencia = $this->conexion->query('SELECT * FROM mtto_preventivo');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MostrarMttosPreventivos2($busqueda, $criterio) {

        if ($criterio == 'Maquina') {
            $sentencia = $this->conexion->query('SELECT * FROM mtto_preventivo WHERE ID_Maquina ="' . $busqueda . '"');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sentencia = $this->conexion->query('SELECT * FROM mtto_preventivo WHERE ID_Usuario = (Select ID from Usuario WHERE usuario like "%' . $busqueda . '%" limit 1)');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function MostrarRefacciones() {
        $sentencia = $this->conexion->query('SELECT * FROM refaccion');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MostrarSalidasRefacciones($ID_Refaccion) {
        $ID_Refaccion = (int) $ID_Refaccion;
        $sentencia = $this->conexion->query('select * from salida_refaccion where ID_Refaccion= ' . $ID_Refaccion . ' order by fecha desc limit 6');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function MostrarEntradasRefacciones($ID_Refaccion) {
        $ID_Refaccion = (int) $ID_Refaccion;
        $sentencia = $this->conexion->query('select * from entrada_refaccion where ID_Refaccion= ' . $ID_Refaccion . ' order by fecha desc limit 6');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarRefacciones($criterioBusqueda, $filtro, $estado) {
        if ($estado <> 0) {
            $sentencia = $this->conexion->query('SELECT * FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%" and ID_Estado = ' . $estado . '');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sentencia = $this->conexion->query('SELECT * FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%"');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
     public function BuscarRefaccionesMec($criterioBusqueda, $filtro) {
      
            $sentencia = $this->conexion->query('SELECT * FROM refaccion WHERE ' . $filtro . ' LIKE "%' . $criterioBusqueda . '%"');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarInOutRef($tipo, $inicio, $fin) {
        $sentencia = $this->conexion->query('SELECT * FROM ' . $tipo . ' INNER JOIN refaccion ON ' . $tipo . '.ID_Refaccion = refaccion.ID_Refaccion '
                . 'WHERE fecha BETWEEN "' . $inicio . '" AND "' . $fin . ' 23:59:59" ORDER BY fecha DESC');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarDescripcionModulo($ID_Modulo) {
        $sentencia = $this->conexion->query('SELECT descripcion FROM modulo_checklist WHERE ID_Modulo =' . $ID_Modulo . '');
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $desc) {
            return $desc["descripcion"];
        }
    }

    public function MostrarCortes($privilegios) {
        $privilegios = (int) $privilegios;
        if ($privilegios = 9 || $privilegios = 1) {
            $sentencia = $this->conexion->query('SELECT * FROM CHECKLIST');

            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($privilegios = 8) {
            $sentencia = $this->conexion->query('SELECT * FROM CHECKLIST WHERE AVANCE <> "100"');

            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function mostrarTarifario() {
        $sentencia = $this->conexion->query('SELECT * FROM TARIFARIO');

        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function OperacionesAdmin($cantidad) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM Operaciones  order by Orden asc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Refacciones() {
        $sentencia = $this->conexion->query('SELECT * FROM refaccion');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UbicacionesMaquinaria() {
        $sentencia = $this->conexion->query('SELECT Ubicacion FROM Maquinaria  group by Ubicacion asc ');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function EstadosMaquinaria() {
        $sentencia = $this->conexion->query('SELECT Estado FROM Maquinaria  group by Estado asc ');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Semanas2018() {
        $sentencia = $this->conexion->query('SELECT * FROM Semanas2018');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DestinosTarifario() {
        $sentencia = $this->conexion->query('SELECT * FROM Tarifario  ');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Registros() {
        $sentencia = $this->conexion->query('SELECT * FROM Log_DB  order by ID_Log');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Modificaciones() {
        $sentencia = $this->conexion->query('Select * from EmpleadoModify where PrestadoMf="SI" order by IDMF asc');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function RegistrosSupervisor($cantidad, $ideSupervisor) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM Log_DB  where ID_Supervisor = ' . $ideSupervisor . ' order by ID_Log asc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPersona($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM Empleado WHERE ID = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            return $producto;
        }
    }

    public function obtenerStats($tabla, $columna, $condicion) {
        if (($columna && $condicion) <> "") {
            $sentencia = $this->conexion->query('SELECT count(*) FROM ' . $tabla . ' WHERE ' . $columna . ' LIKE "' . $condicion . '"');
            $sentencia->execute();

            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sentencia = $this->conexion->query('SELECT count(*) FROM  ' . $tabla . '');
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }


//        $sentencia = $this->conexion->prepare('SELECT (*) FROM Empleado WHERE ID like ' . $ide);
//        $sentencia->bindParam(1, $ide);
//        $sentencia->execute();
//        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
//            return $producto;
    }

    public function obtenermaquina($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM Maquinaria WHERE Orden = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $maquina) {
            return $maquina;
        }
    }

    public function obtenerCorte($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM Checklist WHERE corte = "' . $ide . '"');
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $corte) {
            return $corte;
        }
    }

    public function obtenerTarifario($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM Tarifario WHERE Clave =' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $tarifario) {
            return $tarifario;
        }
    }

    public function obtenerPersonaMF($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM EmpleadoModify WHERE IDMF = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            return $producto;
        }
    }

    public function modificarPersona($idPersona, $departamento, $seccion, $idSupervisor) {
        $sentencia = $this->conexion->prepare('CALL ModificarPersona (?,?,?,?)');
        $sentencia->bindParam(1, $idPersona);
        $sentencia->bindParam(2, $departamento);
        $sentencia->bindParam(3, $seccion);
        $sentencia->bindParam(4, $idSupervisor);
        return $sentencia->execute();
    }

    public function modificarPersonaAdmin($ideUsuario, $idPersona, $departamento, $seccion, $operacion, $idSupervisor) {
        $sentencia = $this->conexion->prepare('Call ModificarPersonaAdmin(? , ? , ? , ? , ? , ? )');
        $sentencia->bindParam(1, $ideUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $departamento);
        $sentencia->bindParam(4, $seccion);
        $sentencia->bindParam(5, $operacion);
        $sentencia->bindParam(6, $idSupervisor);
        return $sentencia->execute();
    }

    public function modificarPersonaSupervisor($PasswordSup1, $idPersona, $departamento, $seccion, $operacion, $dias, $PasswordSup2) {
        $PasswordSup2 = md5($PasswordSup2);
        $sentencia = $this->conexion->prepare('Call ModificarPersonaSupervisor2(? , ? , ? , ? , ? , ? , ?)');
        $sentencia->bindParam(1, $PasswordSup1);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $departamento);
        $sentencia->bindParam(4, $seccion);
        $sentencia->bindParam(5, $operacion);
        $sentencia->bindParam(6, $dias);
        $sentencia->bindParam(7, $PasswordSup2);
        return $sentencia->execute();
    }

    public function modificarPersonaInge($PasswordUsuario, $idPersona, $departamento, $seccion, $operacion, $dias, $idSupervisor) {
        $sentencia = $this->conexion->prepare('Call ModificarPersonaAdmin3(? , ? , ? , ? , ? , ? , ?)');
        $sentencia->bindParam(1, $PasswordUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $departamento);
        $sentencia->bindParam(4, $seccion);
        $sentencia->bindParam(5, $operacion);
        $sentencia->bindParam(6, $dias);
        $sentencia->bindParam(7, $idSupervisor);
        return $sentencia->execute();
    }

    public function modificarPersonaIngeHoras($PasswordUsuario, $idPersona, $departamento, $seccion, $operacion, $horas, $idSupervisor) {
        $sentencia = $this->conexion->prepare('Call ModificarPersonaAdminHoras(? , ? , ? , ? , ? , ? , ?)');
        $sentencia->bindParam(1, $PasswordUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $departamento);
        $sentencia->bindParam(4, $seccion);
        $sentencia->bindParam(5, $operacion);
        $sentencia->bindParam(6, $horas);
        $sentencia->bindParam(7, $idSupervisor);
        return $sentencia->execute();
    }

    public function aplazarTiempoInge($PasswordUsuario, $idPersona, $dias) {
//        $idPersona = (int) $idPersona;
//        $dias = (int) $dias;
        $sentencia = $this->conexion->prepare('call AplazarPrestamoInge(? , ? , ?)');
        $sentencia->bindParam(1, $PasswordUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $dias);

        return $sentencia->execute();
    }

    public function aplazarHorasInge($PasswordUsuario, $idPersona, $horas) {
//        $idPersona = (int) $idPersona;
//        $dias = (int) $dias;
        $sentencia = $this->conexion->prepare('call AplazarHorasInge(? , ? , ?)');
        $sentencia->bindParam(1, $PasswordUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $horas);
        return $sentencia->execute();
    }

    public function retornarEmpleado($PasswordUsuario, $idPersona) {

        $sentencia = $this->conexion->prepare('Call RegresarPersona(? , ?)');
        $sentencia->bindParam(1, $PasswordUsuario);
        $sentencia->bindParam(2, $idPersona);
        return $sentencia->execute();
    }

    public function modificarPersona2($ideUsuario, $idPersona, $departamento, $seccion, $operacion, $idSupervisor) {
        $sentencia = $this->conexion->prepare('Call ModificarPersona2(? , ? , ? , ? , ? , ? )');
        $sentencia->bindParam(1, $ideUsuario);
        $sentencia->bindParam(2, $idPersona);
        $sentencia->bindParam(3, $departamento);
        $sentencia->bindParam(4, $seccion);
        $sentencia->bindParam(5, $operacion);
        $sentencia->bindParam(6, $idSupervisor);
        return $sentencia->execute();
    }

    public function consultaProductos2($cantidad = 12) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM ninas order by id_producto2 desc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultaProductos3($cantidad = 12) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM ninos order by id_producto2 desc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProducto($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM Producto WHERE ID_Producto = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            return $producto;
        }
    }

    public function obtenerProducto2($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM ninas WHERE ID_Producto2 = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            return $producto;
        }
    }

    public function obtenerProducto3($ide) {
        $sentencia = $this->conexion->prepare('SELECT * FROM ninos WHERE ID_Producto2 = ' . $ide);
        $sentencia->bindParam(1, $ide);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $producto) {
            return $producto;
        }
    }

    public function insertarComentario($name, $mail, $tel, $msj) {
        $sentencia = $this->conexion->prepare('INSERT INTO comentario (nombre, email, comentario) values ( ? , ? , ?)');
        $msj = $tel . "<br>" . $msj;
        $sentencia->bindParam(1, $name);
        $sentencia->bindParam(2, $mail);
        $sentencia->bindParam(3, $msj);

        return $sentencia->execute();
    }

    public function consultarUsuario($usuario, $password) {
        $sentencia = $this->conexion->prepare('Select * from usuario where usuario=? and password=?');
        $sentencia->bindParam(1, $usuario);
        $sentencia->bindParam(2, $password);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $persona) {
            return $persona;
        }
    }

    public function verificarUsuario($usuario) {
        $sentencia = $this->conexion->prepare('Select * from usuario where usuario=?');
        $sentencia->bindParam(1, $usuario);
        $sentencia->execute();
        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $persona) {
            return $persona;
        }
    }

    public function consultaComentarios($cantidad) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->query('SELECT * FROM  Comentario order by ID_Comentario desc limit ' . $cantidad);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarProducto($name, $foto, $precio) {
        $sentencia = $this->conexion->prepare('INSERT INTO producto (nombre, imagen, precio) values ( ? , ? , ?)');
        $sentencia->bindParam(1, $name);
        $sentencia->bindParam(2, $foto);
        $sentencia->bindParam(3, $precio);
        return $sentencia->execute();
    }

    public function modificarProducto($id, $name, $precio, $foto = '') {
        if ($foto <> "") {
            $sentencia = $this->conexion->prepare('update producto set nombre=?, imagen=?, precio=? where id_producto = ? ');
            $sentencia->bindParam(1, $name);
            $sentencia->bindParam(2, $foto);
            $sentencia->bindParam(3, $precio);
            $sentencia->bindParam(4, $id);
            return $sentencia->execute();
        } else {
            $sentencia = $this->conexion->prepare('update producto set nombre=?, precio=? where id_producto = ? ');
            $sentencia->bindParam(1, $name);
            $sentencia->bindParam(2, $precio);
            $sentencia->bindParam(3, $id);
            return $sentencia->execute();
        }
    }

    public function ingresarCorte($corte, $departamento, $descripcion, $cantidad, $semana, $password) {
        $cantidad = (int) $cantidad;
        $sentencia = $this->conexion->prepare('call ingresarNuevoCorte(?,?,?,?,?,?)');
        $sentencia->bindParam(1, $corte);
        $sentencia->bindParam(2, $departamento);
        $sentencia->bindParam(3, $descripcion);
        $sentencia->bindParam(4, $cantidad);
        $sentencia->bindParam(5, $semana);
        $sentencia->bindParam(6, $password);
        return $sentencia->execute();
    }

    public function IngresarPedidoTaxi($placa, $taxi, $nombreconductor, $fechaPedido, $pasajero, $claveDestino, $password) {
        $sentencia = $this->conexion->prepare('call IngresarPedidoTaxi ( ? , ? , ? , ? , ? , ? ,now(), ? )');
        $sentencia->bindParam(1, $placa);
        $sentencia->bindParam(2, $taxi);
        $sentencia->bindParam(3, $nombreconductor);
        $sentencia->bindParam(4, $fechaPedido);
        $sentencia->bindParam(5, $pasajero);
        $sentencia->bindParam(6, $claveDestino);
        $sentencia->bindParam(7, $password);
        return $sentencia->execute();
    }

    public function IngresarPedidoTaxi1($placa, $taxi, $nombreconductor, $fechaPedido, $pasajero1, $claveDestino1, $pasajero2, $claveDestino2, $pasajero3, $claveDestino3, $pasajero4, $claveDestino4, $pasajero5, $claveDestino5, $password) {
        $sentencia = $this->conexion->prepare('call IngresarPedidoTaxi1  ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? ,? ,now(), ? )');
        $sentencia->bindParam(1, $placa);
        $sentencia->bindParam(2, $taxi);
        $sentencia->bindParam(3, $nombreconductor);
        $sentencia->bindParam(4, $fechaPedido);
        $sentencia->bindParam(5, $pasajero1);
        $sentencia->bindParam(6, $claveDestino1);
        $sentencia->bindParam(7, $pasajero2);
        $sentencia->bindParam(8, $claveDestino2);
        $sentencia->bindParam(9, $pasajero3);
        $sentencia->bindParam(10, $claveDestino3);
        $sentencia->bindParam(11, $pasajero4);
        $sentencia->bindParam(12, $claveDestino4);
        $sentencia->bindParam(13, $pasajero5);
        $sentencia->bindParam(14, $claveDestino5);
        $sentencia->bindParam(15, $password);
        return $sentencia->execute();
    }

    public function modificarTarifario($newRuta, $newCostoDia, $password, $ClaveModificar) {
        $sentencia = $this->conexion->prepare('call ModificarTarifario(?,?,?,?)');
        $sentencia->bindParam(1, $newRuta);
        $sentencia->bindParam(2, $newCostoDia);
        $sentencia->bindParam(3, $password);
        $sentencia->bindParam(4, $ClaveModificar);
        return $sentencia->execute();
    }

    public function agregarNuevaRuta($newRuta, $newCostoDia, $password) {
        $sentencia = $this->conexion->prepare('call ActualizarTarifario(?,?,?)');
        $sentencia->bindParam(1, $newRuta);
        $sentencia->bindParam(2, $newCostoDia);
        $sentencia->bindParam(3, $password);
        return $sentencia->execute();
    }

    public function ultimoDestino() {
        $sentencia = $this->conexion->query("select max(clave) as Max from tarifario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarCorte($newCorte, $newTela, $newTelaStatus, $newMolde, $newMoldeStatus, $newTrazo, $newTrazoStatus, $newCantidadReal, $newCantidadRealStatus, $newMesaCorte, $newMesaCorteStatus, $newFoleo, $newFoleoStatus, $newPock, $newPockStatus, $newFusion, $newFusionStatus, $newFusionPretina, $newFusionPretinaStatus, $newPretinaCorta, $newPretinaCortaStatus, $newMuestra, $newMuestraStatus, $newSpec, $newSpecStatus, $newBordado, $newBordadoStatus, $newAvios, $newAviosStatus, $newMoldes, $newMoldesStatus, $newPassword) {
        $newCantidadReal = (int) $newCantidadReal;
        $sentencia = $this->conexion->prepare("CALL actualizarCorte ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? ,? , ? , ? , ? , ? , ? , ? , ? , ? , ? ,?, ? )");

        $sentencia->bindParam(1, $newCorte);
        $sentencia->bindParam(2, $newTela);
        $sentencia->bindParam(3, $newTelaStatus);
        $sentencia->bindParam(4, $newMolde);
        $sentencia->bindParam(5, $newMoldeStatus);
        $sentencia->bindParam(6, $newTrazo);
        $sentencia->bindParam(7, $newTrazoStatus);
        $sentencia->bindParam(8, $newCantidadReal);
        $sentencia->bindParam(9, $newCantidadRealStatus);
        $sentencia->bindParam(10, $newMesaCorte);
        $sentencia->bindParam(11, $newMesaCorteStatus);
        $sentencia->bindParam(12, $newFoleo);
        $sentencia->bindParam(13, $newFoleoStatus);
        $sentencia->bindParam(14, $newPock);
        $sentencia->bindParam(15, $newPockStatus);
        $sentencia->bindParam(16, $newFusion);
        $sentencia->bindParam(17, $newFusionStatus);
        $sentencia->bindParam(18, $newFusionPretina);
        $sentencia->bindParam(19, $newFusionPretinaStatus);
        $sentencia->bindParam(20, $newPretinaCorta);
        $sentencia->bindParam(21, $newPretinaCortaStatus);
        $sentencia->bindParam(22, $newMuestra);
        $sentencia->bindParam(23, $newMuestraStatus);
        $sentencia->bindParam(24, $newSpec);
        $sentencia->bindParam(25, $newSpecStatus);
        $sentencia->bindParam(26, $newBordado);
        $sentencia->bindParam(27, $newBordadoStatus);
        $sentencia->bindParam(28, $newAvios);
        $sentencia->bindParam(29, $newAviosStatus);
        $sentencia->bindParam(30, $newMoldes);
        $sentencia->bindParam(31, $newMoldesStatus);
        $sentencia->bindParam(32, $newPassword);
        return $sentencia->execute();
    }

    public function modificarCorte($newCorte, $newLinea, $newDescripcion, $newCantidad, $newSemana, $newAvance, $newPassword, $CorteModify) {
        $newCantidad = (int) $newCantidad;
        $sentencia = $this->conexion->prepare("CALL ModificarCorte ( ? , ? , ? , ? , ? , ? , ? ,?)");
        $sentencia->bindParam(1, $newCorte);
        $sentencia->bindParam(2, $newLinea);
        $sentencia->bindParam(3, $newDescripcion);
        $sentencia->bindParam(4, $newCantidad);
        $sentencia->bindParam(5, $newSemana);
        $sentencia->bindParam(6, $newAvance);
        $sentencia->bindParam(7, $newPassword);
        $sentencia->bindParam(8, $CorteModify);
        return $sentencia->execute();
    }

    public function eliminarProducto($ide) {
        $ide = (int) $ide;
        $sentencia = $this->conexion->prepare('DELETE from producto where id_producto = ?');
        $sentencia->bindParam(1, $ide);
        return $sentencia->execute();
    }

}
