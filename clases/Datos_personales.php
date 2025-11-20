<!-- esto es para que el usuario llene sus datos personales dentro de la pagina del refugio -->
<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Mascota{
        private $conexion;
    
        function __construct(){
            require_once('conexion.php');
            $this->conexion = new Conexion();
        }

        function guardar(){
            
        }
    }
?>