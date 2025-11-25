<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_pregunta = $_GET['id_pregunta'];
$id_refugio = $_GET['id_refugio'];
$id_formulario = $_GET['id_formulario']; // Necesitas agregar esta variable

// Verificar si viene el parámetro de redirección
$redireccion = isset($_GET['redireccion']) ? $_GET['redireccion'] : 'detalle';

include ('../clases/Preguntas_form.php');
$clase = new Preguntas();
$resultado = $clase->eliminar($id_pregunta);

if($resultado){
    if($redireccion == 'preguntas') {
        // Volver al formulario de preguntas
        header('location: ../Formulario_preguntas.php?id_formulario=' . $id_formulario . '&id_refugio=' . $id_refugio);
    } else {
        // Comportamiento original - ir al detalle
        header('location: ../Detalle_formulario.php?id_refugio=' . $id_refugio);
    }
    exit;
}else{
    echo "Error";
}
?>