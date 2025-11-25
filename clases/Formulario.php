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

        function guardar($fk_refugio, $nombre, $descripcion){
            $consulta = "INSERT INTO formulario_refugio (id_formulario_refugio, fk_refugio, nombre_formulario, descripcion, fecha, estatus) VALUES (null, '{$fk_refugio}', '{$nombre}', '{$descripcion}', CURDATE(), 1)";
            $respuesta = $this -> conexion -> query($consulta);
            $id = mysqli_insert_id($this->conexion);
            return $id;
        }
        //stmt significa statement en ingles xdxd, se usa más como nombre de variable porque pues es ingles xdxd.
        //como el elote preparado.
        function mostrar(){
            $consulta ="SELECT id_formulario FROM formulario_refugio WHERE fk_refugio=$fk_refugio AND estatus = 1";
            $respuesta = $this -> conexion -> query($consulta);
            return $respuesta;
        }
        //tambien elimina las preguntas de una vez, relacionadas a todo el formulario
        function eliminar($id_formulario){
            $consulta1 = "UPDATE preguntas_formulario SET estatus = '0' WHERE fk_formulario_refugio = ?";
            $stmt1 = $this->conexion->prepare($consulta1);
            $stmt1->bind_param("i", $id_formulario);
            $stmt1->execute();
    
            $consulta2 = "UPDATE formulario_refugio SET estatus = '0' WHERE id_formulario_refugio = ?";
            $stmt2 = $this->conexion->prepare($consulta2);
            $stmt2->bind_param("i", $id_formulario);
    
            return $stmt2->execute();
        }

        function actualizar($id_formulario, $nombre_formulario, $descripcion){
            $consulta = "UPDATE formulario_refugio 
                 SET nombre_formulario = ?, 
                     descripcion = ?
                 WHERE id_formulario_refugio = ?";
    
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bind_param("ssi", $nombre_formulario, $descripcion, $id_formulario);
    
            return $stmt->execute();
        }

        function Id($id_formulario){
            $consulta = "SELECT * FROM formulario_refugio 
                 WHERE id_formulario_refugio = ?";
    
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bind_param("i", $id_formulario);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            return $resultado->fetch_assoc();
            }
    }
?>