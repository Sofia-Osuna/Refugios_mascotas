<?php
/*
Adaptado para la tabla especie
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../clases/Conexion.php");
$mysqli = new Conexion();

// Si necesitas filtrar por algún parámetro en el futuro, puedes usar:
// $id_especie = $_POST['id_especie'] ?? null;

$consulta = "SELECT id_especie, nombre FROM especie ORDER BY nombre ASC";
$resultado = $mysqli->query($consulta);

$html = "<option value='0'>Selecciona una especie</option>";
while($fila = $resultado->fetch_assoc()){
    $html .= "<option value='".$fila['id_especie']."'>".$fila['nombre']."</option>";
}
echo $html;
?>