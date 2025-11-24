<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Preguntas{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();
        }

        function guardar($fk_formulario, $pregunta, $numero_pregunta ){
            $consulta = "INSERT INTO preguntas_formulario (id_pregunta, fk_formulario_refugio, pregunta, numero_pregunta, estatus ) VALUES (null, '{$fk_formulario}', '{$pregunta}', '{$numero_pregunta}', 1)";
            $respuesta = $this -> conexion -> query($consulta);
            //$id = mysqli_insert_id($this->conexion);
            return $respuesta;
        }

        function contar($id_formulario){
            $consulta = "SELECT COUNT(*) as total 
                 FROM preguntas_formulario 
                 WHERE fk_formulario_refugio = ? AND estatus = '1'";
    
            $respuesta = $this->conexion->prepare($consulta);
            $respuesta->bind_param("i", $id_formulario);
            $respuesta->execute();
            $resultado = $respuesta->get_result()->fetch_assoc();
    
            return (int)$resultado['total'];
        }

        function mostrar($id_formulario){
            $consulta = "SELECT * FROM preguntas_formulario WHERE fk_formulario_refugio = $id_formulario AND estatus = 1";
            $respuesta = $this -> conexion -> query($consulta);
            return $respuesta;
        }

        function editar($id_pregunta, $pregunta){
            $consulta = "UPDATE preguntas_formulario SET pregunta = '$pregunta' WHERE id_pregunta = '$id_pregunta'";
            $respuesta = $this -> conexion -> query($consulta);
            return $respuesta;
        }

        function eliminar($id_pregunta){
            $consulta = "UPDATE preguntas_formulario SET estatus = '0' WHERE id_pregunta=$id_pregunta";
            $respuesta = $this -> conexion -> query($consulta);
            return $respuesta;
        }

        //voy a hacer una funcion unicamente para mostrar una pregunta kakakak
        function mostrarPregunta($id_pregunta){
            $consulta = "SELECT * FROM preguntas_formulario WHERE id_pregunta = $id_pregunta";
            $respuesta = $this->conexion->query($consulta);
    
            // Extraer los datos aquí mismo
            if($respuesta && $respuesta->num_rows > 0) {
                return $respuesta->fetch_assoc(); // Devuelve directamente el array asociativo
            } else {
                return null; // O false si no encuentra nada
            }
}
    }
?>