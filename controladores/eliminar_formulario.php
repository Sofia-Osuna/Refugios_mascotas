<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    $id_formulario= $_GET["id_formulario_refugio"];
    $id_refugio = $_GET["id_refugio"];


    include ('../clases/Formulario.php');
    $clase = new Formulario();
    $resultado = $clase->eliminar($id_formulario);

    if($resultado){
        header('location: ../Detalle_formulario.php?id_refugio=' . $id_refugio);
    }else{
        echo "Error";
        
    }
?>