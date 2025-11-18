<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    require("../clases/Conexion.php");
    $mysqli = new Conexion();
    $id_municipio = $_POST['id_municipio'];
     
    $consultac = "SELECT nombre, id_colonia FROM colonia WHERE fk_municipio = '$id_municipio' ORDER BY nombre ASC ";
    $resultadoc = $mysqli->query($consultac);

    $html = " <option value='0'>Selecciona una localidad o colonia</option>";
    while($fila = $resultadoc -> fetch_assoc()){
        $html .= " <option value=".$fila['id_colonia'].">".$fila['nombre']."</option>";
    }
    echo $html;
?>