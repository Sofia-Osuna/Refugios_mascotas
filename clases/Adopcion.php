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
            //cuando se registra una adopcion el estatus de la mascota tiene que cambiar a pendiente tambien xdxd 

            $consulta2 = "UPDATE mascotas SET estatus = 'pendiente' WHERE id_mascotas=$id_mascota";
            $respuesta2 = $this -> conexion -> query($consulta2); 

            return $respuesta;
        }
        
        function mostrarPorRefugio($id_refugio){
            $consulta="SELECT 
                u.nombre as username, 
                c.correo,
                m.nombre as Mascota,
                m.id_mascotas,
                a.fecha,
                a.hora,
                a.estatus as Estatus
                FROM usuario u 
                INNER JOIN correo_usuario c ON c.fk_usuario = u.id_usuario AND c.estatus =1
                INNER JOIN adopcion a ON u.id_usuario = a.fk_usuario 
                INNER JOIN mascotas_adopcion ma ON a.id_adopcion = ma.fk_adopcion
                INNER JOIN mascotas m ON ma.fk_mascota = m.id_mascotas
                INNER JOIN refugio r ON m.fk_refugio=r.id_refugio
                WHERE r.id_refugio = $id_refugio;
                ";
    
            $resultado = $this->conexion->query($consulta);
            $datos = [];
            while($fila = $resultado->fetch_assoc()) {
                $datos[] = $fila;
            }
            return $datos; 
        }

        function mostrarPorId($id_usuario){
            // seleccionar el nombre de la mascota, el nombre del refugio y no seeee acabo de despertar, de un usuario especifico
            //refugio = mascota = mascota_adopcion = adopcion = usuario
            $consulta = "SELECT
                r.nombre as Refugio,
                r.id_refugio,
                m.nombre as Mascota,
                m.id_mascotas,
                a.fecha,
                a.hora, 
                a.estatus as Estatus
                FROM refugio r 
                LEFT JOIN mascotas m ON r.id_refugio = m.fk_refugio
                LEFT JOIN mascotas_adopcion ma ON m.id_mascotas=ma.fk_mascota
                LEFT JOIN adopcion a ON ma.fk_adopcion=a.id_adopcion 
                WHERE a.fk_usuario = $id_usuario";

            $resultado = $this->conexion->query($consulta);
            $datos = [];
            while($fila = $resultado->fetch_assoc()) {
                $datos[] = $fila;
            }
            return $datos; 
        }
    }
?>