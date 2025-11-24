<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    $id_pregunta = $_GET['id_pregunta'];
    $id_refugio = $_GET['id_refugio'];

    include ('../clases/Preguntas_form.php');
    $clase = new Preguntas();
    $resultado = $clase->eliminar($id_pregunta);

    if($resultado){
        header('location: ../Detalle_formulario.php?id_refugio=' . $id_refugio);
    }else{
        echo "Error";
        
    }
?>