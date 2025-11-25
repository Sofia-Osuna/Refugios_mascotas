<?php
    error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Verificar que esté logueado
if(!isset($_SESSION['idusuario'])){
    header('location: ../Inicio_sesion.php');
    exit;
}

$id_refugio = $_POST["id_refugio"];

require_once('../clases/Refugio.php');
$clase_validar = new Refugio();

// Verificar que el refugio le pertenezca (excepto si es admin)
if($_SESSION['fk_rol'] != 1){ // Si NO es admin
    if(!$clase_validar->esDelUsuario($id_refugio, $_SESSION['idusuario'])){
        die(" No tienes permiso para actualizar este refugio. <a href='../mis_refugios.php'>Volver a mis refugios</a>");
    }
}

// Si pasa la validación, continuar con la actualización
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

    $colonia = $_POST['cbx_colonia'];//checar esto temprano por que no se si funciones
    $nombre_calle = $_POST["nombre_calle"];
    $numero_exterior = $_POST["numero_exterior"];
    $numero_interior = $_POST["numero_interior"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
$foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];

    //if que me dio la ia para que funcione en mac os xd
    if($foto != ""){
    $ruta = "../img_refugio/" . $foto;
    
    // SOLUCIÓN MAC: Verificar y ajustar permisos silenciosamente
    $directorio_imagenes = dirname($ruta);
    
    // Si no se puede escribir, intentar cambiar permisos (solo en macOS)
    if (!is_writable($directorio_imagenes) && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
        @chmod($directorio_imagenes, 0755);
    }
    
    if(!move_uploaded_file($tmp, $ruta)){
        // Si falla, usar nombre único para evitar conflictos de permisos
        $extension = pathinfo($foto, PATHINFO_EXTENSION);
        $nombre_unico = uniqid() . '.' . $extension;
        $ruta_alternativa = "../img_refugio/" . $nombre_unico;
        
        if(move_uploaded_file($tmp, $ruta_alternativa)){
            $foto = $nombre_unico;
        } else {
            $foto = "sin_foto.jpg";
        }
    }
    } else {
        $foto = "sin_foto.jpg";
    }

    include ('../clases/Refugio.php');
    $clase = new Refugio();
    $resultado = $clase ->actualizar($id_refugio,$nombre,  $descripcion, $colonia, $nombre_calle,  $numero_exterior, $numero_interior, $telefono, $correo,$foto);

    if($resultado){
        header('location: ../mis_refugios.php');
       
    }else{
        echo"Error";
    }


?>