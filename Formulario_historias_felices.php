<!-- Formulario para crear una historia feliz uwu -->
<?php 
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
<h2>Agregar una historia feliz</h2>
<br>
  <form action="controladores/Insertar_historias_f.php" method="POST" enctype="multipart/form-data">


	<label>Descripcion</label>
	<textarea style="font-size: 30px; border-color: black; border-radius: 10px; resize: none;" name ="descripcion"></textarea>

	<label>Fotografia de la Mascota</label>
	<input type="file" name="Foto">

<label for="">Mascota:</label><br>
<select name="fk_mascota" required>
    <option value="">Selecciona una mascota</option>
    <?php
    require_once('clases/Historias_f.php');
    $historia_obj = new HistoriaFeliz();
    $mascotas = $historia_obj->obtenerMascotas();
    
    foreach($mascotas as $mascota){
    ?>
        <option value="<?= $mascota['id_mascotas'] ?>">
            <?= $mascota['nombre'] ?>
        </option>
    <?php } ?>
</select>

<br><br>

<input type="submit" name="guardar" value="Guardar Historia">
<br>

</form>

</body>
</html>
<?php
include('Pie_pagina.php');
?>