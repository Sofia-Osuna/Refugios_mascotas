<!-- Aqui se van a hacer los formularios, por el momento solo se van a registrar 10 preguntas -->
<?php
   include('menu.php');
   include('menu_refugio.php');
   $clase = new Refugio();
   $id_refugio = $_GET['id_refugio'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Crear Formulario de Adopción</title>
   
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
         <div class="alert alert-warning border-0 mb-4 texto-lora" style="background-color: #FFF9E6;">
            <div class="d-flex align-items-start">
               <i class="bi bi-info-circle-fill me-3 fs-3" style="color: #FE7F2D;"></i>
               <div>
                  <h5 class="fw-bold mb-2" style="color: #283D3B;">¡Información importante!</h5>
                  <p class="mb-0">
                     Por el momento solo estamos manejando los formularios de <strong>5 preguntas</strong> 
                     de respuesta abierta. ¡Esperamos poder brindarte una mayor personalización 
                     a tus formularios en un futuro!
                  </p>
               </div>
            </div>
         </div>
         
         <!-- Card principal -->
         <div class="card shadow-sm">
            <div class="card-header" style="background-color: #85B79D;">
               <h3 class="mb-0 text-white">
                  <i class="bi bi-clipboard-plus me-2"></i>
                  Crear Formulario de Adopción
               </h3>
            </div>
            
            <div class="card-body p-4">
               
               <p class="text-muted mb-4">
                  Este formulario lo responderán los usuarios interesados en adoptar tus mascotas. 
                  Define un nombre descriptivo y una breve descripción.
               </p>
               
               <!-- Formulario -->
               <form action="controladores/Insertar_formulario.php" method="POST">
                  <input type="hidden" name="fk_refugio" value="<?= $id_refugio ?>">

                  <!-- Nombre del formulario -->
                  <div class="mb-4">
                     <label for="nombre_formulario" class="form-label fw-bold" style="color: #283D3B;">
                        Nombre del formulario <span class="text-danger">*</span>
                     </label>
                     <input type="text" 
                            class="form-control" 
                            id="nombre_formulario" 
                            name="nombre_formulario" 
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
                               placeholder="Aqui puedes poner instrucciones para las personas interesadas en adoptar"></textarea>
                     <small class="text-muted">
                        Puedes agregar notas o detalles sobre el propósito de este formulario.
                     </small>
                  </div>

                  <!-- Vista previa de lo que sigue -->
                  <div class="alert border-0 mb-4" style="background-color: #E8F5E9;">
                     <div class="d-flex align-items-center">
                        <i class="bi bi-arrow-right-circle-fill me-3 fs-4" style="color: #419D78;"></i>
                        <div>
                           <strong style="color: #283D3B;">Siguiente paso:</strong>
                           <p class="mb-0 small text-muted mt-1">
                              Después de guardar, podrás agregar las  preguntas que los usuarios responderán.
                           </p>
                        </div>
                     </div>
                  </div>

                  <!-- Botones -->
                  <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                     <a href="Detalle_formulario.php?id_refugio=<?= $id_refugio ?>" 
                        class="btn btn-lg btn-naranja">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancelar
                     </a>
                     
                     <button type="submit" name="guardar" class="btn btn-lg text-white" style="background-color: #419D78;">
                        <i class="bi bi-check-circle me-1"></i>
                        Guardar y continuar
                     </button>
                  </div>
               </form>
               
            </div>
         </div>
         
         <!-- Tarjeta informativa adicional -->
         <div class="card border-0 shadow-sm mt-4" style="background-color: #F8F9FA;">
            <div class="card-body p-4">
               <h6 class="fw-bold mb-3" style="color: #283D3B;">
                  <i class="bi bi-lightbulb-fill me-2" style="color: #FCCA46;"></i>
                  ¿Qué preguntas puedo incluir?
               </h6>
               <ul class="mb-0 text-muted small">
                  <li class="mb-2">Experiencia previa con mascotas</li>
                  <li class="mb-2">Características del hogar (casa, departamento, patio)</li>
                  <li class="mb-2">Tiempo disponible para cuidar a la mascota</li>
                  <li class="mb-2">Acuerdo familiar sobre la adopción</li>
                  <li class="mb-2">Motivaciones para adoptar</li>
               </ul>
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