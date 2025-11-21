<?php 
include('menu.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Adopción</title>
 
</head>

<body>

<div class="container my-5">
    <div class="card shadow">
        
        <div class="card-header text-white text-center fw-bold" style="background-color: #85B79D;">
            Formulario de Adopción
        </div>

        <div class="card-body">

            <p class="text-muted text-center mb-4">
                Este es el formulario que debe responder un usuario para adoptar una mascota.
                Las preguntas serán generadas por el refugio.
            </p>

            <form action="#" method="POST">

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Usuario</label>
                    <input type="text" class="form-control" placeholder="ID del usuario">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Foto de perfil</label>
                    <input type="file" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Rol (FK)</label>
                    <input type="text" class="form-control" placeholder="Rol del usuario">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Estatus</label>
                    <input type="text" class="form-control" placeholder="Estatus del usuario">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre completo">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Contraseña</label>
                    <input type="password" class="form-control" placeholder="Contraseña">
                </div>

                <button type="submit" class="btn text-dark fw-bold px-4" style="background-color:#ffcf48; border-radius:15px;">
                    Enviar 
                </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>

<?php 
include('Pie_pagina.php');
?>
