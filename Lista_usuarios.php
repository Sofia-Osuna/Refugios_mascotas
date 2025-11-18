<?php 
include('menu.php');
?>
<!-- eliminar ese archivo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista usuario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div>
    <label>Lista de usuarios</label>
    <input type="text" name="numero_exterior">
</div>

<table>
    <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
</table>

<?php 
include('Pie_pagina.php');
?>

</body>
</html>
