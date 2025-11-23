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
                                    <?php if($usuario['foto'] != 'sin_foto.jpg'){ ?>
                                        <br><img src="img_usuarios/<?= $usuario['foto'] ?>" width="100" style="margin: 10px 0;"><br>
                                    <?php } ?>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                    <small class="text-muted">Dejar vacío para mantener la foto actual</small>
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