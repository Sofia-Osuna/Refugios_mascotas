<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');
include('menu_refugio.php');
include('clases/Preguntas_form.php');

$clase = new Refugio();
$id_refugio = $_GET['id_refugio'];
$refugio = $clase->Id($id_refugio);

//verificar que el refugio tiene un formulario registrado
$respuesta = $clase->verificar($id_refugio);
$datos = $respuesta->fetch_assoc();

if($datos && isset($datos['id_formulario_refugio']) && !empty($datos['id_formulario_refugio'])){
    $tiene_formulario = true;
    $id_formulario = $datos['id_formulario_refugio'];
    
    //esto hace que se muestren las preguntas
    $clase2 = new Preguntas();
    $resultado_preguntas = $clase2->mostrar($id_formulario);
    
    //extraer las preguntas
    $preguntas = [];
    if ($resultado_preguntas) {
        while ($fila = $resultado_preguntas->fetch_assoc()) {
            $preguntas[] = $fila;
        }
    }
}else{
    $tiene_formulario = false;
    $id_formulario = null;
    $preguntas = [];
}

//debug
// echo "<pre>";
// print_r($preguntas);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Adopción - <?= htmlspecialchars($refugio['nombre']) ?></title>
</head>
<body>

<div class="container my-5">
    
    <?php if($tiene_formulario): ?>
    
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Header con gradiente verde -->
                <div class="header-formulario text-white p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h1 class="display-6 fw-bold mb-2"><?= $datos['nombre_formulario']?></h1>
                            <p class="mb-0 opacity-75"><?= $datos['descripcion']?></p>
                            <small class="opacity-75">Creado : <?= $datos['fecha']?></small>
                        </div>
                        
                        <!-- Botones de acción (solo para dueño) -->
                        <div class="d-flex gap-2 flex-wrap">
                           <a href="Editar_formulario_refugio.php?id_formulario=<?= $datos['id_formulario_refugio'] ?>&id_refugio=<?= $id_refugio ?>" class="btn text-white" style="background-color: #FCCA46;">
                                <i class="bi bi-pencil-square me-1"></i> Editar
                            </a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                <i class="bi bi-trash3 me-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Cuerpo -->
                <div class="card-body p-4 p-lg-5">
                    
                    <h5 class="fw-bold mb-4" style="color: #283D3B;">Preguntas del Formulario</h5>
                 
                    <!-- PREGUNTAS DINÁMICAS -->
                    <?php if(count($preguntas) > 0): ?>
                        <?php foreach($preguntas as $index => $pregunta): ?>
                        <div class="pregunta-card bg-light p-3 mb-3 rounded">
                            <div class="d-flex align-items-start">
                                <div class="numero-pregunta text-white me-3 flex-shrink-0"><?= $index + 1 ?></div>
                                <div class="flex-grow-1">
                                    <p class="mb-2 fw-semibold" style="color: #283D3B; font-size: 1.05rem;">
                                        <?= htmlspecialchars($pregunta['pregunta']) ?>
                                    </p>
                                    
                                </div>
                                    <!-- AAAAAAAAHAHAHAhHAHAHHHHHHHAHHHAHHHAHAHAHAHAHAHAH -->
                                    <div class="d-flex gap-2 ms-3 flex-shrink-0">
                                        <a href="editar_pregunta.php?id_pregunta=<?=$pregunta['id_pregunta']?>&id_refugio=<?= $id_refugio ?>" class="btn text-white" style="background-color: #FCCA46;">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>
                                        <a href="controladores/eliminar_pregunta.php?id_pregunta=<?=$pregunta['id_pregunta']?>&id_refugio=<?= $id_refugio ?>" class="btn btn-danger">
                                            <i class="bi bi-trash3 me-1"></i> Eliminar
                                        </a>
                                    </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            No hay preguntas en este formulario.
                        </div>
                    <?php endif; ?>
                    
                </div> <!-- cierra card-body -->
            </div> <!-- cierra card -->
        </div> <!-- cierra col -->
    </div> <!-- cierra row -->
    
    <?php elseif(isset($_SESSION['fk_rol']) && ($_SESSION['fk_rol'] == 1 || $_SESSION['fk_rol'] == 3)): ?>
    
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card shadow-lg border-0 text-center p-5">
                
                <div class="mb-4">
                    <i class="bi bi-clipboard-x" style="font-size: 80px; color: #85B79D;"></i>
                </div>
                
                <h2 class="fw-bold mb-3" style="color: #283D3B;">
                    ¡Aun no cuentas con un formulario!
                </h2>
                
                <p class="text-muted mb-4 lh-lg">
                    Para que un usuario pueda adoptar a una mascota necesitas crear un formulario
                </p>
                <img src="img_sistema/hamster.gif" alt=":)"  class="img-fluid mb-3 d-block mx-auto"
                    style="max-width: 300px; width: 100%; height: auto; border-radius: 10px;"
                >
                
                <div class="alert alert-warning border-0 mb-4 texto-lora" style="background-color: #FFF9E6;">
                    <small>
                        <strong>Importante:</strong> El formulario es obligatorio 
                        para habilitar las adopciones en tu refugio.
                    </small>
                </div>
                
                <a href="Formulario_formulario_refugio.php?id_refugio=<?= $id_refugio ?>" 
                   class="btn btn-lg text-white" 
                   style="background-color: #FCCA46; border-radius: 10px;">
                    <i class="bi bi-plus-circle me-2"></i>
                    Crear Formulario de Adopción
                </a>
                
            </div>
        </div>
    </div>
    
    <?php else: ?>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card shadow-lg border-0 text-center p-5">
                
                <!-- Icono grande -->
                <div class="mb-4">
                    <i class="bi bi-clipboard-x" style="font-size: 80px; color: #85B79D;"></i>
                </div>
                
                <!-- Mensaje -->
                <h2 class="fw-bold mb-3" style="color: #283D3B;">
                    ¡Este Refugio aun no cuenta con un formulario!
                </h2>
                
                <p class="text-muted mb-4 lh-lg">
                    Espera o comunicate con el refugio para poder adoptar a esta mascota
                </p>
                <img src="img_sistema/hamster.gif" alt=":)"  class="img-fluid mb-3 d-block mx-auto"
                    style="max-width: 300px; width: 100%; height: auto; border-radius: 10px;"
                >
                
            </div>
        </div>
    </div>

    <?php endif; ?>
    
</div>

<!-- Modal de confirmación para eliminar -->
<?php if($tiene_formulario): ?>
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0" style="background-color: #FFF3E0;">
                <h5 class="modal-title fw-bold texto-lora" style="color: #E65100;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    ¿Estás seguro?
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0">
                    Al eliminar este formulario, los usuarios <strong>NO podrán solicitar adopciones</strong> 
                    hasta que crees un nuevo formulario.
                </p>
                <p class="mb-0 mt-2 text-muted small">
                    Esta acción no se puede deshacer.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-naranja " data-bs-dismiss="modal">
                    Cancelar
                </button>
                <a href="controladores/eliminar_formulario.php?id_formulario_refugio=<?= $datos['id_formulario_refugio'] ?>&id_refugio=<?= $id_refugio ?>" 
                   class="btn btn-danger">
                    Sí, eliminar formulario
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php include('Pie_pagina.php'); ?>

</body>
</html>