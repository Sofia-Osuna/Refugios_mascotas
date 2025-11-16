<?php
include('menu.php');
require_once('clases/Historias_f.php');

$historia_obj = new HistoriaFeliz();
$historias = $historia_obj->mostrar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historias Felices</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <header class="header-principal">
        <!-- Tu header -->
    </header>

    <nav class="sub-navbar">
        <ul>
            <li><a href="#">Ver mascotas</a></li>
            <li><a href="#">Historias felices</a></li>
            <li><a href="#">Formulario de adopción</a></li>
            <li><a href="#">Respuestas</a></li>
            <li><a href="#">Editar</a></li>
        </ul>
    </nav>

    <h1>Lista historias felices</h1>

    <a href="Formulario_historias_felices.php">+ Nueva Historia</a><br><br>

    <div class="cards-container">
        <?php 
        if(count($historias) > 0){
            foreach($historias as $historia){ 
        ?>
            <div class="card">
                <img src="imagenes_animales/<?= $historia['foto'] ?>" width="200" height="200" style="object-fit: cover;">

                <h2><?= $historia['nombre_mascota'] ?></h2>
                <p><?= substr($historia['descripcion'], 0, 100) ?>...</p>
                <button><a href="Detalle_historia_feliz.php?id=<?= $historia['id_historia_feliz'] ?>" style="color: black; text-decoration: none;">Ver más información</a></button>
            </div>
        <?php 
            }
        } else {
        ?>
            <p>No hay historias felices registradas</p>
        <?php } ?>
    </div>

<?php
include('Pie_pagina.php');
?>

</body>
</html>