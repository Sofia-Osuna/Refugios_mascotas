<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('menu.php');
include('clases/Especie.php');
$clase = new Especie();
$resultado = $clase->mostrar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Especies</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
    
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/buscar_especie.js"></script>
</head>
<body>

<div class="container my-5">
    
    <!-- Header con título y botón -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Gestión de Especies</h1>
            <p class="text-muted">Administra las especies disponibles en el sistema</p>
        </div>
        <div class="col-auto">
            <a href="formulario_especie.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Nueva Especie
            </a>
        </div>
    </div>

    <!-- Mensajes de éxito -->
    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
                if($_GET['msg'] == 'actualizado') echo 'Especie actualizada correctamente';
                if($_GET['msg'] == 'eliminado') echo 'Especie eliminada correctamente';
                if($_GET['msg'] == 'creado') echo 'Especie creada correctamente';
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Sección de filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
                Filtrar especies
            </h5>
            
            <form>
                <div class="row g-3">
                    
                    <!-- Filtro por nombre -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="filtro_nombre" class="form-label fw-semibold">Buscar por nombre</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_nombre" 
                               name="filtro_nombre" 
                               placeholder="Ej: Perro, Gato, etc.">
                    </div>
                    
                    <!-- Botón limpiar -->
                    <div class="col-12 col-md-6 col-lg-5 d-flex align-items-end">
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

    <!-- Grid de especies -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="grid-especies">
        
        <?php if(count($resultado) > 0): ?>
            <?php foreach($resultado as $especie): ?>
        
            <div class="col especie-item">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    
                    <!-- Icono representativo de la especie -->
                    <div class="card-header text-center py-4" style="background-color: #85B79D; border-radius: 10px 10px 0 0 !important;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="white" class="bi bi-tags" viewBox="0 0 16 16">
                            <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
                            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
                        </svg>
                    </div>
                    
                    <!-- Contenido de la tarjeta -->
                    <div class="card-body d-flex flex-column text-center">
                        
                        <!-- Nombre de la especie -->
                        <h5 class="card-title fw-bold mb-3 especie-nombre" style="color: #2c3e50;">
                            <?= htmlspecialchars($especie['nombre']) ?>
                        </h5>
                        
                        <!-- Botones de acción -->
                        <div class="d-grid gap-2 mt-auto">
                            <a href="Editar_especie.php?id=<?= $especie['id_especie'] ?>" 
                               class="btn btn-sm text-white" 
                               style="background-color: #85B79D; border-radius: 8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil me-1" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                Editar
                            </a>
                            
                        
                        </div>
                        
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
        <h4 class="text-muted fw-bold">No se encontró ninguna especie</h4>
        <p class="text-muted">Intenta de nuevo con otros filtros</p>
    </div>
    
    <!-- Mensaje si no hay especies registradas -->
    <?php if(empty($resultado)): ?>
    <div class="text-center py-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-tags mb-3" viewBox="0 0 16 16">
            <path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/>
            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/>
        </svg>
        <h4 class="text-muted">No hay especies registradas</h4>
        <p class="text-muted">Crea la primera especie del sistema</p>
        <a href="formulario_especie.php" class="btn text-white mt-3" style="background-color: #FCCA46;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Agregar Primera Especie
        </a>
    </div>
    <?php endif; ?>

</div>

</body>
</html>
<?php 
include('Pie_pagina.php');
?>