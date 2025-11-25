<?php
session_start();
require_once('../clases/Historias_f.php');

if($_POST){
    $descripcion = $_POST['descripcion'];
    $fk_mascota = $_POST['fk_mascota'];
    $fk_refugio = $_POST['fk_refugio'];
    

    
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    
    // Procesar la foto
    $foto = "";
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../imagenes_animales/" . $foto);
    }
    
    $historia_obj = new HistoriaFeliz();
    
    // Llamar al método guardar con fecha y hora automáticas
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