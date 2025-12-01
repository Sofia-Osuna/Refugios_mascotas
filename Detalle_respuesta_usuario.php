<!-- Aquí el usuario podra ver todas sus respuestas de un formulario en especifico, en figma esta como "ver detalle de un respuesta"-->
<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');
include('clases/Adopcion.php');
include('clases/Datos_personales.php');
include('clases/Usuario.php');
include('clases/Respuestas.php');


$id_adopcion = $_GET['id_adopcion'];
$id_usuario = $_GET['id_usuario'];
if(!$id_usuario || !$id_adopcion) {
    echo "Error: Informacion no encontrada";
    exit;
}
$clase = new Adopcion();
$adopciones = $clase->mostrar($id_usuario, $id_adopcion);
$clase2 = new Datos();
$datos = $clase2 -> obtener($id_usuario);
$clase3 = new Usuario();
$user = $clase3 -> obtenerPorId($id_usuario);
$clase4 = new Respuestas();
$respuestas = $clase4 -> mostrar($adopciones['id_adopcion']);

if(!$adopciones && !$datos && !$user){
    echo"Error: datos no encontrados";
}



?>	
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Solicitud</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <!-- Header con estatus -->
    <div class="card mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #419D78 0%, #85B79D 100%);">
        <div class="card-body text-white p-4">
            <h2 class="mb-2">Solicitud de Adopción</h2>
            <span class="badge rounded-pill px-4 py-2" style="background-color: #FCCA46; color: #2c3e50; font-size: 1rem;">
                Estatus: <?=$adopciones['estatus']?>
            </span>
        </div>
    </div>

    <!-- Datos de la Adopción -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <h3 class="mb-4" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                Datos de la Adopción
            </h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">ID Adopción:</strong>
                        <span><?= $adopciones['id_adopcion'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Fecha:</strong>
                        <span><?= $adopciones['fecha'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Hora:</strong>
                        <span><?= $adopciones['hora'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 rounded" style="background: linear-gradient(135deg, #FCCA46 0%, #FE7F2D 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <strong class="d-block mb-2 text-white">Mascota a Adoptar:</strong>
                                <h4 class="mb-1 text-white"><?= $adopciones['mascota'] ?? '' ?></h4>
                                <small class="text-white">ID: <?= $adopciones['fk_mascota'] ?? '' ?></small>
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="Imagenes_animales/<?=$adopciones['foto_mascota']?>" 
                                     alt="foto pet" 
                                     class="img-fluid rounded shadow"
                                     style="max-width: 150px; max-height: 150px; object-fit: cover; border: 3px solid white;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos Personales -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <h3 class="mb-4" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                 Datos Personales
            </h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Usuario:</strong>
                        <span><?= $user['nombre'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Correo:</strong>
                        <span><?= $user['correo'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Nombre Completo:</strong>
                        <span><?= ($datos['Nombre'] ?? '') . ' ' . ($datos['apellido_p'] ?? '') . ' ' . ($datos['apellido_m'] ?? '') ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Edad:</strong>
                        <span><?= $datos['edad'] ?? '' ?> </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Fecha Nacimiento:</strong>
                        <span><?= $datos['fecha_nacimiento'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Teléfono:</strong>
                        <span><?= $datos['telefono'] ?? '' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dirección -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <h3 class="mb-4" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                 Dirección
            </h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Estado:</strong>
                        <span><?= $datos['estado'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Municipio:</strong>
                        <span><?= $datos['municipio'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Colonia:</strong>
                        <span><?= $datos['colonia'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Código Postal:</strong>
                        <span><?= $datos['codigo_postal'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Calle:</strong>
                        <span><?= $datos['nombre_calle'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Número Exterior:</strong>
                        <span><?= $datos['numero_exterior'] ?? '' ?></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 bg-light rounded">
                        <strong class="d-block mb-1">Número Interior:</strong>
                        <span><?= !empty($datos['numero_interior']) ? $datos['numero_interior'] : 's/n' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Respuestas del Formulario -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h3 class="mb-4" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                 Respuestas del Formulario
            </h3>
            <?php if(!empty($respuestas)): ?>
                <?php foreach($respuestas as $index => $respuesta): ?>
                    <div class="mb-3 p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #85B79D;">
                        <div class="mb-2">
                            <span class="badge rounded-circle bg-dark me-2"><?= $index + 1 ?></span>
                            <strong style="color: #2c3e50;"><?= htmlspecialchars($respuesta['pregunta']) ?></strong>
                        </div>
                        <div class="ms-4">
                            <p class="mb-0" style="color: #495057;">
                                 <?= htmlspecialchars($respuesta['respuesta']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    No hay respuestas registradas para este formulario.
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
<?php 
include("Pie_pagina.php");
?>