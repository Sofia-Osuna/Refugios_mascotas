<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('../clases/Adopcion.php');

    $id_refugio= $_GET['id_refugio'];
    $id_usuario = $_GET['id_usuario'];
    $id_mascota = $_GET['id_mascota'];

    $clase = new Adopcion();
    $fk_adopcion = $clase->guardar($id_usuario, $id_mascota);


    // ahora te tiene que mandar alllll formulario de respuestas
    if($fk_adopcion){
        
        header('location: ../Formulario_respuesta.php?id_adopcion='. $fk_adopcion . '&id_refugio=' .$id_refugio . '&id_mascota='. $id_mascota . '&id_usuario=' . $id_usuario);
    }else{
        echo" ERROR";
    }
?>