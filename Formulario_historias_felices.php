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


.tarjeta-historias{
     min-height: 60vh; 
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    background: gray;
     max-width: 800px;
     margin: 40px auto;
     padding: 0 20px;
     background: ghostwhite;
}

.boton-historia{
    background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 150px;
}

textarea{
   resize: none;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;

}

   </style>

</head>
<body>
<br>
<h2>Agregar una historia feliz</h2>
<br>

<div class="tarjeta-historias">
<form>
    <br>
	<label>Nombre</label>
	<input type="text" name="">
    <br>
	<label>Descripcion</label>
    <br>
	<textarea></textarea>
    <br> <br>

	<label>Fotografia de la Mascota</label>
    <br>
	<input type="file" name="">
    <br> <br>
	<a href="">
		<button class="boton-historia">Guardar historia</button>
        <br> <br>
	</a>
 <br>
</div>
<br>
</form>
<br>
</body>
</html>
<?php 
include('Pie_pagina.php');
 ?>