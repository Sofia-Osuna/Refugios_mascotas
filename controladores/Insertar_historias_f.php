<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $descripcion = $_POST["descripcion"];
    $fk_mascota = $_POST["fk_mascota"];
    
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    
    $foto = $_FILES["Foto"]["name"];
    $tmp = $_FILES["Foto"]["tmp_name"];
    
    if($foto != ""){
        $ruta = "../imagenes_animales/" . $foto;
        move_uploaded_file($tmp, $ruta);
    } else {
        $foto = "sin_foto.jpg";
    }

    include ('../clases/Historias_f.php');
    $clase = new HistoriaFeliz();
    $resultado = $clase->guardar($descripcion, $fecha, $hora, $foto, $fk_mascota);

    if($resultado){
        header('location: ../Lista_historia_feliz.php');
    }else{
        echo "Error";
    }
?>