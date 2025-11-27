<?php

 error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Adopcion{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();

        }

        function guardar($id_usuario, $id_mascota){
            $consulta = "INSERT INTO adopcion (id_adopcion, fecha, hora, fk_usuario, estatus) VALUES(null, CURDATE(), CURTIME(),'{$id_usuario}',  'pendiente');";
            $respuesta = $this -> conexion -> query($consulta); 
            $fk_adopcion = mysqli_insert_id($this->conexion);

            $consulta1 = "INSERT INTO mascotas_adopcion (id_mascotas_adopcion, fk_mascota, fk_adopcion, estatus) VALUES(null, '{$id_mascota}', '{$fk_adopcion}', 1 );";
            $respuesta1 = $this -> conexion -> query($consulta1); 
            
            return $respuesta;
        }
        
        function mostrar(){
            $consulta = "SELECT 
                a.id_adopcion, 
                a.fecha, 
                a.hora, 
                a.fk_usuario, 
                a.estatus as estatus_adopcion,  
                ma.id_mascotas_adopcion,
                ma.fk_mascota,
                ma.fk_adopcion,
                ma.estatus as estatus_mascota   
                FROM adopcion a 
                INNER JOIN mascotas_adopcion ma ON a.id_adopcion = ma.fk_adopcion";
    
            $resultado = $this->conexion->query($consulta);
            $datos = [];
            while($fila = $resultado->fetch_assoc()) {
                $datos[] = $fila;
            }
            return $datos; 
        }
    }
?>