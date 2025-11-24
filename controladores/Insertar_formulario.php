<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $nombre = $_POST["nombre_formulario"];
    $fk_refugio = $_POST["fk_refugio"];
    $descripcion = $_POST['descripcion'];

    include('../clases/Formulario.php');
    $clase = new Formulario();
    $resultado = $clase->guardar($fk_refugio, $nombre, $descripcion);

    if($resultado){
        header('location: ../Formulario_preguntas.php?id_formulario=' . $resultado);
    }else{
        echo "Error";
    }


?>