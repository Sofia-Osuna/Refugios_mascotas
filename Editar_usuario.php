<?php 
include('menu.php');
include('clases/Usuario.php');

$clase = new Usuario();
$id = $_GET['id'];
$usuario = $clase->obtenerPorId($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cuenta</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar cuenta</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/actualizar_usuario.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de usuario:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $usuario['nombre'] ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="password" class="form-label fw-bold">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?= $usuario['password'] ?>" required>
                                </div>
                            </div>

                    <div class="row">
    <div class="col-12 mb-3">
        <label for="foto" class="form-label fw-bold">Foto:</label>
        
        <div class="d-flex align-items-start gap-3 mb-2">
            <!-- Imagen actual -->
            <?php if(!empty($usuario['foto']) && $usuario['foto'] != 'sin_foto.jpg' && file_exists("img_usuarios/" . $usuario['foto'])): ?>
                <img src="img_usuarios/<?= htmlspecialchars($usuario['foto']) ?>" 
                     class="img-thumbnail" 
                     style="width: 80px; height: 80px; object-fit: cover;"
                     alt="Foto actual del usuario">
            <?php else: ?>
                <div class="bg-light p-2 rounded" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ccc" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                </div>
            <?php endif; ?>
            
            <!-- Input file -->
            <div class="flex-grow-1">
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                <div class="form-text small">
                    <?php if(!empty($usuario['foto']) && $usuario['foto'] != 'sin_foto.jpg'): ?>
                        Imagen actual: <?= htmlspecialchars($usuario['foto']) ?>
                    <?php else: ?>
                        No hay imagen actual
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="correo" class="form-label fw-bold">Correo electronico:</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= $usuario['correo'] ?>" required>
                                </div>
                            </div>

                            <!-- SELECTOR DE ROL - Solo visible para ADMIN -->
                            <?php if(isset($_SESSION['fk_rol']) && $_SESSION['fk_rol'] == 1){ ?>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="rol" class="form-label fw-bold">Tipo de cuenta:</label>
                                        <select class="form-select" id="rol" name="rol" required>
                                            <option value="1" <?= $usuario['fk_rol'] == 1 ? 'selected' : '' ?>> Administrador</option>
                                            <option value="2" <?= $usuario['fk_rol'] == 2 ? 'selected' : '' ?>> Usuario normal</option>
                                            <option value="3" <?= $usuario['fk_rol'] == 3 ? 'selected' : '' ?>> Gestor de refugio</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <!-- Si no es admin, mantener el rol actual -->
                                <input type="hidden" name="rol" value="<?= $usuario['fk_rol'] ?>">
                            <?php } ?>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                    Actualizar cuenta
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
include('Pie_pagina.php')
?>