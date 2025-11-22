<?php
include('menu.php');
require_once('clases/Historias_f.php');

$historia_obj = new HistoriaFeliz();
$historias = $historia_obj->mostrar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historias Felices</title>
    
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
            <h1 class="display-5 fw-bold">Historias Felices</h1>
            <p class="text-muted">Conoce las hermosas historias de mascotas que encontraron un hogar</p>
        </div>
        <div class="col-auto">
            <a href="Formulario_historias_felices.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Nueva Historia
            </a>
        </div>
    </div>

    <!-- Sección de filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
                Filtrar historias
            </h5>
            
            <form method="GET" action="">
                <div class="row g-3">
                    
                    <!-- Filtro por nombre de mascota -->
                    <div class="col-md-8">
                        <label for="filtro_nombre" class="form-label fw-semibold">Buscar por nombre de mascota</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_nombre" 
                               name="filtro_nombre" 
                               placeholder="Ej: Max, Luna, etc.">
                    </div>
                    
                    <!-- Botones -->
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn text-white flex-grow-1" style="background-color: #FE7F2D;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-1" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Buscar
                        </button>
                        <a href="Lista_historias_felices.php" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </div>
                    
                </div>
            </form>
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
                                 alt="<?= htmlspecialchars($historia['nombre_mascota']) ?>">
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
                        <h5 class="card-title fw-bold mb-3" style="color: #2c3e50;">
                            <?= htmlspecialchars($historia['nombre_mascota']) ?>
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
                            <a href="Detalle_historia_feliz.php?id=<?= $historia['id_historia_feliz'] ?>" 
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
    <?php if(empty($historias)): ?>
    <div class="text-center py-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-heart mb-3" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
        </svg>
        <h4 class="text-muted">No hay historias felices registradas</h4>
        <p class="text-muted">Comparte la primera historia de adopción exitosa</p>
        <a href="Formulario_historias_felices.php" class="btn text-white mt-3" style="background-color: #FCCA46;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Crear Primera Historia
        </a>
    </div>
    <?php endif; ?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>