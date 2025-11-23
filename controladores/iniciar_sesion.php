<?php
session_start();

$user = $_POST["user"];
$contra = $_POST["contra"];

// Validar que no estén vacíos
if(empty($user) || empty($contra)){
    header('location: ../Inicio_sesion.php?error=vacio');
    exit;
}

include ("../clases/Usuario.php");

$clase = new Usuario();
$resultado = $clase->login($user, $contra);
$datos = mysqli_fetch_assoc($resultado);

if(mysqli_num_rows($resultado) > 0){
    // Login exitoso
    $_SESSION['idusuario'] = $datos['id_usuario'];
    $_SESSION['username'] = $datos['nombre'];
    $_SESSION['correo'] = $datos['correo'];
    $_SESSION['fk_rol'] = $datos['fk_rol'];
    
    if($_SESSION['fk_rol'] == 2){
        header('location: ../index.php');
    } else {
        header('location: ../index.php');
    }
} else {
    // Usuario o contraseña incorrectos
    header('location: ../Inicio_sesion.php?error=incorrecto');
}
?>