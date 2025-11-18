<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    //$foto = $_POST["foto"];
    //lo de foto esta pendiente
    $colonia = $_POST['cbx_colonia'];//checar esto temprano por que no se si funciones
    $nombre_calle = $_POST["nombre_calle"];
    $numero_exterior = $_POST["numero_exterior"];
    $numero_interior = $_POST["numero_interior"];


    include ('../clases/Refugio.php');
    $clase = new Refugio();
    $resultado = $clase ->guardar($nombre,  $descripcion, $colonia, $nombre_calle,  $numero_exterior, $numero_interior );

    if($resultado){
        header('location: ../Lista_refugio.php');
       
    }else{
        echo"Error";
    }


?>