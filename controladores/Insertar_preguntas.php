<?php
  error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $pregunta = $_POST["pregunta"];
    $fk_formulario = $_POST["fk_formulario"];
    $numero_pregunta = $_POST["numero_pregunta"];

    include('../clases/Preguntas_form.php');
    $clase = new Preguntas();
    $resultado = $clase->guardar($fk_formulario, $pregunta, $numero_pregunta );


    

    if($resultado){
        header('location: ../Formulario_preguntas.php?id_formulario=' . $fk_formulario);
    }else{
        echo "Error";
    }


?>