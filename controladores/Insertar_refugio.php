<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    session_start();

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $colonia = $_POST["cbx_colonia"];
    $nombre_calle = $_POST["nombre_calle"];
    $numero_exterior = $_POST["numero_exterior"];
    $numero_interior = $_POST["numero_interior"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    
    // Obtener el ID del usuario logueado
    $id_usuario = $_SESSION['idusuario'];
    
    // Manejar la foto
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];

    if($foto != ""){
        $ruta = "../img_refugio/" . $foto;
        
        if(!move_uploaded_file($tmp, $ruta)){
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
    
    include('../clases/Refugio.php');
    $clase = new Refugio();
    
    // Pasar el id_usuario al método guardar
    $resultado = $clase->guardar($nombre, $descripcion, $colonia, $nombre_calle, $numero_exterior, $numero_interior, $telefono, $correo,$foto, $id_usuario);

    if($resultado){
        header('location: ../mis_refugios.php');
    }else{
        echo "Error al guardar";
    }
?>