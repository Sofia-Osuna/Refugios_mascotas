<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];
    
    // Seguridad: Si no es admin, no puede cambiar el rol
    if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 1){
        // Mantener el rol que ya tenía
        require_once('../clases/Usuario.php');
        $clase_temp = new Usuario();
        $usuario_actual = $clase_temp->obtenerPorId($id_usuario);
        $rol = $usuario_actual['fk_rol'];
    }
    
    // Manejar la foto
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];
    
    require_once('../clases/Usuario.php');
    
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
        // Mantener foto anterior
        $clase_temp = new Usuario();
        $usuario_actual = $clase_temp->obtenerPorId($id_usuario);
        $foto = $usuario_actual['foto'];
    }
    
    $clase = new Usuario();
    $resultado = $clase->editar($id_usuario, $nombre, $password, $correo, $foto, $rol);

    if($resultado){
        // Si el usuario está editando su propio perfil
        if(isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $id_usuario){
            // Actualizar los datos de la sesión
            $_SESSION['username'] = $nombre;
            $_SESSION['correo'] = $correo;
            header('location: ../Datospersonales.php');
        } else {
            // Si es un admin editando a otro usuario
            header('location: ../Lista_usuario.php');
        }
    } else {
        echo "Error";
    }
?>