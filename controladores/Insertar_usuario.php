<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    
    if (ob_get_length()) {
        ob_end_clean();
    }

    $nombre = $_POST["nombre"] ?? '';
    $password = $_POST["password"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $rol = $_POST["rol"] ?? 2;
    
    // Seguridad: Si no es admin, solo puede elegir rol 2 o 3
    if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 1){
        if($rol == 1){
            $rol = 2;
        }
    }
    
    $foto = $_FILES["foto"]["name"] ?? '';
    $tmp = $_FILES["foto"]["tmp_name"] ?? '';

    if($foto != "" && $tmp != ""){
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
        $id_usuario = $clase->obtenerUltimoId();
        $datos_usuario = $clase->obtenerPorId($id_usuario);
        
        if(!$datos_usuario){
            echo "Error: No se pudo recuperar los datos del usuario creado";
            exit();
        }
        
        // Si ya hay sesión activa (admin logeado creando usuario), no iniciar sesión
        if(isset($_SESSION['idusuario'])){
            // El admin ya estaba logeado, solo redirigir a la lista de usuarios
            header('Location: ../Lista_usuario.php?msg=creado');
            exit();
        } else {
            // No hay sesión activa, es un registro nuevo - iniciar sesión
            session_regenerate_id(true);
            session_unset();
            
            $_SESSION['idusuario'] = $datos_usuario['id_usuario'];
            $_SESSION['username'] = $datos_usuario['nombre'];
            $_SESSION['correo'] = $datos_usuario['correo'];
            $_SESSION['fk_rol'] = $datos_usuario['fk_rol'];
            $_SESSION['foto'] = $datos_usuario['foto'] ?? 'sin_foto.jpg';
            
            session_write_close();
            
            if($datos_usuario['fk_rol'] == 3){
                header('Location: ../index.php');
                exit();
            } else {
                header('Location: ../index.php');
                exit();
            }
        }
    } else {
        echo "Error al registrar usuario";
        exit();
    }
?>