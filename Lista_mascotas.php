<?php 
include('menu.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<header class="header-principal"></header>

<nav class="sub-navbar">
    <ul>
        <li><a href="#">Ver mascotas</a></li>
        <li><a href="#">Historias felices</a></li>
        <li><a href="#">Formulario de adopción</a></li>
        <li><a href="#">Respuestas</a></li>
        <li><a href="#">Editar</a></li>
    </ul>
</nav>

 <label>Buscar por especie</label>
        <input type="text" name="nombre_mascota">


<div class="cards-container">

    <div class="card">
        <h2>Imagen</h2>
        <p>Nombre</p>
        <button>Detalles</button>
    </div>

    <div class="card">
        <h2>Imagen</h2>
        <p>Nombre</p>
        <button>Detalles</button>
    </div>

</div>

<?php
include('Pie_pagina.php');
?>
</body>
</html>