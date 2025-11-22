<!-- en figma lo tenemos como " ver el formulario de adopción " aqui se van a ver todas las preguntas que un dueño de refugio agrego en el 
 formulario, si el dueño de refugio no añadio ninguna pregunta, Entonces aparecera el formulario de datos personales del usuario
 
 En pocas palabras, datos del usuario y el formulario de adopción se llenan en el mismo apartado, y el dueño de refugio no puede eliminar
 el formulario de datos personales del usuario.....

 nuevamente, todo lo que tiene que ver con el formulario de adopcion, tanto como las preguntas y respuestas, no se preocupen aun
 por el momento solo agrueguen el menu y pie de pagina
 -->
<?php 
include("menu.php");
?>  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles formulario</title>
    
</head>
<body>

<div class="py-3" style="background-color: #FCCA46;">
    <div class="container d-flex flex-wrap justify-content-start gap-4">
        <span class="fw-bold">Ver Mascotas</span>
        <span class="fw-bold">Historias Felices</span>
        <span class="fw-bold">Formulario de Adopción / Respuestas</span>
        <span class="fw-bold">Editar</span>
    </div>
</div>



                       
                       
       <!-- Botones más abajo -->
<div class="d-flex justify-content-center gap-3" style="margin-top: 400px;">
    <button type="button" class="btn btn-danger fw-bold px-4" href="Agregar_Preguntas">Agregar más preguntas</button>
    <button type="button" class="btn" style="background-color: #FCCA46; color: #333; font-weight: bold; padding: 10px 20px;">Editar</button>
</div>



                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include("Pie_pagina.php");
?>


</body>
</html>
