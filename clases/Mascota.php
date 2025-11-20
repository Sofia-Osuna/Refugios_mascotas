<?php
  error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);
class Mascota{
    private $conexion;
    
    function __construct(){
        require_once('conexion.php');
        $this->conexion = new Conexion();
    }
    
  function guardar($nombre, $descripcion, $foto, $fk_especie, $fk_refugio){
    $consulta = "INSERT INTO mascotas (id_mascotas, nombre, descripcion, foto, fk_especie, fk_refugio, estatus) 
                 VALUES (null, '$nombre', '$descripcion', '$foto', '$fk_especie', '$fk_refugio', 1)";
    
    $respuesta = $this->conexion->query($consulta);
    return $respuesta;
}
  function mostrarPorRefugio($id_refugio){
    if($id_refugio == null || $id_refugio == ''){
        return [];
    }
    
    $consulta = "SELECT * FROM mascotas WHERE fk_refugio = $id_refugio AND estatus = 1";
    $respuesta = $this->conexion->query($consulta);
    
    if(!$respuesta){
        return [];
    }
    
    $mascotas = [];
    while($row = $respuesta->fetch_assoc()){
        $mascotas[] = $row;
    }
    return $mascotas;
}
    function obtenerEspecies(){
    $consulta = "SELECT * FROM especie";
    $respuesta = $this->conexion->query($consulta);
    
    $especies = [];
    while($row = $respuesta->fetch_assoc()){
        $especies[] = $row;
    }
    return $especies;
}
function obtenerMascota($id_mascota){
    $consulta = "SELECT m.*, e.nombre as nombre_especie 
                 FROM mascotas m, especie e 
                 WHERE m.fk_especie = e.id_especie 
                 AND m.id_mascotas = $id_mascota";
    $respuesta = $this->conexion->query($consulta);
    return $respuesta->fetch_assoc();
}

function eliminar($id_mascota){
    $consulta = "UPDATE mascotas SET estatus = 'indisponible' WHERE id_mascotas = $id_mascota";
    return $this->conexion->query($consulta);
}

function actualizar($id_mascota, $nombre, $descripcion, $foto, $fk_especie){
    $consulta = "UPDATE mascotas SET nombre = '$nombre', descripcion = '$descripcion', 
                 foto = '$foto', fk_especie = '$fk_especie' WHERE id_mascotas = $id_mascota";
    return $this->conexion->query($consulta);
}
}
?>