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
   <style>
    h2{
    text-align: center;
    }

    form {
    max-width: 600px;
    margin: 0 auto;  
    display: flex;
    flex-direction: column;
    align-items: center;  
    gap: 20px;
}

label {
    text-align: center;  
}

input[type="text"] {
    width: 400px;  
    display: block;
    border-color: black;
}


   </style>

</head>
<body>
<br>
<h2>Editar Historia feliz</h2>
<br>
  <form action="controladores/actualizar_historias_f.php" method="POST" enctype="multipart/form-data">
	        <input type="hidden" name="id_historia" value="<?= $historia['id_historia_feliz'] ?>">


	<label>Descripcion</label>
	<textarea style="font-size: 30px; border-color: black; border-radius: 10px; resize: none;" name ="descripcion"></textarea>

	<?php if($historia['foto'] != 'sin_foto.jpg'){ ?>
    <img src="imagenes_animales/<?= $historia['foto'] ?>" width="200" style="margin: 10px 0;"><br>
<?php } ?>
        
        Foto actual: <?= $historia['foto'] ?><br>
        Nueva foto (opcional):<br>
        <input type="file" name="foto"><br>

<label for="">Mascota:</label>
<select name="fk_mascota" required>
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


<input type="submit" name="guardar" value="Guardar Historia">
<br>

</form>

</body>
</html>
<?php
include('Pie_pagina.php');
?>