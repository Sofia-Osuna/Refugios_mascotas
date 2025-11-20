<?php
require_once('clases/Mascota.php');

$id_refugio = $_GET['id_refugio'];



$clase = new Mascota();
$mascotas = $clase->mostrarPorRefugio($id_refugio);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mascotas</title>
</head>
<body>
    <h1>Lista de Mascotas del Refugio</h1>
    
<a href="Formulario_mascota.php?id_refugio=<?= $id_refugio ?>">+ Nueva Mascota</a>
    
    <br><br>
    <table border="1" width="100%">
    <thead>
        <tr>
            <th>Foto</th>

            <th>Nombre</th>

            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(count($mascotas) > 0){
            foreach($mascotas as $mascota){ 
        ?>
            <tr>
                <td>
                    <img src="imagenes_animales/<?= $mascota['foto'] ?>" width="100" height="100">
                </td>
                <td><?= $mascota['nombre'] ?></td>
                <td>
                    <a href="Detalle_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>">Ver Detalles</a>
                </td>
            </tr>
        <?php 
            }
        } else {
        ?>
            <tr>
                <td colspan="6">No hay mascotas registradas en este refugio</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>