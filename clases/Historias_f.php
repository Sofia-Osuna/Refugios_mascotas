<?php
class HistoriaFeliz{
    private $conexion;
    
    function __construct(){
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }
    
function guardar($descripcion, $fecha, $hora, $foto, $fk_mascota){
    $consulta = "INSERT INTO historia_feliz (id_historia_feliz, descripcion, fecha, hora, foto, fk_mascota, estatus) 
                 VALUES (null, '$descripcion', '$fecha', '$hora', '$foto', '$fk_mascota', '1')";
    
    $respuesta = $this->conexion->query($consulta);
    return $respuesta;
}

function mostrar(){
    $consulta = "SELECT h.*, m.nombre as nombre_mascota 
                 FROM historia_feliz h, mascotas m 
                 WHERE h.fk_mascota = m.id_mascotas 
                 AND h.estatus = '1' 
                 ORDER BY h.fecha DESC, h.hora DESC";
    
    $respuesta = $this->conexion->query($consulta);
    
    $historias = [];
    while($row = $respuesta->fetch_assoc()){
        $historias[] = $row;
    }
    return $historias;
}

function obtenerHistoria($id_historia){
    $consulta = "SELECT h.*, m.nombre as nombre_mascota 
                 FROM historia_feliz h, mascotas m 
                 WHERE h.fk_mascota = m.id_mascotas 
                 AND h.id_historia_feliz = $id_historia";
    
    $respuesta = $this->conexion->query($consulta);
    return $respuesta->fetch_assoc();
}
    
    function actualizar($id_historia, $descripcion, $fecha, $hora, $foto, $fk_mascota){
        $consulta = "UPDATE historia_feliz 
                     SET descripcion = '$descripcion', fecha = '$fecha', hora = '$hora', 
                         foto = '$foto', fk_mascota = '$fk_mascota' 
                     WHERE id_historia_feliz = $id_historia";
        return $this->conexion->query($consulta);
    }
    
    function eliminar($id_historia){
        $consulta = "UPDATE historia_feliz SET estatus = '0' WHERE id_historia_feliz = $id_historia";
        return $this->conexion->query($consulta);
    }
    
    function obtenerMascotas(){
        $consulta = "SELECT id_mascotas, nombre FROM mascotas WHERE estatus = 1";
        $respuesta = $this->conexion->query($consulta);
        
        $mascotas = [];
        while($row = $respuesta->fetch_assoc()){
            $mascotas[] = $row;
        }
        return $mascotas;
    }
}
?>