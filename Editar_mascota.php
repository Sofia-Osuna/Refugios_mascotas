<?php
include('menu.php'); 
require_once('clases/Mascota.php');
$id = $_GET['id'];
$id_refugio = $_GET['id_refugio'];

$mascota_obj = new Mascota();
$mascota = $mascota_obj->obtenerMascota($id);
$especies = $mascota_obj->obtenerEspecies();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar Mascota</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/actualizar_mascota.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_mascota" value="<?= $mascota['id_mascotas'] ?>">
                            <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">
                            
                            <!-- Información básica de la mascota -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label fw-bold">Nombre de la mascota:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $mascota['nombre'] ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fk_especie" class="form-label fw-bold">Especie:</label>
                                    <select name="fk_especie" id="fk_especie" class="form-select" required>
                                        <option value="">Selecciona una especie</option>
                                        <?php foreach($especies as $especie){ ?>
                                            <option value="<?= $especie['id_especie'] ?>" <?= $especie['id_especie'] == $mascota['fk_especie'] ? 'selected' : '' ?>>
                                                <?= $especie['nombre'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Nueva fila para Estatus y Foto -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="estatus" class="form-label fw-bold">Estatus:</label>
                                    <select name="estatus" id="estatus" class="form-select" required>
                                        <option value="">Selecciona un estatus</option>
                                        <option value="disponible" <?= $mascota['estatus'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                        <option value="indisponible" <?= $mascota['estatus'] == 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
                                        <option value="pendiente" <?= $mascota['estatus'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="adoptado" <?= $mascota['estatus'] == 'adoptado' ? 'selected' : '' ?>>Adoptado</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="foto" class="form-label fw-bold">Foto:</label>
                                    
                                    <div class="d-flex align-items-start gap-3 mb-2">
                                        <!-- Imagen actual -->
                                        <?php if(!empty($mascota['foto']) && file_exists("imagenes_animales/" . $mascota['foto']) && $mascota['foto'] != 'sin_foto.jpg'): ?>
                                            <img src="imagenes_animales/<?= htmlspecialchars($mascota['foto']) ?>" 
                                                 class="img-thumbnail" 
                                                 style="width: 80px; height: 80px; object-fit: cover;"
                                                 alt="Foto actual de la mascota">
                                        <?php else: ?>
                                            <div class="bg-light p-2 rounded" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ccc" class="bi bi-image" viewBox="0 0 16 16">
                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Input file -->
                                        <div class="flex-grow-1">
                                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                            <div class="form-text small">
                                                <?php if(!empty($mascota['foto']) && $mascota['foto'] != 'sin_foto.jpg'): ?>
                                                    Imagen actual: <?= htmlspecialchars($mascota['foto']) ?>
                                                <?php else: ?>
                                                    No hay imagen actual
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= $mascota['descripcion'] ?></textarea>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="Lista_mascota.php?id_refugio=<?= $id_refugio ?>" class="btn btn-lg me-md-2 text-white" style="background-color: #FF802E;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #419D78;">
                                    Actualizar Mascota
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

<?php 
include('Pie_pagina.php');
?>
</body>
</html>