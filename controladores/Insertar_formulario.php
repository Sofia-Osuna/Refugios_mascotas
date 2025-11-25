<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión para poder pasar el id_refugio si es necesario
session_start();

$nombre = $_POST["nombre_formulario"];
$fk_refugio = $_POST["fk_refugio"];
$descripcion = $_POST['descripcion'];

include('../clases/Formulario.php');
$clase = new Formulario();
$resultado = $clase->guardar($fk_refugio, $nombre, $descripcion);

if($resultado){
    $_SESSION['id_refugio_actual'] = $fk_refugio;
    
    header('location: ../Formulario_preguntas.php?id_formulario=' . $resultado . '&id_refugio=' . $fk_refugio);
    exit;
}else{
    echo "Error al guardar el formulario";
}
?>