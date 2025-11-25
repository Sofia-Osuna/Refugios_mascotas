<?php
session_start();
require_once('../clases/Historias_f.php');

if($_POST){
    $descripcion = $_POST['descripcion'];
    $fk_mascota = $_POST['fk_mascota'];
    $fk_refugio = $_POST['fk_refugio'];
    
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    
    // Procesar la foto - MISMITO que en actualizar
    $foto = $_FILES["Foto"]["name"];
    $tmp = $_FILES["Foto"]["tmp_name"];
    
    if($foto != ""){
        $ruta = "../imagenes_animales/" . $foto;
        move_uploaded_file($tmp, $ruta);
    } else {
        $foto = "sin_imagen.jpg";
    }
    
    $historia_obj = new HistoriaFeliz();
    
    $resultado = $historia_obj->guardar($descripcion, $fecha, $hora, $foto, $fk_mascota, $fk_refugio);
    
    if($resultado){
        header('location: ../Lista_historia_feliz.php?success=1&id_refugio=' . $fk_refugio);
    } else {
        header('location: ../Formulario_historias_felices.php?error=1&id_refugio=' . $fk_refugio);
    }
} else {
    header('location: ../Formulario_historias_felices.php');
}
?>