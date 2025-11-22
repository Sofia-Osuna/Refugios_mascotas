<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    $id_usuario = $_POST['id_usuario'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $password = $_POST['password'] ?? null;
    $correo = $_POST['correo'] ?? null;
    $foto = $_FILES["foto"]["name"];
    $tmp = $_FILES["foto"]["tmp_name"];

    require_once('../clases/Usuario.php');
    if($foto != ""){
        $ruta = "../img_usuarios/" . $foto;
        move_uploaded_file($tmp, $ruta);
    } else {
        // Mantener foto anterior
        $clase_temp = new Usuario();
        $mascota_actual = $clase_temp->obtenerPorId($id_usuario);
        $foto = $mascota_actual['foto'];
    }
    $clase = new Usuario();
    $resultado = $clase->editar($id_usuario, $nombre, $password, $correo,$foto);

    if($resultado){
    header('location: ../Lista_usuario.php?msg=actualizado');
} else {
    echo "Error al actualizar";
}
?>