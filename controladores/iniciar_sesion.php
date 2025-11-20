<?php
    $user = $_POST["user"];
    $contra = $_POST["contra"];


    include ("../clases/Usuario.php");

    $clase = new Usuario();

    $resultado = $clase->login($user,$contra);
?>