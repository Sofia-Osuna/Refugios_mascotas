<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('menu.php');
include('clases/Usuario.php');
$clase = new Usuario();
$usuarios = $clase->mostrar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    
    <link href="css/bootstrap.css" rel="stylesheet">
    
   <link rel="stylesheet" href="css/estilo.css">
    
    <script src="js/jquery-3.7.1.js"></script>
</head>
<body>

<div class="container my-5">
    
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Gestión de Usuarios</h1>
            <p class="text-muted">Administra los usuarios del sistema</p>
        </div>
        <div class="col-auto">
            <a href="Formulario_usuario.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Nuevo Usuario
            </a>
        </div>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
                if($_GET['msg'] == 'actualizado') echo 'Usuario actualizado correctamente';
                if($_GET['msg'] == 'eliminado') echo 'Usuario eliminado correctamente';
                if($_GET['msg'] == 'creado') echo 'Usuario creado correctamente';
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
                Filtrar usuarios
            </h5>
            
            <form method="GET" action="">
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <label for="filtro_nombre" class="form-label fw-semibold">Buscar por nombre</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_nombre" 
                               name="filtro_nombre" 
                               placeholder="Ej: Juan Pérez">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="filtro_correo" class="form-label fw-semibold">Correo electrónico</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_correo" 
                               name="filtro_correo" 
                               placeholder="Ej: usuario@ejemplo.com">
                    </div>
                    
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn text-white flex-grow-1" style="background-color: #FE7F2D;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                        <a href="Lista_usuario.php" class="btn btn-outline-secondary flex-grow-1">
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

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php if(count($usuarios) > 0): ?>
            <?php foreach($usuarios as $usuario): ?>
        
            <div class="col">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    
                    <div style="height: 200px; overflow: hidden;">
                        <?php if(!empty($usuario['foto']) && file_exists("img_usuarios/" . $usuario['foto'])): ?>
                            <img src="img_usuarios/<?= htmlspecialchars($usuario['foto']) ?>" 
                                 class="card-img-top w-100 h-100" 
                                 style="object-fit: cover;" 
                                 alt="<?= htmlspecialchars($usuario['nombre']) ?>">
                        <?php else: ?>
                            <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #85B79D !important;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        
                        <h5 class="card-title fw-bold mb-2" style="color: #2c3e50;">
                            <?= htmlspecialchars($usuario['nombre']) ?>
                        </h5>
                        
                        <div class="mb-3">
                            <small class="text-muted d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FCCA46" class="bi bi-envelope-fill me-1" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                </svg>
                                <?= htmlspecialchars($usuario['correo']) ?>
                            </small>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FE7F2D" class="bi bi-key-fill me-1" viewBox="0 0 16 16">
                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                                Contraseña: ••••••••
                            </small>
                        </div>
                        
                        <div class="d-grid gap-2 mt-auto">
                            <a href="Detalles_usuario.php?id=<?= $usuario['id_usuario'] ?>" 
                               class="btn btn-sm text-white" 
                               style="background-color: #85B79D; border-radius: 8px;">
                                Ver detalles
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                            
                            <a href="controladores/eliminar_usuario.php?id=<?= $usuario['id_usuario'] ?>" 
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('¿Estás seguro de eliminar a este usuario?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash me-1" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                Eliminar
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
    
    <?php if(empty($usuarios)): ?>
    <div class="text-center py-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-people mb-3" viewBox="0 0 16 16">
            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
        </svg>
        <h4 class="text-muted">No hay usuarios registrados</h4>
        <p class="text-muted">Crea el primer usuario del sistema</p>
    </div>
    <?php endif; ?>

</div>


</body>
</html>
<?php 
include('Pie_pagina.php');
?>