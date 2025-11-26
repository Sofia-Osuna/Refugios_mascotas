<?php
include('menu.php');
require_once('clases/Historias_f.php');

$historia_obj = new HistoriaFeliz();
// Esto muestra TODAS las historias felices de todos los refugios
$historias = $historia_obj->mostrar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todas las Historias Felices</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    
    <!-- Header con título y botón -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Todas las Historias Felices</h1>
            <p class="text-muted">Conoce las hermosas historias de mascotas que encontraron un hogar en todos los refugios</p>
        </div>
       
    </div>

    <!-- Grid de historias felices -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php if(count($historias) > 0): ?>
            <?php foreach($historias as $historia): ?>
        
            <div class="col">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    
                    <!-- Foto de la mascota -->
                    <div style="height: 250px; overflow: hidden;">
                        <?php if(!empty($historia['foto']) && file_exists("imagenes_animales/" . $historia['foto'])): ?>
                            <img src="imagenes_animales/<?= htmlspecialchars($historia['foto']) ?>" 
                                 class="card-img-top w-100 h-100" 
                                 style="object-fit: cover;" 
                                 alt="Historia feliz">
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
                        
                        <!-- Título -->
                        <h5 class="card-title fw-bold mb-3" style="color: #2c3e50;">
                            Historia Feliz
                        </h5>
                        
                        <!-- Descripción truncada -->
                        <p class="card-text text-muted small mb-3 flex-grow-1">
                            <?php 
                            $descripcion = htmlspecialchars($historia['descripcion']);
                            echo strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion;
                            ?>
                        </p>
                        
                        <!-- Botón ver más información -->
                        <div class="d-grid gap-2 mt-auto">
<a href="Detalle_historia_feliz.php?id=<?= $historia['id_historia_feliz'] ?>&origen=todas" 
                               class="btn text-white" 
                               style="background-color: #85B79D; border-radius: 8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book me-1" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                                Ver más información
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
    
    <!-- Mensaje si no hay historias -->


</div>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>