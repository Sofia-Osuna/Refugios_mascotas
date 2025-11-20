<!-- Formulario para crear una historia feliz uwu -->
<?php 
require_once('clases/Historias_f.php');
$id = $_GET['id'];

$historia_obj = new HistoriaFeliz();
$historia = $historia_obj->obtenerHistoria($id);
$mascotas = $historia_obj->obtenerMascotas();
include('menu.php');
 ?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de historias felices</title>
 

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


        <div class="row justify-content-center">
                                <div class="col-12 mb-4">
                                    <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                                </div>
                            </div>
<!-- foto -->
    <div class="row justify-content-center">  <!-- Agrega justify-content-center -->
                                <div class="col-md-6 mb-3 justify-content-center">
                                    <?php if($historia['foto'] != 'sin_foto.jpg'){ ?>
    <img src="imagenes_animales/<?= $historia['foto'] ?>" width="200" class ="mx-auto d-block" style="margin: 10px 0;"><br>
<?php } ?>
        <div class="row justify-content-center"> 

        Foto actual: <?= $historia['foto'] ?><br>
        Nueva foto (opcional):<br>
                                    <label for="foto" class="form-label fw-bold">foto:</label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                </div>
                            </div>
</div>
<!-- fin de foto -->

     <!-- select-->
      <div class="row justify-content-center">
                                <div class="col-md-4 mb-3">
<label class="form-label fw-bold" for="">Mascota:</label>
<select  id="cbx_estado" class="form-select" name="fk_mascota" required>
    <option value="">Selecciona una mascota</option>
    <?php
    require_once('clases/Historias_f.php');
    $historia_obj = new HistoriaFeliz();
    $mascotas = $historia_obj->obtenerMascotas();
    
    foreach($mascotas as $mascota){
    ?>
                <option value="<?= $mascota['id_mascotas'] ?>" <?= $mascota['id_mascotas'] == $historia['fk_mascota'] ? 'selected' : '' ?>>
            <?= $mascota['nombre'] ?>
        </option>
    <?php } ?>
</select>
 </div>
                            </div>
<!-- fin select -->

    <div class="d-grid gap-2 mt-4">
         <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #FCCA46;">
            
                                Editar
                                
                                </button><br>

</form>

</div>
</div>
</div>
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