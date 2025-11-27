<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');
include('clases/Adopcion.php');
$clase = new Adopcion();
$adopciones = $clase->mostrar();
echo"CORREGIRRRR pero pues esto es lo unico que le va a aparecer al usuario xdxd en el refugio es donde se edita esta vaina <br> luego en lugar id
me necesita mostrar el nombre del usuario, de la mascota y un boton para ver el detalle de la mascota? o algo asi ";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Adopciones</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📋 Mis Adopciones</h2>
        <span class="badge bg-primary"><?= count($adopciones) ?> registros</span>
    </div>
    
    <?php if(empty($adopciones)): ?>
        <div class="alert alert-info text-center">
            <h4>🐾 No hay adopciones registradas</h4>
            <p class="mb-0">Comienza adoptando una mascota hoy mismo.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead style="background-color: #85B79D; color: white;">
                    <tr>
                        <th>#</th>
                        <th>📅 Fecha</th>
                        <th>🕒 Hora</th>
                        <th>👤 Usuario</th>
                        <th>🐕 Mascota</th>
                        <th>📊 Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($adopciones as $adopcion): ?>
                    <tr>
                        <td><strong><?= $adopcion['id_adopcion'] ?></strong></td>
                        <td><?= date('d/m/Y', strtotime($adopcion['fecha'])) ?></td>
                        <td><?= $adopcion['hora'] ?></td>
                        <td>Usuario #<?= $adopcion['fk_usuario'] ?></td>
                        <td>Mascota #<?= $adopcion['fk_mascota'] ?></td>
                        <td>
                            <span class="badge bg-<?= 
                                $adopcion['estatus_adopcion'] == 'aceptada' ? 'success' : 
                                ($adopcion['estatus_adopcion'] == 'rechazada' ? 'danger' : 
                                ($adopcion['estatus_adopcion'] == 'en revision' ? 'warning' : 'secondary')) ?>">
                                <?= ucfirst($adopcion['estatus_adopcion']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>