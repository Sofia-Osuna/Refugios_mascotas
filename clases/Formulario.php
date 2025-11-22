<!-- Esta clase es para las preguntas dinamicas de los formularios -->
 <?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Formulario{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();

        }

        function guardar(){
            $consulta = "INSERT INTO formulario_adopcion";
            $respuesta = $this -> conexion -> query($consulta);;
        }

    }
?>