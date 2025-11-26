<?php
class HistoriaFeliz{
    private $conexion;
    
    function __construct(){
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }
    
function guardar($descripcion, $fecha, $hora, $foto, $fk_mascota, $fk_refugio){
    $consulta = "INSERT INTO historia_feliz (id_historia_feliz, descripcion, fecha, hora, foto, fk_mascota, fk_refugio, estatus) 
                 VALUES (null, '$descripcion', '$fecha', '$hora', '$foto', '$fk_mascota', '$fk_refugio', '1')";
    
    $respuesta = $this->conexion->query($consulta);
    return $respuesta;
}

// En Historias_f.php - CORREGIDO
// En Historias_f.php - NOMBRES EXACTOS
    public function mostrar($id_refugio = null) {
        if ($id_refugio) {
            $sql = "SELECT hf.*, m.nombre as nombre_mascota 
                    FROM historia_feliz hf 
                    LEFT JOIN mascotas m ON hf.fk_mascota = m.id_mascotas 
                    LEFT JOIN refugio r ON hf.fk_refugio = r.id_refugio
                    WHERE hf.fk_refugio = $id_refugio 
                    AND hf.estatus = 1 
                    AND r.estatus = 1  -- Solo refugios activos
                    ORDER BY hf.fecha DESC, hf.hora DESC";
        } else {
            $sql = "SELECT hf.*, m.nombre as nombre_mascota 
                    FROM historia_feliz hf 
                    LEFT JOIN mascotas m ON hf.fk_mascota = m.id_mascotas 
                    LEFT JOIN refugio r ON hf.fk_refugio = r.id_refugio
                    WHERE hf.estatus = 1 
                    AND r.estatus = 1  -- Solo refugios activos
                    ORDER BY hf.fecha DESC, hf.hora DESC";
        }
    
    $resultado = $this->conexion->query($sql);
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
function obtenerHistoria($id_historia){
    $consulta = "SELECT h.*, m.nombre as nombre_mascota, r.nombre as nombre_refugio
                 FROM historia_feliz h 
                 LEFT JOIN mascotas m ON h.fk_mascota = m.id_mascotas 
                 LEFT JOIN refugio r ON h.fk_refugio = r.id_refugio
                 WHERE h.id_historia_feliz = $id_historia";
    
    $respuesta = $this->conexion->query($consulta);
    return $respuesta->fetch_assoc();
}
    
function actualizar($id_historia, $descripcion, $fecha, $hora, $foto, $fk_mascota, $fk_refugio){
    $consulta = "UPDATE historia_feliz 
                 SET descripcion = '$descripcion', fecha = '$fecha', hora = '$hora', 
                     foto = '$foto', fk_mascota = '$fk_mascota', fk_refugio = '$fk_refugio'
                 WHERE id_historia_feliz = $id_historia";
    return $this->conexion->query($consulta);
}
    
    function eliminar($id_historia){
        $consulta = "UPDATE historia_feliz SET estatus = '0' WHERE id_historia_feliz = $id_historia";
        return $this->conexion->query($consulta);
    }
    
function obtenerMascotas($id_refugio = null) {
    if ($id_refugio) {
        // Solo mascotas de este refugio
        $consulta = "SELECT id_mascotas, nombre FROM mascotas WHERE fk_refugio = $id_refugio AND estatus = 1";
    } else {
        // Todas las mascotas (comportamiento original)
        $consulta = "SELECT id_mascotas, nombre FROM mascotas WHERE estatus = 1";
    }
    
    $respuesta = $this->conexion->query($consulta);
    
    $mascotas = [];
    while($row = $respuesta->fetch_assoc()){
        $mascotas[] = $row;
    }
    return $mascotas;
}
}
?>