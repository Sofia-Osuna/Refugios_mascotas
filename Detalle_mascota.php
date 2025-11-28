<?php
include('menu.php');
include('menu_refugio.php');

require_once('clases/Mascota.php');
$id = $_GET['id'];
$id_refugio = $_GET['id_refugio'] ?? null;
$origen = $_GET['origen'] ?? 'lista'; // 'lista' o 'todas'

$mascota_obj = new Mascota();
$refugio_obj = new Refugio(); // Instancia de la clase refugio
$mascota = $mascota_obj->obtenerMascota($id);
// Si no viene por URL, obtenerlo de la mascota misma
if(empty($id_refugio)) {
    $id_refugio = $mascota['fk_refugio'] ?? null;
}

// VERIFICAR SI EL USUARIO ES DUEÑO DEL REFUGIO
$es_dueño = false;
if(isset($_SESSION['idusuario']) && $id_refugio) {
    $es_dueño = $refugio_obj->esDelUsuario($id_refugio, $_SESSION['idusuario']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Mascota - <?= htmlspecialchars($mascota['nombre']) ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card principal de la mascota -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Imagen y contenido -->
                <div class="row g-0">
                    <!-- Imagen de la mascota -->
                    <div class="col-md-5">
                        <?php if(!empty($mascota['foto'])): ?>
                            <img src="imagenes_animales/<?= htmlspecialchars($mascota['foto']) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover; min-height: 500px;" 
                                 alt="Foto de <?= htmlspecialchars($mascota['nombre']) ?>">
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
                    
                    <!-- Información de la mascota -->
                    <div class="col-md-7">
                        <div class="card-body p-4 p-lg-5">
                            
                            <!-- Título principal -->
                            <h1 class="display-5 fw-bold mb-3" style="color: #85B79D;">
                                <?= htmlspecialchars($mascota['nombre']) ?>
                            </h1>
                            
                            <!-- Información básica -->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3">
                                            
                                            <div>
                                                <h6 class="fw-bold mb-1">Especie</h6>
                                                <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                    <?= htmlspecialchars($mascota['nombre_especie']) ?>
                                                </p>
                                            </div>
                                            
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            
                                            <div>
                                                <h6 class="fw-bold mb-1">Estatus</h6>
                                                <?php
                                                if($mascota['estatus'] == 'pendiente'):
                                                ?>
                                                <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                    <?= htmlspecialchars($mascota['estatus']) ?> : !Esta mascota esta en proceso de ser adoptada!
                                                </p>
                                                <?php else: ?>
                                                <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                    <?= htmlspecialchars($mascota['estatus']) ?> : !Esta mascota Espera ser adoptada!
                                                </p>
                                                <?php endif ?>
                                            </div> 
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Descripción -->
                            <div class="border-top pt-4">
                                <h5 class="fw-bold mb-3">Descripción</h5>
                                <p class="text-muted lh-lg" style="font-size: 1.1rem;">
                                    <?= nl2br(htmlspecialchars($mascota['descripcion'])) ?>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Botones de acción - Mismo estilo que historias felices -->
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <?php if($origen == 'todas'): ?>
                        <!-- Volver a Todas las Mascotas -->
                        <a href="Todas_mascotas.php" 
                           class="btn btn-outline-secondary px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Volver a todas las mascotas
                        </a>
                    <?php else: ?>
                        <!-- Volver a Lista del Refugio -->
                        <a href="Lista_mascota.php?id_refugio=<?= $id_refugio ?>" 
                           class="btn btn-outline-secondary px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Volver a mascotas del refugio
                        </a>
                    <?php endif; ?>
                </div>
                
              <div class="d-flex gap-2">
    <?php if($mascota['estatus'] == 'disponible'): ?>
        <!-- Botón Adoptar solo para usuarios logueados -->
        <?php if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario'])): ?>
            <a href="controladores/Insertar_adopcion.php?id_usuario=<?= $_SESSION['idusuario']?>&id_mascota=<?=$mascota['id_mascotas']?>" 
               class="btn text-white px-4" 
               style="background-color: #FCCA46; border-radius: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
                Adoptar
            </a>
        <?php endif; ?>
    <?php endif; ?>
                    <!-- BOTONES DE EDITAR Y ELIMINAR SOLO PARA EL DUEÑO O ADMINISTRADOR -->
                    <?php 
                    // Mostrar botones SOLO si:
                    // 1. El usuario está logueado Y es administrador (rol 1) O dueño del refugio
                    if(isset($_SESSION['fk_rol'])): 
                        $mostrar_botones = false;
                        
                        if($_SESSION['fk_rol'] == 1) {
                            // Administrador puede editar/eliminar cualquier mascota
                            $mostrar_botones = true;
                        } elseif($id_refugio && $es_dueño) {
                            // Dueño del refugio específico
                            $mostrar_botones = true;
                        }
                        
                        if($mostrar_botones):
                    ?>
                    
                    <!-- Botón Editar -->
                    <a href="editar_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>" 
                       class="btn text-white px-4" 
                       style="background-color: #FCCA46; border-radius: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil me-2" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        Editar
                    </a>
                    
                    <!-- Botón Eliminar -->
                    <a href="controladores/eliminar_mascota.php?id=<?= $mascota['id_mascotas'] ?>&id_refugio=<?= $id_refugio ?>" 
                       class="btn btn-danger px-4"
                       onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash me-2" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        Eliminar
                    </a>
                    
                    <?php endif; ?>
                    <?php endif; ?>
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