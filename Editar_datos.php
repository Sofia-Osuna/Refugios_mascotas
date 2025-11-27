<?php
error_reporting(E_ALL); //esto es para que me muestre los errores
ini_set('display_errors', 1);
include('menu.php');
$id_usuario=$_GET['id_usuario'];

include('clases/Datos_personales.php');
$clase_datos = new Datos();
$datos_personales = $clase_datos->obtener($id_usuario);
print_r($datos_personales);
//AAAAAAAAH ocupo lo de los estados xdxd
    $mysqli = new Conexion();
    $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
    $resultado = $mysqli->query($consulta);

    $consulta2 = "SELECT nombre, id_municipio FROM municipio WHERE fk_estado = {$datos_personales['id_estado']}";
    $resultado2 = $mysqli->query($consulta2); //me marca error aqui tambien

    $consulta3 = "SELECT nombre, id_colonia FROM colonia WHERE fk_municipio = {$datos_personales['id_municipio']}";
    $resultado3 = $mysqli->query($consulta3);
    // eso fue lo de los estados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    
    <link href="css/bootstrap.css" rel="stylesheet">
    
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
        <div class="col-12 col-lg-9">
            
            <!-- Info Box -->
            <div class="alert border-0 mb-4" style="background-color: #E3F2FD;">
                <div class="d-flex align-items-start">
                    <i class="bi bi-person-fill-check me-3 fs-3" style="color: #0277BD;"></i>
                    <div>
                        <h5 class="fw-bold mb-2" style="color: #283D3B;">Edita tus datos personales</h5>
                        <p class="mb-0">
                            Esta información es necesaria para procesar tu solicitud de adopción. 
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Card principal -->
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #85B79D;">
                    <h3 class="mb-0 text-white">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Datos Personales
                    </h3>
                </div>
                
                <div class="card-body p-4">
                    
                    <form action="controladores/actualizar_datos.php" method="POST">
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$id_usuario?>">

                        <!-- Sección: Información Personal -->
                        <h5 class="fw-bold mb-3" style="color: #283D3B;">
                            <i class="bi bi-person-badge me-2" style="color: #85B79D;"></i>
                            Información Personal
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label fw-bold" style="color: #283D3B;">
                                    Nombre
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nombre" 
                                       id="nombre"
                                       value="<?=$datos_personales['Nombre']?>"

                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidop" class="form-label fw-bold" style="color: #283D3B;">
                                    Apellido Paterno 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="apellidop" 
                                       id="apellidom"
                                       value="<?=$datos_personales['apellido_p']?>"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="apellidom" class="form-label fw-bold" style="color: #283D3B;">
                                    Apellido Materno 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="apellidom" 
                                       id="apellidom"
                                       value="<?=$datos_personales['apellido_m']?>"
                                       required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidom" class="form-label fw-bold" style="color: #283D3B;">
                                    Telefono 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="telefono" 
                                       id="telefono"
                                       value="<?=$datos_personales['telefono']?>"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="edad" class="form-label fw-bold" style="color: #283D3B;">
                                    Edad 
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       name="edad" 
                                       id="edad"
                                       min="18"
                                       max="99"
                                       value="<?=$datos_personales['edad']?>"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="fecha_nac" class="form-label fw-bold" style="color: #283D3B;">
                                    Fecha de Nacimiento 
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       name="fecha_nac" 
                                       min="1920-01-01"
                                       value="<?=$datos_personales['fecha_nacimiento']?>"
                                       required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Sección: Dirección -->
                        <h5 class="fw-bold mb-3" style="color: #283D3B;">
                            <i class="bi bi-geo-alt-fill me-2" style="color: #FCCA46;"></i>
                            Dirección
                        </h5>
                        
                        <p class="text-muted mb-4">
                            Ingresa los datos de tu dirección actual.
                        </p>

                        <!-- Selects dinámicos -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cbx_estado" class="form-label fw-bold" style="color: #283D3B;">
                                    Estado 
                                </label>
                                <select name="cbx_estado" id="cbx_estado" class="form-select" required>
                                    <option value="0">Seleccionar estado</option>
                                        <?php
                                          
                                                while($fila = $resultado->fetch_assoc()){
                                                    $selected = ($fila['id_estado'] == $datos_personales['id_estado']) ? 'selected' : '';
                                                    echo '<option value="'.$fila['id_estado'].'" '.$selected.'>'.$fila['nombre'].'</option>'; 
                                                }
                                 
                                        ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cbx_municipio" class="form-label fw-bold" style="color: #283D3B;">
                                    Municipio 
                                </label>
                                <select name="cbx_municipio" id="cbx_municipio" class="form-select" required>
                                    <option value="0">Selecciona primero un estado</option>
                                    <?php
                                        while($fila = $resultado2->fetch_assoc()){
                                            $selected = ($fila['id_municipio'] == $datos_personales['id_municipio']) ? 'selected' : '';
                                            echo '<option value="'.$fila['id_municipio'].'" '.$selected.'>'.$fila['nombre'].'</option>';    
                                            }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cbx_colonia" class="form-label fw-bold" style="color: #283D3B;">
                                    Colonia/Localidad 
                                </label>
                                <select name="cbx_colonia" id="cbx_colonia" class="form-select" required>
                                    <option value="0">Selecciona primero un municipio</option>
                                    <?php
                                        while($fila = $resultado3->fetch_assoc()){
                                            $selected = ($fila['id_colonia'] == $datos_personales['id_colonia']) ? 'selected' : '';
                                            echo '<option value="'.$fila['id_colonia'].'" '.$selected.'>'.$fila['nombre'].'</option>';            
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Datos de la calle -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre_calle" class="form-label fw-bold" style="color: #283D3B;">
                                    Nombre de la Calle 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nombre_calle" 
                                       id="nombre_calle"
                                       value="<?=$datos_personales['nombre_calle']?>"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="numero_exterior" class="form-label fw-bold" style="color: #283D3B;">
                                    Número Exterior 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="numero_exterior" 
                                       id="numero_exterior"
                                       value="<?=$datos_personales['numero_exterior']?>"
                                       >
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="numero_interior" class="form-label fw-bold" style="color: #283D3B;">
                                    Número Interior 
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="numero_interior" 
                                       id="numero_interior"
                                        value="<?=$datos_personales['numero_interior']?>"
                                        >
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                                <i class="bi bi-check-circle me-2"></i>
                                Enviar
                            </button>
                        </div>

                    </form>
                    
                </div>
            </div>
            
        
            
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<?php include('Pie_pagina.php'); ?>

</body>
</html>