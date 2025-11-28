<!-- Formulario para crear una historia feliz uwu -->
<?php 
require_once('clases/Historias_f.php');
$id = $_GET['id'];

// OBTENER EL ID_REFUGIO DE LA URL
$id_refugio = $_GET['id_refugio'] ?? null;

$historia_obj = new HistoriaFeliz();
$historia = $historia_obj->obtenerHistoria($id);
$mascotas = $historia_obj->obtenerMascotas($id_refugio);
include('menu.php');

// VERIFICAR QUE TENEMOS EL ID_REFUGIO

?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de historias felices</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar historia feliz </h3>
                    </div>
                    <div class="card-body p-4">

 

<form action="controladores/actualizar_historias_f.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_historia" value="<?= $historia['id_historia_feliz'] ?>">
    <input type="hidden" name="fk_refugio" value="<?= $id_refugio ?>">

        <div class="row justify-content-center">
            <div class="col-12 mb-4">
                <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($historia['descripcion']) ?></textarea>
            </div>
        </div>

        <!-- foto -->
      <div class="row justify-content-center">
    <div class="col-md-6 mb-3">
        <label for="foto" class="form-label fw-bold">Foto:</label>
        
        <div class="d-flex align-items-start gap-3 mb-2">
            <!-- Imagen actual -->
            <?php if(!empty($historia['foto']) && $historia['foto'] != 'sin_foto.jpg' && file_exists("imagenes_animales/" . $historia['foto'])): ?>
                <img src="imagenes_animales/<?= htmlspecialchars($historia['foto']) ?>" 
                     class="img-thumbnail" 
                     style="width: 80px; height: 80px; object-fit: cover;"
                     alt="Foto actual de la historia">
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
                    <?php if(!empty($historia['foto']) && $historia['foto'] != 'sin_foto.jpg'): ?>
                        Imagen actual: <?= htmlspecialchars($historia['foto']) ?>
                    <?php else: ?>
                        No hay imagen actual
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- fin de foto -->

        <!-- select-->
       <div class="row justify-content-center">
    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Mascota:</label>
        <select name="fk_mascota" required class="form-select">
            <option value="">Selecciona una mascota</option>
            <?php if(count($mascotas) > 0): ?>
                <?php foreach($mascotas as $mascota): ?>
                    <option value="<?= $mascota['id_mascotas'] ?>" 
                        <?= (isset($historia) && $mascota['id_mascotas'] == $historia['fk_mascota']) ? 'selected' : '' ?>>
                        <?= $mascota['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="" disabled>No hay mascotas en este refugio</option>
            <?php endif; ?>
        </select>
        <?php if(count($mascotas) == 0): ?>
            <small class="text-danger">Primero debes agregar mascotas a este refugio</small>
        <?php endif; ?>
    </div>
</div>
        <!-- fin select -->

        <div class="d-grid gap-2 mt-4">
            <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                Editar
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
include('Pie_pagina.php');
?>