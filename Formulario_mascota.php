<?php
include('menu.php');
require_once('clases/Mascota.php');

$id_refugio = $_GET['id_refugio'];

if(empty($id_refugio)){
    die("Error: No se recibió el ID del refugio. <a href='Lista_refugio.php'>Volver</a>");
}

$mascota_obj = new Mascota();
$especies = $mascota_obj->obtenerEspecies();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Mascota</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado (después de Bootstrap) -->
    <link rel="stylesheet" href="css/estilo.css">
    
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.js"></script>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Agregar Mascota al Refugio</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/insertar_mascota.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="fk_refugio" value="<?= $id_refugio ?>">
                            
                            <!-- Información básica de la mascota -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de la mascota:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fk_especie" class="form-label fw-bold">Especie:</label>
                                    <select name="fk_especie" id="fk_especie" class="form-select" required>
                                        <option value="">Selecciona una especie</option>
                                        <?php foreach($especies as $especie){ ?>
                                            <option value="<?= $especie['id_especie'] ?>">
                                                <?= $especie['nombre'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="foto" class="form-label fw-bold">Foto:</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="detalles_refugio.php?id=<?= $id_refugio ?>" class="btn btn-lg me-md-2 text-white" style="background-color: #FF802E;">
                                    Cancelar
                                </a>
                                <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #419D78;">
                                    Guardar Mascota
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