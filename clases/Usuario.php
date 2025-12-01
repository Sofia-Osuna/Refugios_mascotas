<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    class Usuario{
        private $conexion;
        private $ultimo_id_usuario; // ⭐ NUEVA PROPIEDAD
        
        function __construct(){
            require_once('conexion.php');
            $this -> conexion = new Conexion();
        }

        function guardar($nombre, $password, $correo, $foto, $rol){
            
            // Hash de la contraseña
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            
            // Escapar datos
            $nombre = $this->conexion->real_escape_string($nombre);
            $password_hash = $this->conexion->real_escape_string($password);
            $correo = $this->conexion->real_escape_string($correo);
            $foto = $this->conexion->real_escape_string($foto);
            
            // PRIMER INSERT: Usuario
            $consulta = "INSERT INTO usuario (id_usuario, nombre, password, foto, fk_rol, estatus) 
                         VALUES (null, '{$nombre}', '{$password}', '{$foto}', {$rol}, 1)";
            
            $respuesta_usuario = $this->conexion->query($consulta);
            
            if(!$respuesta_usuario){
                echo "Error al insertar usuario: " . $this->conexion->error;
                return false;
            }
            
            // ⭐ IMPORTANTE: Guardar el ID DEL USUARIO aquí
            $this->ultimo_id_usuario = $this->conexion->insert_id;
            
            if(!$this->ultimo_id_usuario){
                echo "Error: No se obtuvo el ID del usuario";
                return false;
            }
            
            // SEGUNDO INSERT: Correo
            $consulta2 = "INSERT INTO correo_usuario (id_correo_usuario, correo, fk_usuario, estatus) 
                          VALUES (null, '{$correo}', {$this->ultimo_id_usuario}, 1)";
            
            $respuesta_correo = $this->conexion->query($consulta2);
            
            if(!$respuesta_correo){
                echo "Error al insertar correo: " . $this->conexion->error;
                return false;
            }
            
            return true;
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
            $consulta = "SELECT u.*, c.correo FROM usuario u LEFT JOIN correo_usuario c ON c.fk_usuario = u.id_usuario AND c.estatus=1 WHERE id_usuario = {$id_usuario}";
            $respuesta = $this->conexion->query($consulta);
            $usuario = $respuesta->fetch_assoc();
            return $usuario;
        }

        function editar($id_usuario, $nombre, $password, $correo, $foto, $rol){
            $consulta = "UPDATE usuario SET nombre = '$nombre', password = '$password', foto = '$foto', fk_rol = '$rol' WHERE id_usuario = $id_usuario";
            $respuesta = $this->conexion->query($consulta);
            
            $consulta = "UPDATE correo_usuario SET estatus = 0 WHERE fk_usuario = {$id_usuario}";
            $respuesta = $this->conexion->query($consulta);

            $consulta = "INSERT INTO correo_usuario (id_correo_usuario, correo, fk_usuario, estatus) VALUES (null, '{$correo}', '{$id_usuario}', 1);";
            $respuesta = $this->conexion->query($consulta);

            return $respuesta;
        }
        
        function eliminar($id_usuario){
            $consulta = "UPDATE usuario SET estatus = 0 WHERE id_usuario = {$id_usuario}";
            $respuesta = $this->conexion->query($consulta);
            return $respuesta;
        }
        
        function login($user, $contra){
            $consulta ="SELECT * FROM usuario WHERE (nombre='{$user}' AND password='{$contra}') ";
            $respuesta = $this->conexion->query($consulta);
            return $respuesta;
        }

        // ⭐ MÉTODO ARREGLADO
        public function obtenerUltimoId() {
            return $this->ultimo_id_usuario;
        }
    }
?>