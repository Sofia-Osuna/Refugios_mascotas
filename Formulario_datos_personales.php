<?php
include('menu.php');
$id_usuario=$_GET['id_usuario'];
//AAAAAAAAH ocupo lo de los estados xdxd
    require('clases/Conexion.php');
    $mysqli = new Conexion();
    $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
    $resultado = $mysqli->query($consulta);
//eso fue lo de los estados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Tu CSS personalizado -->
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
                        <h5 class="fw-bold mb-2" style="color: #283D3B;">Completa tu perfil</h5>
                        <p class="mb-0">
                            Esta información es necesaria para procesar tu solicitud de adopción. 
                            Todos los campos marcados con <span class="text-danger">*</span> son obligatorios.
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
                    
                    <form action="controladores/Insertar_datos_personales.php" method="POST">
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$id_usuario?>">

                        <!-- Sección: Información Personal -->
                        <h5 class="fw-bold mb-3" style="color: #283D3B;">
                            <i class="bi bi-person-badge me-2" style="color: #85B79D;"></i>
                            Información Personal
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label fw-bold" style="color: #283D3B;">
                                    Nombre <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nombre" 
                                       id="nombre"
                                       placeholder="Ej: Juan"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidop" class="form-label fw-bold" style="color: #283D3B;">
                                    Apellido Paterno <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="apellidop" 
                                       id="apellidom"
                                       placeholder="Ej: Pérez"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="apellidom" class="form-label fw-bold" style="color: #283D3B;">
                                    Apellido Materno <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="apellidom" 
                                       id="apellidom"
                                       placeholder="Ej: García"
                                       required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidom" class="form-label fw-bold" style="color: #283D3B;">
                                    Telefono <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="telefono" 
                                       id="telefono"
                                       placeholder="Ej: 666 666 6669"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="edad" class="form-label fw-bold" style="color: #283D3B;">
                                    Edad <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       name="edad" 
                                       id="edad"
                                       min="18"
                                       max="99"
                                       placeholder="25"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="fecha_nac" class="form-label fw-bold" style="color: #283D3B;">
                                    Fecha de Nacimiento <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       name="fecha_nac" 
                                       min="1920-01-01"
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
                                    Estado <span class="text-danger">*</span>
                                </label>
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
                                <label for="cbx_municipio" class="form-label fw-bold" style="color: #283D3B;">
                                    Municipio <span class="text-danger">*</span>
                                </label>
                                <select name="cbx_municipio" id="cbx_municipio" class="form-select" required>
                                    <option value="0">Selecciona primero un estado</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cbx_colonia" class="form-label fw-bold" style="color: #283D3B;">
                                    Colonia/Localidad <span class="text-danger">*</span>
                                </label>
                                <select name="cbx_colonia" id="cbx_colonia" class="form-select" required>
                                    <option value="0">Selecciona primero un municipio</option>
                                </select>
                            </div>
                        </div>

                        <!-- Datos de la calle -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre_calle" class="form-label fw-bold" style="color: #283D3B;">
                                    Nombre de la Calle <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="nombre_calle" 
                                       id="nombre_calle"
                                       placeholder="Ej: Avenida Revolución"
                                       required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="numero_exterior" class="form-label fw-bold" style="color: #283D3B;">
                                    Número Exterior <span class="text-muted small">(Opcional)</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="numero_exterior" 
                                       id="numero_exterior"
                                       placeholder="123">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="numero_interior" class="form-label fw-bold" style="color: #283D3B;">
                                    Número Interior <span class="text-muted small">(Opcional)</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       name="numero_interior" 
                                       id="numero_interior"
                                       placeholder="A-5">
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
            
            <!-- Nota de privacidad -->
            <div class="card border-0 shadow-sm mt-4" style="background-color: #F8F9FA;">
                <div class="card-body p-3">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-2" style="color: #419D78;"></i>
                        Tu información está protegida y solo será usada para procesar solicitudes de adopción.
                    </small>
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