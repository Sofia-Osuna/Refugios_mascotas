<?php
session_start();
require_once('../clases/Refugio.php');

// Verificar que esté logueado
if(!isset($_SESSION['idusuario'])){
    header('location: ../Inicio_sesion.php');
    exit;
}

$id = $_GET['id_refugio'];
$refugio_obj = new Refugio();

// Verificar que el refugio le pertenezca (excepto si es admin)
if($_SESSION['fk_rol'] != 1){ // Si NO es admin
    if(!$refugio_obj->esDelUsuario($id, $_SESSION['idusuario'])){
        die(" No tienes permiso para eliminar este refugio. <a href='../mis_refugios.php'>Volver a mis refugios</a>");
    }
}

if($refugio_obj->eliminar($id)){
    header("Location: ../mis_refugios.php");
} else {
    echo "Error al eliminar el refugio";
}
?>