<?php
include('menu.php');
include('clases/Refugio.php');

// Verificar que el usuario esté logueado
if(!isset($_SESSION['idusuario'])){
    header('location: Inicio_sesion.php');
    exit;
}

$id_usuario = $_SESSION['idusuario'];

$clase = new Refugio();
$resultado = $clase->mostrarPorUsuario($id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Refugios</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    
    <!-- Header con título y botón -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Mis Refugios</h1>
            <p class="text-muted">Gestiona los refugios que administras</p>
        </div>
        <div class="col-auto">
            <?php if($_SESSION['fk_rol'] == 1 || $_SESSION['fk_rol'] == 3){ ?>
                <a href="Formulario_refugio.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nuevo Refugio
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- Grid de refugios -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php 
        if(count($resultado) > 0){
            foreach($resultado as $refugio){ 
        ?>
        
        <div class="col">
            <div class="card h-100 shadow-sm border-0 hover-card">
                
                <!-- Imagen del refugio -->
                <div style="height: 200px; overflow: hidden;">
                    <?php if(!empty($refugio['foto']) && file_exists("img_refugio/" . $refugio['foto'])): ?>
                        <img src="img_refugio/<?= htmlspecialchars($refugio['foto']) ?>" 
                             class="card-img-top w-100 h-100" 
                             style="object-fit: cover;" 
                             alt="<?= htmlspecialchars($refugio['nombre']) ?>">
                    <?php else: ?>
                        <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #85B79D !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-house-heart" viewBox="0 0 16 16">
                                <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982Z"/>
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Contenido de la tarjeta -->
                <div class="card-body d-flex flex-column">
                    
                    <!-- Nombre del refugio -->
                    <h5 class="card-title fw-bold mb-2" style="color: #2c3e50;">
                        <?= htmlspecialchars($refugio['nombre']) ?>
                    </h5>
                    
                    <!-- Ubicación -->
                    <div class="mb-3">
                        <small class="text-muted d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FCCA46" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            <?= htmlspecialchars($refugio['municipio']) ?>, <?= htmlspecialchars($refugio['estado']) ?>
                        </small>
                    </div>
                    
                    <!-- Descripción (truncada) -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        <?php 
                        $descripcion = htmlspecialchars($refugio['descripcion']);
                        echo strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion;
                        ?>
                    </p>
                    
                    <!-- Botón ver más -->
                    <a href="detalles_refugio.php?id=<?= $refugio['id_refugio'] ?>" 
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
        
        <?php 
            }
        } else {
        ?>
            <!-- Mensaje si no tiene refugios - MODIFICADO -->
            <div class="col-12">
                <div class="card border-0 shadow-sm py-5">
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ccc" class="bi bi-house mb-4" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                        </svg>
                        <h4 class="text-muted mb-2">No tienes refugios registrados</h4>
                        <?php if($_SESSION['fk_rol'] == 1 || $_SESSION['fk_rol'] == 3){ ?>
                            <p class="text-muted mb-4">Crea tu primer refugio</p>
                            <a href="Formulario_refugio.php" class="btn text-white px-4 py-2" style="background-color: #FCCA46;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                Crear Primer Refugio
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
    </div>

</div>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>