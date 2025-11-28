<?php

require_once('clases/Mascota.php');

include('menu.php');
include('menu_refugio.php'); // Este ya incluye Refugio.php y crea $clase
$id_refugio = $_GET['id_refugio'];

$mascota_obj_filtro = new Mascota();
$especies_filtro = $mascota_obj_filtro->obtenerEspecies();

// VERIFICAR SI ES DUEÑO DEL REFUGIO - usando la función esDelUsuario que ya existe
$es_dueno = false;
if(isset($_SESSION['idusuario']) && isset($clase)) {
    $es_dueno = $clase->esDelUsuario($id_refugio, $_SESSION['idusuario']) || $_SESSION['fk_rol'] == 1;
}

$clase_mascota = new Mascota();

if($es_dueno) {
    $mascotas = $clase_mascota->mostrarTodasPorRefugio($id_refugio);
} else {
    $mascotas = $clase_mascota->mostrarPorRefugio($id_refugio);
}
echo "<!-- DEBUG: es_dueno_o_admin = " . ($es_dueno? 'SÍ' : 'NO') . " -->";
echo "<!-- DEBUG: Número de mascotas = " . count($mascotas) . " -->";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mascotas</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/buscar_mascota.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    
    <!-- Header con título y botón -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Mascotas del Refugio</h1>
            <p class="text-muted">Gestiona las mascotas de este refugio</p>
        </div>
        <div class="col-auto">
            <?php if($es_dueno): ?>
                <a href="Formulario_mascota.php?id_refugio=<?= $id_refugio ?>" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nueva Mascota
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Resto del código se mantiene igual... -->
    <!-- Sección de filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
                Filtrar mascotas
            </h5>
            
            <form>
                <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">
                <div class="row g-3">
                    
                    <!-- Filtro por nombre -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="filtro_nombre" class="form-label fw-semibold">Buscar por nombre</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_nombre" 
                               name="filtro_nombre" 
                               placeholder="Ej: Max, Luna, etc.">
                    </div>
                    
                    <!-- Filtro por especie -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="filtro_especie" class="form-label fw-semibold">Especie</label>
                        <select class="form-select" id="filtro_especie" name="filtro_especie">
                            <option value="">Todas las especies</option>
                            <?php foreach($especies_filtro as $esp){ ?>
                                <option value="<?= htmlspecialchars($esp['nombre']) ?>">
                                    <?= htmlspecialchars($esp['nombre']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <!-- Botón limpiar -->
                    <div class="col-12 col-md-12 col-lg-5 d-flex align-items-end">
                        <button type="button" id="btn-limpiar" class="btn btn-naranja w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                            Limpiar
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

    <!-- Grid de mascotas -->
   <!-- Grid de mascotas -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    
    <?php if(count($mascotas) > 0): ?>
        <?php foreach($mascotas as $mascota): ?>
    
        <div class="col">
            <div class="card h-100 shadow-sm border-0 hover-card">
                
                <!-- Foto de la mascota -->
                <div style="height: 200px; overflow: hidden;">
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
                    
                    <!-- Especie y Estatus -->
                    <div class="mb-3">
                        <small class="text-muted d-flex align-items-center mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FCCA46" class="bi bi-tag-fill me-1" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                            <?= htmlspecialchars($mascota['nombre_especie']) ?>
                        </small>
                        
                        <!-- ESTATUS DE LA MASCOTA -->
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
                    
                    <!-- Descripción (truncada) -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        <?php 
                        $descripcion = htmlspecialchars($mascota['descripcion']);
                        echo strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion;
                        ?>
                    </p>
                    
                    <!-- Botón ver detalles -->
                    <a href="Detalle_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>" 
                       class="btn btn-sm w-100 text-white" 
                       style="background-color: #85B79D; border-radius: 8px;">
                        Ver más detalles
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                    
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
    <?php endif; ?>
    
</div>
    
    <!-- Mensaje si no hay resultados en el filtro -->
    <div id="mensaje-sin-resultados" class="text-center py-5" style="display: none;">
        <img src="img_sistema/_-ezgif.com-loop-count.gif" alt="rata" class="img-fluid mb-3"
        style="max-width: 300px; width: 100%; height: auto; border-radius: 10px;"> 
        <h4 class="text-muted fw-bold">No se encontró ninguna mascota</h4>
        <p class="text-muted">Intenta de nuevo con otros filtros</p>
    </div>
    
    <!-- Mensaje si no hay mascotas registradas -->
   <!-- Mensaje si no hay mascotas registradas -->
<?php if(empty($mascotas)): ?>
<div class="text-center py-5">
    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-heart mb-3" viewBox="0 0 16 16">
        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
    </svg>
    <h4 class="text-muted">No hay mascotas registradas</h4>
    <?php if($es_dueno): ?>
        <!-- SOLO MUESTRA ESTE MENSAJE SI ES DUEÑO -->
        <p class="text-muted">Agrega la primera mascota a este refugio</p>
        <a href="Formulario_mascota.php?id_refugio=<?= $id_refugio ?>" class="btn text-white mt-3" style="background-color: #FCCA46;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Agregar Primera Mascota
        </a>
    <?php else: ?>
        <!-- MENSAJE PARA USUARIOS QUE NO SON DUEÑOS -->
        <p class="text-muted">Este refugio aún no tiene mascotas registradas</p>
    <?php endif; ?>
</div>
<?php endif; ?>

</div>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>