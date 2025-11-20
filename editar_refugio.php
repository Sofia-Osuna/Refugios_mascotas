<?php
include('menu.php');
include('clases/Refugio.php');
$clase = new Refugio();
$id = $_GET['id'];
$refugio = $clase->Id($id);
$estados = $clase->getConexion()->query("SELECT id_estado, nombre FROM estado");
$municipios = $clase->conexion->query("SELECT id_municipio, nombre FROM municipio");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Refugio</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado (después de Bootstrap) -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar Refugio</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/actualizar_refugio.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_refugio" value="<?= $refugio['id_refugio'] ?>">
                            
                            <!-- Información básica -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre del refugio:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $refugio['nombre'] ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="foto" class="form-label fw-bold">Foto:</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="descripcion" class="form-label fw-bold">Descripción del refugio:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= $refugio['descripcion'] ?></textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Dirección -->
                            <h5 class="mb-3 fw-bold">Dirección</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="estado" class="form-label fw-bold">Estado:</label>
                                    <select class="form-select" name="estado" id="estado" required>
                                        <?php while($est = $estados->fetch_assoc()){ ?>
                                            <option value="<?= $est['nombre'] ?>" <?= $est['id_estado'] == $refugio['fk_estado'] ? 'selected' : '' ?>>
                                                <?= $est['nombre'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="municipio" class="form-label fw-bold">Municipio:</label>
                                    <select class="form-select" name="municipio" id="municipio" required>
                                        <?php while($mun = $municipios->fetch_assoc()){ ?>
                                            <option value="<?= $mun['nombre'] ?>" <?= $mun['id_municipio'] == $refugio['fk_municipio'] ? 'selected' : '' ?>>
                                                <?= $mun['nombre'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_calle" class="form-label fw-bold">Nombre de la calle:</label>
                                    <input type="text" class="form-control" id="nombre_calle" name="nombre_calle" value="<?= $refugio['nombre_calle'] ?>" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="numero_exterior" class="form-label fw-bold">Número Exterior:</label>
                                    <input type="text" class="form-control" id="numero_exterior" name="numero_exterior" value="<?= $refugio['numero_exterior'] ?>" required>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="numero_interior" class="form-label fw-bold">Número Interior:</label>
                                    <input type="text" class="form-control" id="numero_interior" name="numero_interior" value="<?= $refugio['numero_interior'] ?>" placeholder="Opcional">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cp" class="form-label fw-bold">Código Postal:</label>
                                    <input type="text" class="form-control" id="cp" name="cp" value="<?= $refugio['cp'] ?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                    Actualizar Refugio
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php 
include('Pie_pagina.php');
?>
</body>
</html>