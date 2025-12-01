<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    $accion = $_GET['accion'];
    $id_mascota = $_GET['id_mascota'];
    $id_mascotas_adopcion= $_GET['id_adopcion'];
    $id_adopcion = $_GET['id_mascotas_adopcion'];
    $id_refugio = $_GET['id_refugio'];

    include('../clases/Adopcion.php');
    $clase = new Adopcion();

    if($accion == 'rechazar'){
      $respuesta = $clase ->  rechazar($id_adopcion, $id_mascota, $id_mascotas_adopcion);
      if(is_array($respuesta) && isset($respuesta['exito']) && $respuesta['exito']){
       header('location: ../Lista_respuesta_refugio.php?id_refugio='.$id_refugio);
      }else{
        echo"Error al cambiar el estatus de la mascota";
        var_dump($respuesta);
      }
    }elseif ($accion == 'aceptar'){
        $respuesta = $clase ->  aceptar($id_adopcion, $id_mascota);
        if(is_array($respuesta) && isset($respuesta['exito']) && $respuesta['exito']){
            header('location: ../Lista_respuesta_refugio.php?id_refugio='.$id_refugio);
        }else{
            echo"Error al cambiar el estatus de la mascota";
            var_dump($respuesta);
        }
    }elseif($accion == 'en_revision'){
        $respuesta = $clase ->  enRevision($id_adopcion, $id_mascota, $id_mascotas_adopcion);
        if($respuesta){
            header('location: ../Lista_respuesta_refugio.php?id_refugio='.$id_refugio);
        }else{
            echo"Error al cambiar el estatus de la mascota";
        }
    }
    
?>