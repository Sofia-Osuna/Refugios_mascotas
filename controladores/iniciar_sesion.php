<?php
    $user = $_POST["user"];
    $contra = $_POST["contra"];


    include ("../clases/Usuario.php");

    $clase = new Usuario();

$resultado = $clase->login($user,$contra);
$datos = mysqli_fetch_assoc($resultado);

if(mysqli_num_rows($resultado) > 0  ){ 
    session_start();
    //variable de sesion
    $_SESSION['idusuario'] =$datos['id_usuario'];
    $_SESSION['username'] = $datos['nombre'];
    $_SESSION['fk_rol'] = $datos['fk_rol'];
    if($_SESSION['fk_rol'] == 2){
    header('location: ../index.php');  
  }
    else{
        header('location:../formulario_producto.php');
    }
 }else{
    header('location: ../login.php');
}
?>