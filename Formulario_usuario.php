<?php 
include('menu.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Crea tu cuenta</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/Insertar_usuario.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de usuario:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="password" class="form-label fw-bold">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label fw-bold">Foto:</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="correo" class="form-label fw-bold">Correo electronico:</label>
                                    <input type="text" class="form-control" id="correo" name="correo" required>
                                </div>
                            </div>
<!-- SELECTOR DE ROL -->
<?php if(isset($_SESSION['fk_rol']) && $_SESSION['fk_rol'] == 1){ ?>
    <!-- Solo el ADMIN ve todas las opciones -->
    <div class="row">
        <div class="col-12 mb-3">
            <label for="rol" class="form-label fw-bold">Tipo de cuenta:</label>
            <select class="form-select" id="rol" name="rol" required>
                <option value="1"> Administrador</option>
                <option value="2"> Usuario normal</option>
                <option value="3"> Gestor de refugio</option>
            </select>
        </div>
    </div>
<?php } else { ?>
    <!-- Usuario sin cuenta puede elegir entre usuario normal o gestor -->
    <div class="row">
        <div class="col-12 mb-3">
            <label for="rol" class="form-label fw-bold">Tipo de cuenta:</label>
            <select class="form-select" id="rol" name="rol" required>
                <option value="2"> Usuario normal</option>
                <option value="3"> Gestor de refugio</option>
            </select>
        </div>
    </div>
<?php } ?>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                    Crear cuenta
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