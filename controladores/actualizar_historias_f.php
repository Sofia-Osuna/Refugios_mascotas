<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $id_historia = $_POST["id_historia"];
    $descripcion = $_POST["descripcion"];
   
    $fk_mascota = $_POST["fk_mascota"];
    
    // Manejar la foto
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];
    
    if($foto != ""){
        $ruta = "../imagenes_animales/" . $foto;
        move_uploaded_file($tmp, $ruta);
    } else {
        // Mantener foto anterior
        include ('../clases/Historias_f.php');
        $clase_temp = new HistoriaFeliz();
        $historia_actual = $clase_temp->obtenerHistoria($id_historia);
        $foto = $historia_actual['foto'];
    }

    include ('../clases/Historias_f.php');
    $clase = new HistoriaFeliz();
    $resultado = $clase->actualizar($id_historia, $descripcion, $fecha, $hora, $foto, $fk_mascota);

    if($resultado){
        header('location: ../Lista_historia_feliz.php');
    }else{
        echo "Error";
    }
?>