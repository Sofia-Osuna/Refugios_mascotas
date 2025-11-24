<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_formulario = $_POST["id_formulario"];
$id_refugio = $_POST["id_refugio"];
$nombre_formulario = $_POST["nombre_formulario"];
$descripcion = $_POST["descripcion"];

include('../clases/Formulario.php');
$clase = new Formulario();

$resultado = $clase->actualizar($id_formulario, $nombre_formulario, $descripcion);

if($resultado){
    header('Location: ../Detalle_formulario.php?id_refugio=' . $id_refugio);
} else {
    echo "Error al actualizar el formulario";
}
?>