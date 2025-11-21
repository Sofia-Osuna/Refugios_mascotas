<?php 
    include('menu.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulario para nuevas especies</title>
</head>
<body>
    <div class="container my-5 p-4 bg-light rounded shadow" style="max-width: 800px;">
        <form action="controladores/Insertar_especie.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Nombre de la especie:</label>
                <input type="text" class="form-control form-control-sm border border-dark" id="nombre" name="nombre" required />
            </div>
            <button type="submit" class="btn rounded-pill px-4 py-2 fw-semibold" style="background-color: #ffcf48; color: black;">
                Confirmar
            </button>
        </form>
    </div>
</body>
<?php 
    include('Pie_pagina.php');
?>

