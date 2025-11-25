<?php
include('menu.php');
include('menu_refugio.php');
include('clases/Preguntas_form.php');

$clase_preguntas = new Preguntas();

$id_formulario = $_GET['id_formulario'];
$id_refugio = $_GET['id_refugio'];

$total_preguntas = $clase_preguntas->contar($id_formulario);

$numero_siguiente = $total_preguntas + 1;

$preguntas_existentes = [];
if($total_preguntas > 0) {
    $preguntas_existentes = $clase_preguntas->mostrar($id_formulario);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Preguntas al Formulario</title>
    
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            <!-- Card principal -->
            <div class="card shadow-sm">
                <div class="card-header header-formulario text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1">Crear Preguntas del Formulario</h3>
                            <p class="mb-0 opacity-75">Total de preguntas: <?= $total_preguntas ?></p>
                        </div>
                        <?php if($total_preguntas >= 3): ?>
                        <a href="Detalle_formulario.php?id_refugio=<?= $refugio['id_refugio'] ?>" 
                           class="btn btn-naranja">
                            <i class="bi bi-check-circle me-1"></i>
                            Finalizar
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    
                    <!-- Info mínimo de preguntas -->
                    <?php if($total_preguntas < 3): ?>
                    <div class="alert border-0 mb-4" style="background-color: #FFF9E6;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-3 fs-5" style="color: #FE7F2D;"></i>
                            <div>
                                <strong style="color: #283D3B;">Mínimo de preguntas</strong>
                                <p class="mb-0 small text-muted mt-1">
                                    Necesitas al menos <strong>3 preguntas</strong> para activar el formulario. 
                                    Te faltan <?= 3 - $total_preguntas ?>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-success border-0 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>
                                <strong>¡Formulario listo!</strong>
                                <p class="mb-0 small mt-1">
                                    Ya tienes el mínimo de 3 preguntas. Puedes finalizar o agregar más.
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Formulario para agregar pregunta -->
                    <form action="controladores/Insertar_preguntas.php" method="POST">
                        <input type="hidden" name="fk_formulario" value="<?= $id_formulario ?>">
                        <input type="hidden" name="numero_pregunta" value="<?= $numero_siguiente ?>">
                        <input type="hidden" name="id_refugio" id="id_refugio" value="<?= $id_refugio?>">
                        <input type="hidden" name="redireccion" value="preguntas"> 
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #283D3B; font-size: 1.1rem;">
                                <span class="numero-pregunta text-white me-2"><?= $numero_siguiente ?></span>
                                Nueva pregunta
                            </label>
                            <textarea name="pregunta" 
                                      class="form-control" 
                                      rows="3" 
                                      placeholder="Ejemplo: ¿Tienes experiencia previa con mascotas?"
                                      required
                                      style="font-size: 1rem;"></textarea>
                            <small class="text-muted">
                                <i class="bi bi-lightbulb me-1"></i>
                                Esta pregunta aparecerá en el formulario de adopción.
                            </small>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #419D78;">
                                <i class="bi bi-plus-circle me-2"></i>
                                Agregar pregunta
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
            
            <!-- Preguntas ya agregadas -->
            <?php if($total_preguntas > 0): ?>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 fw-bold" style="color: #283D3B;">
                        <i class="bi bi-list-check me-2"></i>
                        Preguntas agregadas
                    </h5>
                    <span class="badge" style="background-color: #85B79D; font-size: 0.9rem;">
                        <?= $total_preguntas ?> pregunta<?= $total_preguntas != 1 ? 's' : '' ?>
                    </span>
                </div>
                <div class="card-body p-3">
                    <?php foreach($preguntas_existentes as $p): ?>
                    <div class="pregunta-card bg-light p-3 mb-2 rounded">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-start flex-grow-1">
                                <span class="numero-pregunta text-white me-3 flex-shrink-0">
                                    <?= $p['numero_pregunta'] ?>
                                </span>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-semibold" style="color: #283D3B;">
                                        <?= htmlspecialchars($p['pregunta']) ?>
                                    </p>
                                </div>
                            </div>
                           <div class="d-flex gap-2 ms-3">
                                <a class="btn btn-sm btn-outline-danger" 
                                    href="controladores/eliminar_pregunta.php?id_pregunta=<?=$p['id_pregunta']?>&id_refugio=<?= $id_refugio ?>&id_formulario=<?= $id_formulario ?>&redireccion=preguntas"
                                    onclick="return confirm('¿Eliminar esta pregunta?')"
                                    title="Eliminar pregunta">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<?php include('Pie_pagina.php'); ?>

</body>
</html>