<?php
include('menu.php');
include('menu_refugio.php');
include('clases/Formulario.php');

$clase = new Formulario();
$id_formulario = $_GET['id_formulario'];
$id_refugio = $_GET['id_refugio'];

// Obtener datos actuales del formulario
$datos = $clase->Id($id_formulario);

if(!$datos) {
    die("Formulario no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar Formulario de Adopción</title>
   
   <!-- Bootstrap CSS -->
   <link href="css/bootstrap.css" rel="stylesheet">
   
   <!-- Tu CSS personalizado -->
   <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
   <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
         
         <!-- Info Box -->
         <div class="alert alert-info border-0 mb-4" style="background-color: #E3F2FD;">
            <div class="d-flex align-items-start">
               <i class="bi bi-pencil-square me-3 fs-3" style="color: #0277BD;"></i>
               <div>
                  <h5 class="fw-bold mb-2" style="color: #283D3B;">Editando formulario</h5>
                  <p class="mb-0">
                     Modifica el nombre o descripción de tu formulario. 
                     Para editar las preguntas, ve a la sección de preguntas.
                  </p>
               </div>
            </div>
         </div>
         
         <!-- Card principal -->
         <div class="card shadow-sm">
            <div class="card-header" style="background-color: #85B79D;">
               <h3 class="mb-0 text-white">
                  <i class="bi bi-pencil-square me-2"></i>
                  Editar Formulario de Adopción
               </h3>
            </div>
            
            <div class="card-body p-4">
               
               <p class="text-muted mb-4">
                  Actualiza la información de tu formulario de adopción.
               </p>
               
               <!-- Formulario -->
               <form action="controladores/actualizar_formulario.php" method="POST">
                  <input type="hidden" name="id_formulario" value="<?= $id_formulario ?>">
                  <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">

                  <!-- Nombre del formulario -->
                  <div class="mb-4">
                     <label for="nombre_formulario" class="form-label fw-bold" style="color: #283D3B;">
                        Nombre del formulario <span class="text-danger">*</span>
                     </label>
                     <input type="text" 
                            class="form-control" 
                            id="nombre_formulario" 
                            name="nombre_formulario" 
                            value="<?= htmlspecialchars($datos['nombre_formulario']) ?>"
                            placeholder="Ejemplo: Formulario de Adopción Noviembre 2025"
                            required>
                     <small class="text-muted">
                        Este nombre es solo para tu referencia interna.
                     </small>
                  </div>

                  <!-- Descripción del formulario -->
                  <div class="mb-4">
                     <label for="descripcion" class="form-label fw-bold" style="color: #283D3B;">
                        Descripción del formulario 
                     </label>
                     <textarea class="form-control" 
                               id="descripcion" 
                               name="descripcion" 
                               rows="4"
                               placeholder="Aquí puedes poner instrucciones para las personas interesadas en adoptar"><?= htmlspecialchars($datos['descripcion']) ?></textarea>
                     <small class="text-muted">
                        Puedes agregar notas o detalles sobre el propósito de este formulario.
                     </small>
                  </div>

                  <!-- Info sobre las preguntas -->
                  <div class="alert border-0 mb-4" style="background-color: #FFF9E6;">
                     <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle me-3 fs-5" style="color: #FE7F2D;"></i>
                        <div>
                           <strong style="color: #283D3B;">Nota:</strong>
                           <p class="mb-0 small text-muted mt-1">
                              Las preguntas se editan por separado. Termina de guardar estos cambios primero.
                           </p>
                        </div>
                     </div>
                  </div>

                  <!-- Botones -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                     <a href="Detalle_formulario.php?id_refugio=<?= $id_refugio ?>" 
                        class="btn btn-lg btn-naranja ">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancelar
                     </a>
                     
                     <button type="submit" name="actualizar" class="btn btn-lg text-white" style="background-color: #419D78;">
                        <i class="bi bi-check-circle me-1"></i>
                        Guardar cambios
                     </button>
                  </div>
               </form>
               
            </div>
         </div>
         
         <!-- Fecha de creación -->
         <div class="card border-0 shadow-sm mt-4" style="background-color: #F8F9FA;">
            <div class="card-body p-3">
               <small class="text-muted">
                  <i class="bi bi-clock-history me-2"></i>
                  Formulario creado el <?= date('d/m/Y', strtotime($datos['fecha'])) ?>
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