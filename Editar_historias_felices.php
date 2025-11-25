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
                <?php if($historia['foto'] != 'sin_foto.jpg'){ ?>
                    <img src="imagenes_animales/<?= $historia['foto'] ?>" width="200" class="mx-auto d-block" style="margin: 10px 0;"><br>
                <?php } ?>
                <label for="foto" class="form-label fw-bold">Nueva foto (opcional):</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
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