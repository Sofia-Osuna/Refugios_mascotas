<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');

if(!isset($_SESSION['idusuario'])) {
    header('location: Inicio_sesion.php');
    exit;
}

include('clases/Usuario.php');
$clase_usuario = new Usuario();
$usuario = $clase_usuario->obtenerPorId($_SESSION['idusuario']);

$datos_personales = [];

include('clases/Datos_personales.php');
$clase_datos = new Datos();
$datos_personales = $clase_datos->obtener($_SESSION['idusuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - <?= htmlspecialchars($usuario['nombre']) ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card de perfil -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Header con foto de perfil -->
                <div class="position-relative" style="background: linear-gradient(135deg, #85B79D 0%, #419D78 100%); height: 200px;">
                    
                    <!-- Foto de perfil circular superpuesta -->
                    <div class="position-absolute" style="bottom: -80px; left: 50%; transform: translateX(-50%);">
                        <?php if(!empty($usuario['foto'])): ?>
                            <img src="img_usuarios/<?= htmlspecialchars($usuario['foto']) ?>" 
                                 class="rounded-circle border border-5 border-white shadow" 
                                 style="width: 200px; height: 200px; object-fit: cover;" 
                                 alt="Foto de perfil">
                        <?php else: ?>
                            <div class="rounded-circle border border-5 border-white shadow d-flex align-items-center justify-content-center" 
                                 style="width: 200px; height: 200px; background-color: #f8f9fa;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#85B79D" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Contenido del perfil -->
                <div class="card-body p-4 p-lg-5" style="padding-top: 100px !important;">
                    
                    <!-- Nombre centrado -->
                    <div class="text-center mb-4">
                        <h1 class="display-5 fw-bold mb-2" style="color: #283D3B;">
                            <?= htmlspecialchars($usuario['nombre']) ?>
                        </h1>
                        <p class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                            </svg>
                            <?= htmlspecialchars($usuario['correo']) ?>
                        </p>
                    </div>

                    <hr class="my-4">
                    
                    <!-- Sección de datos personales -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0" style="color: #283D3B;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#85B79D" class="me-2" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                </svg>
                                Datos personales
                            </h5>
                            <?php if(empty($datos_personales)): ?>
                                <a href="Formulario_datos_personales.php?id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-sm text-white" style="background-color: #85B79D;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    Agregar datos
                                </a>
                            <?php else: ?>
                                <a href="Editar_datos.php?id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-sm text-white" style="background-color: #FCCA46;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    Editar datos
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <?php if(!empty($datos_personales)): ?>
                            <!-- Información Personal -->
                            <div class="card border-0 mb-3" style="background-color: #f8f9fa;">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3" style="color: #419D78;">Información Personal</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <small class="text-muted d-block">Nombre completo</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['Nombre'] . ' ' . 
                                                   $datos_personales['apellido_p'] . ' ' . 
                                                   $datos_personales['apellido_m']) ?>
                                            </p>
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <small class="text-muted d-block">Fecha de nacimiento</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= date('d/m/Y', strtotime($datos_personales['fecha_nacimiento'])) ?>
                                            </p>
                                        </div>

                                        <?php if(!empty($datos_personales['edad'])): ?>
                                        <div class="col-md-3 mb-3">
                                            <small class="text-muted d-block">Edad</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['edad']) ?> años
                                            </p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="card border-0" style="background-color: #f8f9fa;">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-3" style="color: #419D78;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                        </svg>
                                        Dirección
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted d-block">Estado</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['estado']) ?>
                                            </p>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted d-block">Municipio</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['municipio']) ?>
                                            </p>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <small class="text-muted d-block">Colonia/Localidad</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['colonia']) ?>
                                            </p>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <small class="text-muted d-block">Calle</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['nombre_calle']) ?>
                                            </p>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <small class="text-muted d-block">Núm. Exterior</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= !empty($datos_personales['numero_exterior']) ? htmlspecialchars($datos_personales['numero_exterior']) : 's/n' ?> 
                                            </p>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <small class="text-muted d-block">Núm. Interior</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= !empty($datos_personales['numero_interior']) ? htmlspecialchars($datos_personales['numero_interior']) : 's/n' ?> 
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <small class="text-muted d-block">Código Postal</small>
                                            <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                                <?= htmlspecialchars($datos_personales['codigo_postal']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="alert alert-info border-0" style="background-color: #E8F5E9;">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#419D78" class="me-3" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                    <div>
                                        <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                            Completa tu información personal
                                        </p>
                                        <p class="mb-0 small text-muted mt-1">
                                            Agrega tus datos para una mejor experiencia en el proceso de adopción.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Botones de acción -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="editar_perfil.php" class="btn btn-outline-secondary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                </svg>
                                Editar perfil
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="mis_adopciones.php" class="btn w-100 text-white" style="background-color: #85B79D;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                                Mis adopciones
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<?php include('Pie_pagina.php'); ?>

</body>
</html>