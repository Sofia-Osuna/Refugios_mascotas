<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');
include('clases/Adopcion.php');

$id_usuario = $_SESSION['idusuario'] ?? null;

// Verificar que el usuario esté logueado
if(!$id_usuario) {
    echo "Error: Usuario no identificado";
    exit;
}

$clase = new Adopcion();
$adopciones = $clase->mostrarPorId($id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Adopciones</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <!-- Incluir jQuery y nuestro filtro reutilizable -->
    <script src="js/jquery-3.7.1.js"></script>
        <script src="js/buscar_respuesta.js"></script>

</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color: #283D3B;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#85B79D" class="me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                        Mis Adopciones
                    </h2>
                    <p class="text-muted mb-0">Historial de solicitudes de adopción</p>
                </div>
                <span class="badge fs-6" style="background-color: #85B79D;">
                    <?= count($adopciones) ?> solicitud<?= count($adopciones) != 1 ? 'es' : '' ?>
                </span>
            </div>

            <!-- Filtro por estatus (NUEVO) -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-funnel me-2" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                        </svg>
                        Filtrar por estatus
                    </h5>
                    
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <select class="form-select" id="filtro_estatus" style="max-width: 300px;">
                                <option value="">Todos los estatus</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en revision">En revisión</option>
                                <option value="aceptado">Aceptado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                            <button type="button" id="btn-limpiar-estatus" class="btn btn-outline-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise me-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                </svg>
                                Limpiar filtro
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if(empty($adopciones)): ?>
                <!-- Sin adopciones -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#85B79D" class="mb-3" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <h4 class="fw-bold mb-2" style="color: #283D3B;">No hay adopciones registradas</h4>
                        <p class="text-muted mb-4">Comienza adoptando una mascota hoy mismo</p>
                        <a href="Todas_mascotas.php" class="btn btn-lg text-white" style="background-color: #FCCA46;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            Buscar mascotas
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Leyenda de estatus -->
                <div class="card border-0 mt-3 mb-4" style="background-color: #f8f9fa;">
                    <div class="card-body p-3">
                        <small class="text-muted d-block mb-2 fw-bold">Leyenda de estatus:</small>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <span class="badge bg-secondary">Pendiente</span>
                                <small class="text-muted ms-1">En espera de revisión</small>
                            </div>
                            <div>
                                <span class="badge bg-warning">En revisión</span>
                                <small class="text-muted ms-1">Siendo evaluada</small>
                            </div>
                            <div>
                                <span class="badge bg-success">Aceptada</span>
                                <small class="text-muted ms-1">¡Felicidades!</small>
                            </div>
                            <div>
                                <span class="badge bg-danger">Rechazada</span>
                                <small class="text-muted ms-1">No aprobada</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de adopciones -->
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #85B79D; color: white;">
                                <tr>
                                    <th class="text-center" style="width: 60px;">#</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Refugio</th>
                                    <th>Mascota</th>
                                    <th class="text-center">Estatus</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-adopciones">
                                <?php 
                                $contador = 1;
                                foreach($adopciones as $adopcion): 
                                ?>
                                <!-- Añadir clase fila-adopcion y data-estatus -->
                                <tr class="fila-adopcion" data-estatus="<?= strtolower($adopcion['Estatus']) ?>">
                                    <td class="text-center">
                                        <strong style="color: #85B79D;"><?= $contador ?></strong>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($adopcion['fecha'])) ?></td>
                                    <td>
                                        <small class="text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                            </svg>
                                            <?= $adopcion['hora'] ?>
                                        </small>
                                    </td>
                                    <td>
                                        <span class="fw-semibold" style="color: #283D3B;">
                                            <?= htmlspecialchars($adopcion['Refugio']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="Detalle_mascota.php?id=<?=$adopcion['id_mascotas']?>&id_refugio=<?=$adopcion['id_refugio']?>" 
                                           class="text-decoration-none fw-semibold" 
                                           style="color: #419D78;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z"/>
                                            </svg>
                                            <?= htmlspecialchars($adopcion['Mascota']) ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $estatus_lower = strtolower($adopcion['Estatus']);
                                        $bg_color = '';
                                        $icon = '';
                                        
                                        if($estatus_lower == 'aceptada' || $estatus_lower == 'aceptado') {
                                            $bg_color = 'success';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16"><path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/></svg>';
                                        } elseif($estatus_lower == 'rechazada' || $estatus_lower == 'rechazado') {
                                            $bg_color = 'danger';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
                                        } elseif($estatus_lower == 'en revision') {
                                            $bg_color = 'warning';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>';
                                        } else {
                                            $bg_color = 'secondary';
                                            $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/></svg>';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $bg_color ?>">
                                            <?= $icon ?>
                                            <?= ucfirst($adopcion['Estatus']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="Detalle_respuesta_usuario.php?id_usuario=<?=$id_usuario?>&id_adopcion=<?=$adopcion['id_adopcion']?>" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                $contador++; 
                                endforeach; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Mensaje cuando no hay resultados del filtro (NUEVO) -->
                <div id="mensaje-sin-resultados-filtro" class="text-center py-5" style="display: none;">
                    <img src="img_sistema/_-ezgif.com-loop-count.gif" alt="rata" class="img-fluid mb-3"
                        style="max-width: 300px; width: 100%; height: auto; border-radius: 10px;"> 
                    <h4 class="text-muted fw-bold">No hay solicitudes con ese estatus</h4>
                    <p class="text-muted">Intenta con otro filtro</p>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>
</div>

<!-- Incluir el archivo JS del filtro (NUEVO) -->
<script src="js/filtro_estatus_adopciones.js"></script>

<?php include('Pie_pagina.php'); ?>

</body>
</html>