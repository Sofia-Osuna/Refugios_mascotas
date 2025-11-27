<?php
$id_usuario = $_SESSION['id_usuario']; // O como lo tengas guardado

// Verificar que esté logueado
if(!isset($_SESSION['id_usuario'])) {
    header('location: login.php');
    exit;
}
?>