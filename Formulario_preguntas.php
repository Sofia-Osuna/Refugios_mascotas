<?php
include('menu.php');
include('menu_refugio.php');
include('clases/Preguntas_form.php');

$clase_preguntas = new Preguntas();

$id_formulario = $_GET['id_formulario'];

$total_preguntas = $clase_preguntas->contar($id_formulario);

$numero_siguiente = $total_preguntas + 1;

$limite_alcanzado = ($total_preguntas >= 5);

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
            

            <div class="card shadow-sm">
                <div class="card-header header-formulario text-white p-4">
                    <h3 class="mb-2">Crear Preguntas del Formulario</h3>
                    <p class="mb-0 opacity-75">Pregunta <?= $numero_siguiente ?> de 5</p>
                </div>
                
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold" style="color: #283D3B;">Progreso</span>
                            <span class="text-muted"><?= $total_preguntas ?> de 5 completadas</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" 
                                 style="width: <?= ($total_preguntas / 5) * 100 ?>%; background-color: #419D78;"
                                 role="progressbar">
                                <?= round(($total_preguntas / 5) * 100) ?>%
                            </div>
                        </div>
                    </div>
                    
                    <?php if(!$limite_alcanzado): ?>

                    <form action="controladores/Insertar_preguntas.php" method="POST">
                        <input type="hidden" name="fk_formulario" value="<?= $id_formulario ?>">
                        <input type="hidden" name="numero_pregunta" value="<?= $numero_siguiente ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #283D3B; font-size: 1.1rem;">
                                <span class="numero-pregunta text-white me-2"><?= $numero_siguiente ?></span>
                                Escribe tu pregunta
                                
                            </label>
                            <textarea name="pregunta" 
                                      class="form-control" 
                                      rows="3" 
                                      placeholder="Ejemplo: ¿Tienes experiencia previa con mascotas?"
                                      required
                                      style="font-size: 1rem;"></textarea>
                            <small class="text-muted">
                                Esta pregunta aparecerá en el formulario de adopción
                            </small>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                            <?php if($total_preguntas >= 3): ?>
                            <a href="Detalle_formulario.php?id_refugio=<?= $refugio['id_refugio'] ?>" 
                               class="btn btn-lg btn-naranja ">
                                <i class="bi bi-check-all me-1"></i>
                                Finalizar (Mínimo 3 preguntas listas)
                            </a>
                            <?php else: ?>
                            <div></div>
                            <?php endif; ?>
                            
                            <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #419D78;">
                                <i class="bi bi-plus-circle me-1"></i>
                                Guardar y <?= $numero_siguiente < 5 ? 'agregar otra' : 'finalizar' ?>
                            </button>
                        </div>
                    </form>
                    
                    <?php else: ?>
                    <!-- Ya llegó al límite de 5 preguntas -->
                    <div class="alert alert-success border-0 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3 fs-3"></i>
                        <div>
                            <h5 class="mb-1">¡Formulario completo!</h5>
                            <p class="mb-0">Ya agregaste las 5 preguntas máximas permitidas.</p>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <a href="Detalle_formulario.php?id_refugio=<?= $refugio['id_refugio'] ?>" 
                           class="btn btn-lg text-white" 
                           style="background-color: #FCCA46;">
                            <i class="bi bi-eye me-2"></i>
                            Ver mi formulario completo
                        </a>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <!-- Preguntas ya agregadas -->
            <?php if($total_preguntas > 0): ?>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 fw-bold" style="color: #283D3B;">
                        <i class="bi bi-list-check me-2"></i>
                        Preguntas agregadas (<?= $total_preguntas ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <?php foreach($preguntas_existentes as $p): ?>
                    <div class="pregunta-card bg-light p-3 mb-2 rounded">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-start flex-grow-1">
                                <span class="numero-pregunta text-white me-3 flex-shrink-0">
                                    <?= $p['numero_pregunta'] ?>
                                </span>
                                <div>
                                    <p class="mb-1 fw-semibold" style="color: #283D3B;">
                                        <?= htmlspecialchars($p['pregunta']) ?>
                                    </p>
                                    
                                </div>
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