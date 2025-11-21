<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);
    $id_refugio = $_POST["id_refugio"];

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
        header('location: ../Lista_refugio.php');
       
    }else{
        echo"Error";
    }


?>