<?php
// Activar buffer para capturar cualquier salida accidental
ob_start();

session_start();

// Verificar que existan los campos del formulario
if (!isset($_POST["user"]) || !isset($_POST["contra"])) {
    ob_end_clean();
    header('location: ../Inicio_sesion.php?error=vacio');
    exit;
}

$user = $_POST["user"];
$contra = $_POST["contra"];

// Validar que no estén vacíos
if(empty($user) || empty($contra)){
    ob_end_clean();
    header('location: ../Inicio_sesion.php?error=vacio');
    exit;
}

include ("../clases/Usuario.php");

$clase = new Usuario();
$resultado = $clase->login($user, $contra);

// Verificar si la consulta fue exitosa
if ($resultado === false) {
    ob_end_clean();
    header('location: ../Inicio_sesion.php?error=error_consulta');
    exit;
}

if(mysqli_num_rows($resultado) > 0){
    $datos = mysqli_fetch_assoc($resultado);
    
    // Verificar que $datos tenga la clave 'correo'
    if (!isset($datos['correo'])) {
        // Si no tiene 'correo', usar un valor por defecto o dejar vacío
        $datos['correo'] = '';
    }
    
    // Login exitoso
    $_SESSION['idusuario'] = $datos['id_usuario'];
    $_SESSION['username'] = $datos['nombre'];
    $_SESSION['correo'] = $datos['correo'];  // Línea 23 original
    $_SESSION['fk_rol'] = $datos['fk_rol'];
    
    // Limpiar buffer antes de redirigir
    ob_end_clean();
    
    // Redirigir (manteniendo tu lógica original)
    if($_SESSION['fk_rol'] == 2){
        header('location: ../index.php');
    } else {
        header('location: ../index.php');
    }
    exit;
} else {
    // Usuario o contraseña incorrectos
    ob_end_clean();
    header('location: ../Inicio_sesion.php?error=incorrecto');
    exit;
}