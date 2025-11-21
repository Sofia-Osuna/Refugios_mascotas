<?php 
    include('menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Especie editar</title>
</head>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header text-white" style="background-color: #8abf9d;">
            <h2 class="mb-0"> Especie editar</h2>
        </div>

        <div class="card-body">
            <form>
                <div class="mb-4">
                    <label for="Nom_especie" class="form-label fw-semibold">Nombre de la especie:</label>
                    <input type="text" id="Nom_especie" name="Nom_especie" class="form-control">
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn fw-bold px-4" style="background-color: #ffcf48;">
                        Guardar cambios
                    </button>
                    <button type="reset" class="btn btn-danger fw-bold px-4">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
<?php 
    include('Pie_pagina.php');
?>