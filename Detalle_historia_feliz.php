<!-- Aqui se ve todaaaaa la información de una historia feliz, incluye el boton que lleva a la pagina de editar -->
 <?php
include('menu.php');
require_once('clases/Historias_f.php');
$id = $_GET['id'];

$historia_obj = new HistoriaFeliz();
$historia = $historia_obj->obtenerHistoria($id);

// Obtener nombre de la mascota
$mascota_id = $historia['fk_mascota'];
$consulta_mascota = "SELECT nombre FROM mascotas WHERE id_mascotas = $mascota_id";
// Aquí necesitarías obtener el nombre, lo agrego en el método
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle Historia Feliz</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <h1>Historia Feliz</h1>

    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        
        <h2>Mascota: <?= $historia['nombre_mascota'] ?? 'N/A' ?></h2>
        
        <img src="imagenes_animales/<?= $historia['foto'] ?>" width="400" style="display: block; margin: 20px 0;">
        
        <p><strong>Fecha:</strong> <?= $historia['fecha'] ?></p>
        <p><strong>Hora:</strong> <?= $historia['hora'] ?></p>
        
        <h3>Descripción:</h3>
        <p><?= $historia['descripcion'] ?></p>
        
        <br><br>
        
        <a href="Lista_historia_feliz.php">← Volver a historias</a> |
        <a href="editar_historias_felices.php?id=<?= $historia['id_historia_feliz'] ?>">Editar</a> |
        <a href="controladores/eliminar_historias_f.php?id=<?= $historia['id_historia_feliz'] ?>">Eliminar</a>
        
    </div>

<?php
include('Pie_pagina.php');
?>

</body>
</html>