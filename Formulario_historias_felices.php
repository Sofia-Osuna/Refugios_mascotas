<!-- Formulario para crear una historia feliz uwu -->
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
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #85B79D;">
                        <h3 class="mb-0 text-white">Agregar una historia feliz</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="controladores/Insertar_historias_f.php" method="POST" enctype="multipart/form-data">

                            <!-- Descripción -->
                            <div class="row justify-content-center">
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold">Descripción:</label>
                                    <textarea class="form-control" name="descripcion" rows="4" required></textarea>
                                </div>
                            </div>

                            <!-- Foto -->
                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Fotografía de la Mascota:</label>
                                    <input type="file" class="form-control" name="Foto" accept="image/*">
                                </div>
                            </div>

                            <!-- Select Mascota -->
                            <div class="row justify-content-center">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Mascota:</label>
                                    <select name="fk_mascota" required class="form-select">
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
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Botón -->
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                    Guardar Historia
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include('Pie_pagina.php');
?>