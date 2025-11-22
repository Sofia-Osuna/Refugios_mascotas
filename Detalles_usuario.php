<?php
include('menu.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_usuario = $_GET['id'] ?? null;

include('clases/Usuario.php');
$clase = new Usuario();
$usuario = $clase->obtenerPorId($id_usuario);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario - <?= htmlspecialchars($usuario['nombre']) ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card principal del usuario -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Imagen y contenido -->
                <div class="row g-0">
                    <!-- Foto de perfil -->
                    <div class="col-md-4">
                        <?php if(!empty($usuario['foto'])): ?>
                            <img src="img_usuarios/<?= htmlspecialchars($usuario['foto']) ?>" 
                                 class="img-fluid w-100 h-100" 
                                 style="object-fit: cover; min-height: 400px;" 
                                 alt="Foto de perfil de <?= htmlspecialchars($usuario['nombre']) ?>">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center h-100" 
                                 style="min-height: 400px; background-color: #85B79D !important;">
                                <div class="text-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                    <p class="mt-2">Sin foto</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Información del usuario -->
                    <div class="col-md-8">
                        <div class="card-body p-4 p-lg-5">
                            
                            <!-- Título principal -->
                            <h1 class="display-5 fw-bold mb-4" style="color: #85B79D;">
                                Información Personal
                            </h1>
                            
                            <!-- Información del usuario -->
                            <div class="border-top pt-4">
                                
                                <!-- Nombre de usuario -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-2">Nombre de usuario</h6>
                                            <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                <?= htmlspecialchars($usuario['nombre']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Correo electrónico -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-2">Correo electrónico</h6>
                                            <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                <?= htmlspecialchars($usuario['correo']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Contraseña (oculta por seguridad) -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                                                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-2">Contraseña</h6>
                                            <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                ••••••••••
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Información adicional (si estuviera disponible) -->
                                <!--
                                <div class="mb-4">
                                    <div class="d-flex align-items-start">
                                        <div class="me-3" style="color: #FCCA46;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-2">Teléfono</h6>
                                            <p class="mb-0 text-muted" style="font-size: 1.1rem;">
                                                +52 123 456 7890
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                -->
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between mt-4">
                <div>
                    <a href="Lista_usuario.php" 
                       class="btn btn-outline-secondary px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        Volver a usuarios
                    </a>
                </div>
                
                <div>
                    <a href="Editar_usuario.php?id=<?= $usuario['id_usuario'] ?>" 
                       class="btn text-white px-4" 
                       style="background-color: #FCCA46; border-radius: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil me-2" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        Editar información
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Bootstrap JS -->


</body>
</html>
<?php 
include('Pie_pagina.php')
?>