<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_pregunta = $_POST["id_pregunta"];
$id_refugio = $_POST["id_refugio"];
$pregunta = $_POST["pregunta"];

include('../clases/Preguntas_form.php');
$clase = new Preguntas();

$resultado = $clase->editar($id_pregunta, $pregunta);

if($resultado){
    header('Location: ../Detalle_formulario.php?id_refugio=' . $id_refugio);
} else {
    echo "Error al actualizar el formulario";
}
?>