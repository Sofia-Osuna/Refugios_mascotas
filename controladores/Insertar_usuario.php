<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];
    
    // Seguridad: Si no es admin, solo puede elegir rol 2 o 3
    if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 1){
        if($rol == 1){
            $rol = 2;
        }
    }
    
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];

    if($foto != ""){
        $ruta = "../img_usuarios/" . $foto;
        
        $directorio_imagenes = dirname($ruta);
        
        if (!is_writable($directorio_imagenes) && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            @chmod($directorio_imagenes, 0755);
        }
        
        if(!move_uploaded_file($tmp, $ruta)){
            $extension = pathinfo($foto, PATHINFO_EXTENSION);
            $nombre_unico = uniqid() . '.' . $extension;
            $ruta_alternativa = "../img_usuarios/" . $nombre_unico;
            
            if(move_uploaded_file($tmp, $ruta_alternativa)){
                $foto = $nombre_unico;
            } else {
                $foto = "sin_foto.jpg";
            }
        }
    } else {
        $foto = "sin_foto.jpg";
    }
    
    include('../clases/Usuario.php');
    $clase = new Usuario();
    $resultado = $clase->guardar($nombre, $password, $correo, $foto, $rol);

    if($resultado){
        if(!isset($_SESSION['username'])){
            $_SESSION['idusuario'] = $clase->obtenerUltimoId();
            $_SESSION['username'] = $nombre;
            $_SESSION['correo'] = $correo;
            $_SESSION['fk_rol'] = $rol;
            
            //  CORREGIDO: Redirigir según el rol
            if($rol == 3){
                // Gestor de refugio -> va a crear su refugio
                header('location: ../index.php');
            } else {
                // Usuario normal -> va al index
                header('location: ../index.php');
            }
        } else {
            header('location: ../Lista_usuario.php');
        }
    } else {
        echo "Error";
    }
?>
