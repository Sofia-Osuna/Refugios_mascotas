<?php
include('menu.php');

include('menu_refugio.php');

require_once('clases/Refugio.php');
$id_refugio = $_GET['id'] ?? null;

$refugio_obj = new Refugio();
$refugio = $refugio_obj->Id($id_refugio); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Refugio - <?= htmlspecialchars($refugio['nombre']) ?></title>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card principal del refugio -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Imagen del refugio -->
                <div class="row g-0">
                    <div class="col-md-5">
                        <?php if(!empty($refugio['foto'])): ?>
                            <img src="img_refugio/<?= htmlspecialchars($refugio['foto']) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover; min-height: 400px;" 
                                 alt="Foto del refugio">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center h-100" 
                                 style="min-height: 400px;">
                                <div class="text-center text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                    <p class="mt-2">Sin imagen</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
               
                    <div class="col-md-7">
                        <div class="card-body p-4 p-lg-5">
                            
                   
                            <h1 class="display-5 fw-bold mb-3" style="color: #85B79D;">
                                <?= htmlspecialchars($refugio['nombre']) ?>
                            </h1>
                            
                        
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Acerca de nosotros</h5>
                                <p class="text-muted lh-lg">
                                    <?= nl2br(htmlspecialchars($refugio['descripcion'])) ?>
                                </p>
                            </div>
                            
                         
                            <div class="border-top pt-4">
                                <h5 class="fw-bold mb-3">Información de contacto</h5>
                                
                        
                                <!-- DIRECCIÓN - CORREGIDA -->
<div class="mb-3">
    <div class="d-flex align-items-start">
        <div class="me-3" style="color: #FCCA46;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
            </svg>
        </div>
        <div>
            <h6 class="fw-bold mb-2">Dirección</h6>
            
            <?php if(!empty($refugio['nombre_calle']) || !empty($refugio['localidad'])): ?>
                
                <?php if(!empty($refugio['nombre_calle'])): ?>
                    <p class="mb-1 text-muted">
                        <?= htmlspecialchars($refugio['nombre_calle']) ?> 
                        <?php if(!empty($refugio['numero_exterior'])): ?>
                            #<?= htmlspecialchars($refugio['numero_exterior']) ?>
                        <?php endif; ?>
                        <?php if(!empty($refugio['numero_interior'])): ?>
                            Int. <?= htmlspecialchars($refugio['numero_interior']) ?>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
                
                <?php if(!empty($refugio['localidad'])): ?>
                    <p class="mb-1 text-muted">
                        <?= htmlspecialchars($refugio['localidad']) ?>
                    </p>
                <?php endif; ?>
                
                <?php if(!empty($refugio['municipio']) || !empty($refugio['estado'])): ?>
                    <p class="mb-0 text-muted">
                        <?php if(!empty($refugio['municipio'])): ?>
                            <?= htmlspecialchars($refugio['municipio']) ?>,
                        <?php endif; ?>
                        <?= htmlspecialchars($refugio['estado'] ?? '') ?>
                    </p>
                <?php endif; ?>
            <?php else: ?>
               
                <p class="mb-0 text-muted">
                    Dirección no especificada
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
                                
                                <!-- Teléfono (si existe) -->
                                <?php if(!empty($refugio['telefono'])): ?>
                                <div class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-2">Teléfono</h6>
                                            <p class="mb-0 text-muted">
                                                <?= htmlspecialchars($refugio['telefono']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Email (si existe) -->
                                <?php if(!empty($refugio['email'])): ?>
                                <div class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-2">Correo electrónico</h6>
                                            <p class="mb-0 text-muted">
                                                <?= htmlspecialchars($refugio['email']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            
        </div>
    </div>
</div>

<?php 
include('Pie_pagina.php');
?>

</body>
</html>