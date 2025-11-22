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
    <title>Editar información del usuario</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
    
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar información del usuario</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/actualizar_usuario.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de usuario:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="password" class="form-label fw-bold">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required>
                                    <!-- Para implementar mostrar/ocultar contraseña con JavaScript -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label fw-bold">Foto de perfil:</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="correo" class="form-label fw-bold">Correo electrónico:</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                    Guardar cambios
                                </button>
                            </div>
                        </form>
                        
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
include('Pie_pagina.php');
?>