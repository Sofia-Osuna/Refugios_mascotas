<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include('../clases/Datos_personales.php');


    $nombre = $_POST["nombre"];
    $ap = $_POST['apellidop']; //apellido paterno pues
    $am = $_POST['apellidom'];
    $telefono =$_POST['telefono'];
    $edad = $_POST['edad'];
    $fnac = $_POST['fecha_nac'];
    //direccion
    //$ = $_POST['cbx_estado']; se me olvido que no necesito insertar estado ni municipio, colonia viene ya con esa informacion
    //$ = $_POST['cbx_municipio'];
    $colonia = $_POST['cbx_colonia'];
    $nombre_calle = $_POST['nombre_calle'];
    $n_exterior = $_POST['numero_exterior'];
    $n_interior = $_POST['numero_interior'];
    //el id de usuarioooo
    $id_usuario = $_POST['id_usuario'];

    $clase = new Datos();
    $resultado = $clase->guardar($nombre, $ap, $am, $edad, $fnac, $colonia, $nombre_calle, $n_exterior, $n_interior, $id_usuario, $telefono);

    if($resultado){
        header('location: ../Datospersonales.php');
    }else{
        echo" ERROR";
    }
?>