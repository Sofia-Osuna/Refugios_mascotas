<?php
error_reporting(E_ALL); //esto es para que me muestre los errores
ini_set('display_errors', 1);

$id_refugio = $_POST['id_refugio'];
$id_formulario = $_POST['id_formulario'];
$id_mascota = $_POST['id_mascota'];
$id_usuario= $_POST['id_usuario'];
$id_adopcion = $_POST['id_adopcion'] ?? $_GET['id_adopcion'] ?? null; //recibir de ambas maneras pq no jala
$preguntas = $_POST['preguntas'];

// DEBUG de lo que llega en preguntas
echo "<pre>DEBUG PREGUNTAS: ";
print_r($_POST['preguntas']);
echo "</pre>";

// También debug de todo POST
echo "<pre>DEBUG TODO POST: ";
print_r($_POST);
echo "</pre>";

include('../clases/Respuestas.php');
$clase = new Respuestas();
$resultado = $clase->guardar($preguntas, $id_adopcion);

if($resultado) {
    header('location: ../Lista_mis_adopciones.php?id_usuario=' . $id_usuario);
} else {
    echo "Error al guardar respuestas";
}
?>