<!-- Aqui se pueden ver TODA la informacion de una mascota, incluido el boton de adoptar, o editar -->
 <?php
include('menu.php');
require_once('clases/Mascota.php');

$id = $_GET['id'];
$id_refugio = $_GET['id_refugio'];

$mascota_obj = new Mascota();
$mascota = $mascota_obj->obtenerMascota($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Mascota</title>
</head>
<body>
    <h1>Detalle de la Mascota</h1>
    
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        
        <img src="imagenes_animales/<?= $mascota['foto'] ?>" width="400" style="display: block; margin: 20px 0;">
        
        <h2><?= $mascota['nombre'] ?></h2>
        
<p><strong>Especie:</strong> <?= $mascota['nombre_especie'] ?></p>
        
        <h3>Descripción:</h3>
        <p><?= $mascota['descripcion'] ?></p>
        
        <br><br>
        
        <h3>Acciones</h3>
        <a href="Lista_mascota.php?id_refugio=<?= $id_refugio ?>"style="color: black; text-decoration: none;"> Adoptar </a> |
        <a href="editar_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>">Editar</a> |
        <a href="controladores/eliminar_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>">Eliminar</a>
        
    </div>

<?php
include('Pie_pagina.php');
?>

</body>
</html>