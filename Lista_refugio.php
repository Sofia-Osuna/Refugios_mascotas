<?php
include('menu.php');
include('clases/Refugio.php');

$clase = new Refugio();
$resultado = $clase->mostrar();

$mysqli = new Conexion();
$consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
$estado = $mysqli->query($consulta);
?> 
<!-- MUCHAS COSAS ESTAN ESTAN MAL
 -la lista muestra refugios dados de baja
 -los filtros de busqueda estan raros..... -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Refugios</title>
    <!-- para el buscador  -->
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/buscar_refugio.js"></script>
</head>
<body>
<!-- script para filtrado por los selects 
    esto lo vas a copiar y pegar practicamente, lo que esta en con # son el nombre/id de los selects
    te recomiendo que uses el mismo nombre y el mismo id
-->
     <script language="javascript">
$(document).ready(function(){
    $("#cbx_estado").change(function(){
        const estadoSeleccionado = $(this).val();
        
        if(estadoSeleccionado && estadoSeleccionado !== '') {
            const idEstado = $("#cbx_estado option:selected").data('id');
            
            $("#cbx_municipio").html('<option value="">Cargando...</option>');
            $("#cbx_municipio").prop('disabled', true); // Deshabilitar mientras carga
            
            $.post("includes/getMunicipioFiltro.php", {id_estado: idEstado}, function(data){
                $("#cbx_municipio").html('<option value="">Todos los municipios</option>' + data);
                $("#cbx_municipio").prop('disabled', false); // Habilitar después de cargar
                
            });
        } else {
            $("#cbx_municipio").html('<option value="">Todos los municipios</option>');
            $("#cbx_municipio").prop('disabled', false);
        }
    });
});

    </script>

<div class="container my-5">
    
    <!-- Header con título y botón -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold">Refugios Disponibles</h1>
            <p class="text-muted">Encuentra el refugio más cercano a ti</p>
        </div>
        <div class="col-auto">
          <?php if(isset($_SESSION['fk_rol']) && ($_SESSION['fk_rol'] == 1 || $_SESSION['fk_rol'] == 3)){ ?>
    <a href="Formulario_refugio.php" class="btn btn-lg text-white" style="background-color: #FCCA46; border-radius: 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
        Nuevo Refugio
    </a>
<?php } ?>
        </div>
    </div>

    <!-- Sección de filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg>
                Filtrar refugios
            </h5>
            
            <form method="GET" action="">
                <div class="row g-3">
                    
                    <!-- Filtro por nombre -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="filtro_nombre" class="form-label fw-semibold">Buscar por nombre</label>
                        <input type="text" 
                               class="form-control" 
                               id="filtro_nombre" 
                               name="filtro_nombre" 
                               placeholder="Ej: Refugio Esperanza">
                    </div>
                    
                    <!-- Filtro por estado -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="cbx_estado" class="form-label fw-semibold">Estado</label>
                        <select class="form-select" id="cbx_estado" name="cbx_estado">
                            <option value="">Estado</option>
                            <?php
                                while($fila = $estado->fetch_assoc()){
                                    echo '<option value="'.htmlspecialchars($fila['nombre']).'" data-id="'.$fila['id_estado'].'">'.htmlspecialchars($fila['nombre']).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <!-- Filtro por municipio -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="cbx_municipio" class="form-label fw-bold">Selecciona tu municipio:</label>
                        <select name="cbx_municipio" id="cbx_municipio" class="form-select">
                            <option value=" ">Selecciona primero un estado</option>
                        </select>
                    </div>
                    
                    <!-- Botones -->
                    <div class="col-12 col-md-6 col-lg-2 d-flex align-items-end">
                        <button type="button" id="btn-limpiar" class="btn btn-naranja w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                            Limpiar
                        </button>

                    </div>
                    
                </div>
            </form>
        </div>
    </div>
                    
                  


 
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php foreach($resultado as $refugio): ?>


        
        <div class="col">
            <div class="card h-100 shadow-sm border-0 hover-card">
                
                <!-- Imagen del refugio -->
                <div style="height: 200px; overflow: hidden;">
                        <?php if(!empty($refugio['foto']) && file_exists("img_refugio/" . $refugio['foto'])): ?>
                        <img src="img_refugio/<?= htmlspecialchars($refugio['foto']) ?>" 
                             class="card-img-top w-100 h-100" 
                             style="object-fit: cover;" 
                             alt="<?= htmlspecialchars($refugio['nombre']) ?>">
                    <?php else: ?>
                        <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #85B79D !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-house-heart" viewBox="0 0 16 16">
                                <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.309 8 6.982Z"/>
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Contenido de la tarjeta -->
                <div class="card-body d-flex flex-column">
                    
                    <!-- Nombre del refugio -->
                    <h5 class="card-title fw-bold mb-2" style="color: #2c3e50;">
                        <?= htmlspecialchars($refugio['nombre']) ?>
                    </h5>
                    
                    <!-- Ubicación -->
                    <div class="mb-3">
                        <small class="text-muted d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FCCA46" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            <?= htmlspecialchars($refugio['municipio']) ?>, <?= htmlspecialchars($refugio['estado']) ?>
                        </small>
                    </div>
                    
                    <!-- Descripción (truncada) -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        <?php 
                        $descripcion = htmlspecialchars($refugio['descripcion']);
                        echo strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion;
                        ?>
                    </p>
                    
                    <!-- Botón ver más -->
                    <a href="detalles_refugio.php?id=<?= $refugio['id_refugio'] ?>" 
                       class="btn btn-sm w-100 text-white" 
                       style="background-color: #85B79D; border-radius: 8px;">
                        Ver más detalles
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                    
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>
        
    </div>
    <!-- 
        Ahora si, mensaje en el caso de que el filtro no encuentre resultado Muestra UNA EPICA IMAGEN DE UNA RATA EXPLOTANDO
        LO QUIERO EN TODOS LOS FILTROS GIR -->
        <div id="mensaje-sin-resultados" class="text-center py-5" style="display: none;">
            <img src="img_sistema/_-ezgif.com-loop-count.gif" alt="rata" class="img-fluid mb-3"
            style="max-width: 300px; width: 100%; height: auto; border-radius: 10px;"> 
            <h4 class="text-muted fw-bold">No se encontro ningún Refugio</h4>
            <p class="text-muted">Intenta de nuevo</p>
        </div>


    <!-- Mensaje en el caso de que no haya ningun refugio registrado.... lo cual dudo xdxdxd-->
    <?php if(empty($resultado)): ?>
    <div class="text-center py-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ccc" class="bi bi-inbox mb-3" viewBox="0 0 16 16">
            <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z"/>
        </svg>
        <h4 class="text-muted">No hay refugios registrados</h4>
        <p class="text-muted">Sé el primero en crear un refugio</p>
    </div>
    <?php endif; ?>

</div>



</body>

</html>
<?php 
include('Pie_pagina.php');
?>