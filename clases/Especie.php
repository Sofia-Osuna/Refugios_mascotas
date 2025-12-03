<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Especie{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('Conexion.php');
            $this -> conexion = new Conexion();

        }
        function guardar($nombre){
            $consulta = "INSERT INTO especie (id_especie, nombre) VALUES(null,'{$nombre}');";
            $respuesta = $this -> conexion -> query($consulta); 

            return $respuesta;
        }
        
           function editar($id_especie, $nombre){
        $consulta = "UPDATE especie SET nombre = '{$nombre}' WHERE id_especie = {$id_especie}";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }

          function eliminar($id_especie){
        $consulta = "DELETE FROM especie WHERE id_especie = {$id_especie}";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
    }
    //esto es para mostrar la lista de las especies
    function mostrar(){
    $consulta = "SELECT * FROM especie ORDER BY id_especie DESC";
    $respuesta = $this->conexion->query($consulta);
    $especies = [];
    while($fila = $respuesta->fetch_assoc()){
        $especies[] = $fila;
    }
    return $especies;
}
        //esto es para tener la id de la especie
        function Id($id_especie){
         $consulta = "SELECT * FROM especie WHERE id_especie = {$id_especie}";
         $respuesta = $this->conexion->query($consulta);
        $especie = $respuesta->fetch_assoc();
         return $especie;
}
    }
?>