<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET["id"];
$fk_refugio = $_GET["fk_refugio"]; // AGREGAR ESTO

include ('../clases/Historias_f.php');
$clase = new HistoriaFeliz();
$resultado = $clase->eliminar($id);

if($resultado){
    header('location: ../Lista_historia_feliz.php?id_refugio=' . $fk_refugio);
}else{
    echo "Error";
}
?>