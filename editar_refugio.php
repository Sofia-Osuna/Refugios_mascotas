    <?php
require_once('clases/refugio.php');
include_once('menu.php');
    $clase = new Refugio();
    
    // Aceptar tanto 'id' como 'id_refugio'
    $id = $_GET['id'] ?? $_GET['id_refugio'] ?? null;
    
    if (!$id) {
        echo "<script>alert('Error: No se proporcionó un ID válido'); window.location.href='mis_refugios.php';</script>";
        exit;
    }
    
    $refugio = $clase->Id($id);
    
    if (!$refugio) {
        echo "<script>alert('Error: No se encontró el refugio'); window.location.href='mis_refugios.php';</script>";
        exit;
    }


    // Ejecutar la consulta de estados
    $mysqli = new Conexion();
    $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
    $resultado = $mysqli->query($consulta);
    
    //este de aqui brayan bro es para cargar especificamente el municipio y localidad/colonia 
    $consulta2 = "SELECT nombre, id_municipio FROM municipio WHERE fk_estado = {$refugio['id_estado']}";
    $resultado2 = $mysqli->query($consulta2);

    $consulta3 = "SELECT nombre, id_colonia FROM colonia WHERE fk_municipio = {$refugio['id_municipio']}";
    $resultado3 = $mysqli->query($consulta3);
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
    
    <div class="d-flex align-items-start gap-3 mb-2">
        <!-- Imagen actual -->
        <?php if(!empty($refugio['foto']) && file_exists("img_refugio/" . $refugio['foto'])): ?>
            <img src="img_refugio/<?= htmlspecialchars($refugio['foto']) ?>" 
                 class="img-thumbnail" 
                 style="width: 80px; height: 80px; object-fit: cover;"
                 alt="Foto actual">
        <?php else: ?>
            <div class="bg-light p-2 rounded" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ccc" class="bi bi-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                </svg>
            </div>
        <?php endif; ?>
        
        <!-- Input file -->
        <div class="flex-grow-1">
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <div class="form-text small">
                <?php if(!empty($refugio['foto'])): ?>
                    Imagen actual: <?= htmlspecialchars($refugio['foto']) ?>
                <?php else: ?>
                    No hay imagen actual
                <?php endif; ?>
            </div>
        </div>
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
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $refugio['telefono'] ?>" >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                        <label for="correo" class="form-label fw-bold">Correo:</label>
                                    <input type="text" class="form-control" id="correo" name="correo" value="<?= $refugio['correo'] ?>"     >
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
                                            <!-- esto de aqui es para cargar el opction con el estado -->
                                            <?php
                                                while($fila = $resultado->fetch_assoc()){
                                                    $selected = ($fila['id_estado'] == $refugio['id_estado']) ? 'selected' : '';
                                                    echo '<option value="'.$fila['id_estado'].'" '.$selected.'>'.$fila['nombre'].'</option>';                                                }
                                            ?>
                                        </select>
                                    </div>

                                            <div class="col-md-4 mb-3">
                                        <label for="cbx_municipio" class="form-label fw-bold">Selecciona tu municipio:</label>
                                        <select name="cbx_municipio" id="cbx_municipio" class="form-select" required>
                                            <option value="0">Selecciona primero un estado</option>
                                            <?php
                                                while($fila = $resultado2->fetch_assoc()){
                                                    $selected = ($fila['id_municipio'] == $refugio['id_municipio']) ? 'selected' : '';
                                                    echo '<option value="'.$fila['id_municipio'].'" '.$selected.'>'.$fila['nombre'].'</option>';                                                }
                                            ?>
                                        </select>
                                        
                                        
                                    </div>
                                            <div class="col-md-4 mb-3">
                                        <label for="cbx_colonia" class="form-label fw-bold">Selecciona tu localidad o colonia:</label>
                                        <select name="cbx_colonia" id="cbx_colonia" class="form-select" required>
                                            <option value="0">Selecciona primero una colonia</option>
                                             <?php
                                                while($fila = $resultado3->fetch_assoc()){
                                                    $selected = ($fila['id_colonia'] == $refugio['id_colonia']) ? 'selected' : '';
                                                    echo '<option value="'.$fila['id_colonia'].'" '.$selected.'>'.$fila['nombre'].'</option>';                                                }
                                            ?>
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
        </div>
        </div>


    <?php 
    include('Pie_pagina.php');
    ?>
    </body>
    </html>