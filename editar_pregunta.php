<?php
    include('menu.php');
    include('menu_refugio.php');

    $id_pregunta = $_GET['id_pregunta'];
    $id_refugio = $_GET ['id_refugio'];

    include('clases/Preguntas_form.php');
    $clase = new Preguntas();
    $resultado = $clase->mostrarPregunta($id_refugio);
    $pregunta_actual = $clase->mostrarPregunta($id_pregunta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pregunta</title>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                <!-- Card principal -->
                <div class="card shadow-lg border-0">
                    
                    <!-- Header con gradiente -->
                    <div class="header-formulario text-white p-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-pencil-square me-3 fs-3"></i>
                            <div>
                                <h2 class="h4 fw-bold mb-1">Editar Pregunta</h2>
                                <p class="mb-0 opacity-75">Actualiza el contenido de la pregunta</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cuerpo del formulario -->
                    <div class="card-body p-4 p-lg-5">
                        <form action="controladores/actualizar_pregunta.php" method="POST">
                            <input type="hidden" name="id_pregunta" id="id_pregunta" value="<?= $id_pregunta?>">
                            <input type="hidden" name="id_refugio" id="id_refugio" value="<?= $id_refugio ?>">
                            
                            <!-- Campo de pregunta -->
                            <div class="mb-4">
                                <label for="pregunta" class="form-label fw-semibold fs-5" style="color: #283D3B;">
                                    Texto de la pregunta
                                </label>
                                <textarea 
                                    name="pregunta" 
                                    id="pregunta" 
                                    class="form-control form-control-lg border-2"
                                    rows="4"
                                    style="border-color: #85B79D;"
                                    placeholder="Escribe la pregunta aquí..."
                                    required
                                ><?= htmlspecialchars($pregunta_actual['pregunta']) ?></textarea>
                                <div class="form-text text-muted mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Puedes modificar el texto de la pregunta según tus necesidades.
                                </div>
                            </div>
                            
                            <!-- Información de la pregunta -->
                            <div class="alert alert-light border mb-4 bg-light">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-6 text-center">
                                        <small class="text-muted d-block">Número de pregunta</small>
                                        <strong class="fs-5"><?= $pregunta_actual['numero_pregunta'] ?></strong>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botones de acción -->
                            <div class="d-flex gap-3 justify-content-end pt-3 border-top">
                                <a href="Detalle_formulario.php?id_refugio=<?= $id_refugio ?>" 
                                   class="btn btn-naranja px-4 py-2">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Cancelar
                                </a>
                                <button type="submit" name="guardar" class="btn btn-lg text-white px-4 py-2" style="background-color: #419D78;">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
<?php
include('pie_pagina.php');
?>