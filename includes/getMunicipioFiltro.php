<?php
/*
para hacer el filtadro de especie vas a necesitar hacer un archivo como este xdxd, copias y cambias 
-sofi
*/ 
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    require("../clases/Conexion.php");
    $mysqli = new Conexion();
    $id_estado = $_POST['id_estado'];
     
    $consultam = "SELECT nombre, id_municipio FROM municipio WHERE fk_estado = '$id_estado' ORDER BY nombre ASC ";
    $resultadom = $mysqli->query($consultam);

    $html = " <option value='0'>Selecciona un municipio</option>";
    while($fila = $resultadom -> fetch_assoc()){
        $html .= " <option value=".$fila['nombre'].">".$fila['nombre']."</option>";
        
    }
    echo $html;
?>