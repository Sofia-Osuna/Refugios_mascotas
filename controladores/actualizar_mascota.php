<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $id_mascota = $_POST["id_mascota"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $fk_especie = $_POST["fk_especie"];
    $id_refugio = $_POST["id_refugio"];
    $estatus = $_POST["estatus"]; // Nuevo campo
    
    // Manejar la foto
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];
    
    require_once('../clases/Mascota.php');  // UNA SOLA VEZ
    
    if($foto != ""){
        $ruta = "../imagenes_animales/" . $foto;
        move_uploaded_file($tmp, $ruta);
    } else {
        // Mantener foto anterior
        $clase_temp = new Mascota();
        $mascota_actual = $clase_temp->obtenerMascota($id_mascota);
        $foto = $mascota_actual['foto'];
    }

    $clase = new Mascota();
    $resultado = $clase->actualizar($id_mascota, $nombre, $descripcion, $foto, $fk_especie, $estatus);

    if($resultado){
        header('location: ../Lista_mascota.php?id_refugio=' . $id_refugio);
    }else{
        echo "Error";
    }
?>