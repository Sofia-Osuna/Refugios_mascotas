<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];

    //if que me dio la ia para que funcione en mac os xd
    if($foto != ""){
    $ruta = "../img_usuarios/" . $foto;
    
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
    $resultado = $clase ->guardar($nombre, $password, $correo,$foto);
   
   

    if($resultado){
        header('location: ../Lista_usuario.php');
    }else{
        echo"Error";
    }

?>