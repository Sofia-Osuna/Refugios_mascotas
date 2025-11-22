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
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle Historia Feliz - <?= htmlspecialchars($historia['nombre_mascota'] ?? 'Historia Feliz') ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card principal de la historia feliz -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Imagen y contenido -->
                <div class="row g-0">
                    <!-- Imagen de la mascota -->
                    <div class="col-md-5">
                        <?php if(!empty($historia['foto'])): ?>
                            <img src="imagenes_animales/<?= htmlspecialchars($historia['foto']) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover; min-height: 500px;" 
                                 alt="Foto de <?= htmlspecialchars($historia['nombre_mascota'] ?? 'la mascota') ?>">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center h-100" 
                                 style="min-height: 500px; background-color: #85B79D !important;">
                                <div class="text-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg>
                                    <p class="mt-2">Sin imagen</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Información de la historia -->
                    <div class="col-md-7">
                        <div class="card-body p-4 p-lg-5">
                            
                            <!-- Título principal -->
                            <h1 class="display-5 fw-bold mb-3" style="color: #85B79D;">
                                Historia Feliz de <?= htmlspecialchars($historia['nombre_mascota'] ?? 'Mascota') ?>
                            </h1>
                            
                            <!-- Fecha y hora -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-3" style="color: #FCCA46;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">Fecha</h6>
                                                <p class="mb-0 text-muted">
                                                    <?= htmlspecialchars($historia['fecha']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-3" style="color: #FCCA46;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">Hora</h6>
                                                <p class="mb-0 text-muted">
                                                    <?= htmlspecialchars($historia['hora']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="border-top pt-4">
                                <h5 class="fw-bold mb-3">La Historia</h5>
                                <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                                    <?= nl2br(htmlspecialchars($historia['descripcion'])) ?>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <a href="Lista_historia_feliz.php" 
                       class="btn btn-outline-secondary px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Volver a historias
                    </a>
                </div>
                
                <div class="d-flex gap-2">
                    <a href="editar_historias_felices.php?id=<?= $historia['id_historia_feliz'] ?>" 
                       class="btn text-white px-4" 
                       style="background-color: #FCCA46; border-radius: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil me-2" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        Editar
                    </a>
                    
                    <a href="controladores/eliminar_historias_f.php?id=<?= $historia['id_historia_feliz'] ?>" 
                       class="btn btn-danger px-4"
                       onclick="return confirm('¿Estás seguro de eliminar esta historia feliz?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash me-2" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Eliminar
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>



</body>
</html>
<?php
include('Pie_pagina.php');
?>