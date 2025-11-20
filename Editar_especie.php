
<?php
include('menu.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_especie = $_GET['id'] ?? null;

if (!$id_especie) {
    echo "Error: ID no proporcionado";
    exit;
}
include('clases/Especie.php');
$clase = new Especie();
$resultado= $clase->Id($id_especie);

if (!$resultado ){ 
    echo "Especie no encontrada";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar especie</title>
   <link rel="stylesheet" href="css/bootstrap.css">
</head>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Editar especie</h3>
                    </div>
                    <div class="card-body p-4">
    
    <div class="formulario_contenedor">
    <form method="POST" action="controladores/actualizar_especie.php">
        <input type="hidden" name="id_especie" value="<?= $resultado['id_especie'] ?>">
        <br> <br>
            <div class="row justify-content-center">  
                                <div class="col-md-6 mb-3 text center">
                <label for="nombre" class="form-label fw-bold col-md-30 ">Nombre de la especie</label>
                           <input type="text" class="form-control" value="<?= $resultado['nombre'] ?>" id="nombre" name="nombre" required>
                                </div>
                                <div class="col-md-15 mb-3">        <br>
        <br><br>

    <div class="d-grid gap-2 mt-4">
         <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #FCCA46;">
            
                                Editar
                                
                                </button>
 <div class="d-grid gap-2 mt-4">
        
                                
                                </button>

                            </div>
       
    </form>
    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
<?php 
include('Pie_pagina.php');
 ?>
 </body>
</html>
