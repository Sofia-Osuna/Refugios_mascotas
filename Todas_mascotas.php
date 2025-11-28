<?php
include('menu.php');
require_once('clases/Mascota.php');
require_once('clases/refugio.php');

$mascota_obj = new Mascota();
$refugio_obj = new Refugio();

// Obtener TODAS las mascotas de todos los refugios
$mascotas = $mascota_obj->mostrarTodas();

// Verificar si el usuario está logueado para mostrar botones de acción
$usuario_logueado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todas las Mascotas</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    
    <!-- Header con título -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Todas las Mascotas</h1>
            <p class="text-muted">Conoce a todas las mascotas que buscan un hogar en nuestros refugios</p>
        </div>
        <div class="col-auto">
            <?php if($usuario_logueado && isset($_SESSION['fk_rol']) && $_SESSION['fk_rol'] == 1): ?>
                <a href="Formulario_mascota.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nueva Mascota
                </a>
            <?php endif; ?>
        </div>
    </div>

  <!-- Grid de mascotas -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    
    <?php if(count($mascotas) > 0): ?>
        <?php foreach($mascotas as $mascota): ?>
        
        <div class="col">
            <div class="card h-100 shadow-sm border-0 hover-card">
                
                <!-- Foto de la mascota -->
                <div style="height: 250px; overflow: hidden;">
                    <?php if(!empty($mascota['foto']) && file_exists("imagenes_animales/" . $mascota['foto'])): ?>
                        <img src="imagenes_animales/<?= htmlspecialchars($mascota['foto']) ?>" 
                             class="card-img-top w-100 h-100" 
                             style="object-fit: cover;" 
                             alt="<?= htmlspecialchars($mascota['nombre']) ?>">
                    <?php else: ?>
                        <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #85B79D !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Contenido de la tarjeta -->
                <div class="card-body d-flex flex-column">
                    
                    <!-- Nombre de la mascota -->
                    <h5 class="card-title fw-bold mb-2" style="color: #2c3e50;">
                        <?= htmlspecialchars($mascota['nombre']) ?>
                    </h5>
                    
                    <!-- Especie -->
                    <p class="card-text mb-1">
                        <small class="text-muted">
                            <strong>Especie:</strong> <?= htmlspecialchars($mascota['nombre_especie'] ?? 'No especificada') ?>
                        </small>
                    </p>
                    
                    <!-- Refugio -->
                    <p class="card-text mb-2">
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-house me-1" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                            </svg>
                            <strong>Refugio:</strong> <?= htmlspecialchars($mascota['nombre_refugio'] ?? 'Sin refugio') ?>
                        </small>
                    </p>
                    
                    <!-- ESTATUS DE LA MASCOTA -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-circle-fill me-1" 
                                 style="color: <?= 
                                     $mascota['estatus'] == 'disponible' ? '#28a745' : 
                                     ($mascota['estatus'] == 'adoptado' ? '#dc3545' : 
                                     ($mascota['estatus'] == 'pendiente' ? '#ffc107' : '#6c757d')) 
                                 ?>;" 
                                 viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8"/>
                            </svg>
                            <small class="fw-semibold" 
                                   style="color: <?= 
                                       $mascota['estatus'] == 'disponible' ? '#28a745' : 
                                       ($mascota['estatus'] == 'adoptado' ? '#dc3545' : 
                                       ($mascota['estatus'] == 'pendiente' ? '#856404' : '#6c757d')) 
                                   ?>;">
                                <?= 
                                    $mascota['estatus'] == 'disponible' ? 'Disponible' : 
                                    ($mascota['estatus'] == 'adoptado' ? 'Adoptado' : 
                                    ($mascota['estatus'] == 'pendiente' ? 'Pendiente' : 'Indisponible')) 
                                ?>
                            </small>
                        </div>
                    </div>
                    
                    <!-- Descripción truncada -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        <?php 
                        $descripcion = htmlspecialchars($mascota['descripcion'] ?? '');
                        echo strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion;
                        ?>
                    </p>
                    
                    <!-- Botón ver más información -->
                    <div class="d-grid gap-2 mt-auto">
                        <a href="Detalle_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $mascota['fk_refugio'] ?>&origen=todas" 
                           class="btn text-white" 
                           style="background-color: #85B79D; border-radius: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                            Ver detalles
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="text-center py-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-heart mb-3" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
                <h4 class="text-muted">No hay mascotas registradas</h4>
                <p class="text-muted">Pronto tendremos mascotas buscando hogar</p>
            </div>
        </div>
    <?php endif; ?>
    
</div>
    
</div>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>