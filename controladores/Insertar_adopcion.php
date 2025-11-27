<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('../clases/Adopcion.php');


    $id_usuario = $_GET['id_usuario'];
    $id_mascota = $_GET['id_mascota'];

    $clase = new Adopcion();
    $resultado = $clase->guardar($id_usuario, $id_mascota);


    //IMPORTANTE 
    //mientras que la parte de respuestas esta lista, esta te va amnadar al apartado "mis adopciones"
    if($resultado){
        header('location: ../Lista_mis_adopciones.php');
    }else{
        echo" ERROR";
    }
?>