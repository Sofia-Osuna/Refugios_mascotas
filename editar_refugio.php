    <?php
    include('menu.php');
    include('clases/Refugio.php');
    include('clases/Conexion.php');

    $clase = new Refugio();
    $id = $_GET['id'];
    $refugio = $clase->Id($id);

    // Ejecutar la consulta de estados
    $mysqli = new Conexion();
    $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
    $resultado = $mysqli->query($consulta);
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Refugio</title>
        
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        
        <!-- Tu CSS personalizado (después de Bootstrap) -->
        <link rel="stylesheet" href="css/estilo.css">
        <!-- jQuery -->
        <script src="js/jquery-3.7.1.js"></script>
        
        <!-- Script para selects dinámicos -->
        <script language="javascript">
            $(document).ready(function(){
                $("#cbx_estado").change(function(){
                    $("#cbx_municipio").html('<option value="0">Cargando...</option>');
                    $("#cbx_colonia").html('<option value="0">Selecciona primero un municipio</option>');
                
                    $("#cbx_estado option:selected").each(function(){
                        id_estado = $(this).val();
                        $.post("includes/getMunicipio.php", {id_estado: id_estado}, function(data){
                            $("#cbx_municipio").html(data);
                        });
                    });
                });

                $("#cbx_municipio").change(function(){
                    $("#cbx_municipio option:selected").each(function(){
                        id_municipio = $(this).val();
                        $.post("includes/getColonia.php", {id_municipio: id_municipio}, function(data){
                            $("#cbx_colonia").html(data);
                        });
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #85B79D;">
                            <h3 class="mb-0 text-white">Editar Refugio</h3>
                        </div>
                        <div class="card-body p-4">
                            <form action="controladores/actualizar_refugio.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_refugio" value="<?= $refugio['id_refugio'] ?>">
                                
                                <!-- Información básica -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label fw-bold">Nombre del refugio:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $refugio['nombre'] ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="foto" class="form-label fw-bold">Foto:</label>
                                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                    </div>
                                </div>

                    <div class="row">
                                <div class="col-12 mb-4">
                            <label for="descripcion" class="form-label fw-bold">Descripción del refugio:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= $refugio['descripcion'] ?></textarea>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label fw-bold">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $refugio['telefono'] ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                        <label for="correo" class="form-label fw-bold">Correo:</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= $refugio['correo'] ?>" required>
                                            </div>
                                    </div>
                                </div>


                                

                                <hr class="my-4">

                                <!-- Dirección -->
                                <h5 class="mb-3 fw-bold">Dirección</h5>
                                    <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="cbx_estado" class="form-label fw-bold">Selecciona tu estado:</label>
                                        <select name="cbx_estado" id="cbx_estado" class="form-select" required>
                                            <option value="0">Seleccionar estado</option>
                                            <?php
                                                while($fila = $resultado->fetch_assoc()){
                                                    echo '<option value="'.$fila['id_estado'].'">'.$fila['nombre'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                            <div class="col-md-4 mb-3">
                                        <label for="cbx_municipio" class="form-label fw-bold">Selecciona tu municipio:</label>
                                        <select name="cbx_municipio" id="cbx_municipio" class="form-select" required>
                                        <option value="0">Selecciona primero un estado</option>
                                        </select>
                                        
                                        
                                    </div>
                                            <div class="col-md-4 mb-3">
                                        <label for="cbx_colonia" class="form-label fw-bold">Selecciona tu localidad o colonia:</label>
                                        <select name="cbx_colonia" id="cbx_colonia" class="form-select" required>
                                            <option value="0">Selecciona primero un municipio</option>
                                        </select>
                                    </div>
                                
                            
                                

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_calle" class="form-label fw-bold">Nombre de la calle:</label>
                                        <input type="text" class="form-control" id="nombre_calle" name="nombre_calle" value="<?= $refugio['nombre_calle'] ?>" required>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="numero_exterior" class="form-label fw-bold">Número Exterior:</label>
                                        <input type="text" class="form-control" id="numero_exterior" name="numero_exterior" value="<?= $refugio['numero_exterior'] ?>" required>
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label for="numero_interior" class="form-label fw-bold">Número Interior:</label>
                                        <input type="text" class="form-control" id="numero_interior" name="numero_interior" value="<?= $refugio['numero_interior'] ?>" placeholder="Opcional">
                                    </div>
                                </div>


                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                        Actualizar Refugio
                                    </button>
                                </div>

                            </form>
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