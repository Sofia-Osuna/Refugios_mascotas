<?php

 error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Respuestas{
        private $conexion; //esta solucion me la dio la ia, ojo
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('Conexion.php');
            $this -> conexion = new Conexion();

        }
        function guardar($preguntas, $id_adopcion) {

        if(empty($preguntas) || empty($id_adopcion)) {
            echo "Error: Preguntas o id vacíos";
            return false;
        }
        
        $todas_exitosas = true;
        
        foreach($preguntas as $pregunta) {
           
            if(empty($pregunta['id_pregunta']) || empty($pregunta['respuesta'])) {
                echo "Error: Pregunta incompleta";
                $todas_exitosas = false;
                continue;
            }
            
            $id_pregunta = $pregunta['id_pregunta'];
            $respuesta_texto = $pregunta['respuesta'];
            
            
            $consulta = "INSERT INTO respuestas_formulario (fk_adopcion, fk_pregunta, respuesta) 
                         VALUES (?, ?,  ?)";
            
            $stmt = $this->conexion->prepare($consulta);
            $stmt->bind_param("iis", $id_adopcion, $id_pregunta,  $respuesta_texto); //el sii significa String, Integer, Integer xdxdxdxd RECUERDA ESO
            $resultado = $stmt->execute();
            if(!$resultado) {
                echo "Error ejecutando consulta: " . $stmt->error;
                $todas_exitosas = false;
            }
            // $stmt->close();
        }
        
        return $todas_exitosas;
    }

    function mostrar($id_adopcion){
        $consulta = "SELECT pregunta, respuesta FROM respuestas_formulario rf 
        INNER JOIN preguntas_formulario pf ON rf.fk_pregunta=pf.id_pregunta 
        INNER JOIN formulario_refugio fr ON pf.fk_formulario_refugio = fr.id_formulario_refugio 
        WHERE rf.fk_adopcion = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("i", $id_adopcion); //el sii significa String, Integer, Integer xdxdxdxd RECUERDA ESO
        $stmt->execute(); //execute(); devuelve un true o un false
        $resultado = $stmt-> get_result(); 
        // sacarrr el resultado y ponerlos en un arreglooo
        $datos = [];
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        return $datos;
    }
    }
?>