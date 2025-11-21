<?php 
include('menu.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevas especies</title>

</head>


<br><br>

<div class="container" style="max-width: 800px;">
    <div class="card shadow">
        
        <div class="card-header text-center fw-bold text-white" style="background-color: #85B79D;">
            Formulario especie
        </div>

        <div class="card-body">

            <form action="controladores/Insertar_especie.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 500px;">

                <label class="form-label fw-bold">Nombre de la especie:</label>
                <input type="text" name="nombre" class="form-control border-dark mb-4">

                <div class="text-center">
                    <button type="submit" class="btn fw-bold text-dark px-4 py-2" style="background-color: #FCCA46; border-radius: 15px;">
                        Confirmar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<br><br><br>

<?php 
include('Pie_pagina.php');
?>

</html>
