<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Direccion{
        public $conexion; 
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();

        }
        public function getConexion() {
            return $this->conexion;
        }

        function mostrarE(){
            //mostrar estado xdxd
            $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
            $respuesta = $this -> conexion -> query($consulta);
        }

    }

    //aqui pensaba meter todas la consultas para los selects dinamicos, pero me decidi apegar al tutorial
    //la voy a dejar por se necesita luego -sofía
?>