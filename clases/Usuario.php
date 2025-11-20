<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Usuario{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();

        }
        function guardar($nombre, $password, $correo){
            $consulta = "INSERT INTO usuario (id_usuario, nombre, password, foto, fk_rol, estatus) VALUES (null, '{$nombre}', '{$password}', 'foto', 2, 1);";
            $respuesta = $this -> conexion -> query($consulta);
            /*
            este no me funciona porque no le puse parametros xdxd
            $id=mysqli_insert_id();
            debe de ser asi:
            $id= $this -> conexion -> insert_id;
            o:
            */            
            $id = mysqli_insert_id($this->conexion);
            $consulta = "INSERT INTO correo_usuario (id_correo_usuario, correo, fk_usuario, estatus) VALUES (null, '{$correo}', '{$id}',  1);";
            $respuesta = $this -> conexion -> query($consulta);
          
            return $respuesta;
        }

        function mostrar(){
            $consulta = "SELECT u.*, c.correo FROM usuario u INNER JOIN correo_usuario c ON u.id_usuario=c.fk_usuario WHERE c.estatus = 1 && u.estatus=1 ORDER BY id_usuario DESC";
            $respuesta = $this -> conexion -> query($consulta);
            $usuario = [];
            while($fila = $respuesta->fetch_assoc()){
            $usuario[] = $fila;
            }
            return $usuario;
        }
        
        function obtenerPorId($id_usuario){
            //en esta consulta es donde jalas todos los datos personales del usuario
            $consulta = "SELECT u.*, c.correo FROM usuario u INNER JOIN correo_usuario c ON c.fk_usuario = u.id_usuario WHERE id_usuario = {$id_usuario}";
            $respuesta = $this->conexion->query($consulta);
            $usuario = $respuesta->fetch_assoc();
            return $usuario;
        }

        function editar($id_usuario, $nombre, $password, $correo){
            $consulta = "UPDATE usuario SET nombre = '$nombre', password = '$password' WHERE id_usuario = $id_usuario";
            $respuesta = $this->conexion->query($consulta);
            
           
            $consulta = "UPDATE correo_usuario SET estatus = 0  WHERE fk_usuario = {$id_usuario}";
            $respuesta = $this->conexion->query($consulta);

            $consulta = "INSERT INTO correo_usuario (id_correo_usuario, correo, fk_usuario, estatus) VALUES (null, '{$correo}', '{$id_usuario}',  1);";
            $respuesta = $this->conexion->query($consulta);

            return $respuesta;
        }
        function eliminar($id_usuario){
        $consulta = "UPDATE  usuario SET estatus = 0 WHERE id_usuario = {$id_usuario}";
        $respuesta = $this->conexion->query($consulta);
        return $respuesta;
        }
        
        function login($user, $contra){
            $consulta ="SELECT * FROM usuario WHERE (nombre='{$user}' AND password='{$contra}') ";
            $respuesta = $this->conexion->query($consulta);
          return $respuesta;
        }
    }
?>