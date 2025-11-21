<!-- Aqui el usuario edita las preguntas, asi que se deben de jalar las preguntas de la base de datos y agregarse aqui -->
<?php 
include('menu.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Información de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container my-5">
    <div class="card shadow">
        
        <div class="card-header text-white text-center fw-bold" style="background-color: #85B79D;">
            Editar Información de Usuario
        </div>

        <div class="card-body">

            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Usuario</label>
                    <input type="text" class="form-control" value="" placeholder="ID del usuario" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Foto de perfil</label>
                    <input type="file" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Rol (FK)</label>
                    <input type="text" class="form-control" value="" placeholder="Rol del usuario">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Estatus</label>
                    <input type="text" class="form-control" value="" placeholder="Estatus del usuario">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" value="" placeholder="Nombre completo">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Contraseña</label>
                    <input type="password" class="form-control" value="" placeholder="Contraseña">
                </div>

                <button type="submit" class="btn text-dark fw-bold px-4 me-2" style="background-color:#ffcf48; border-radius:15px;">
                    Guardar cambios
                </button>
                <button type="reset" class="btn btn-danger fw-bold px-4" style="border-radius:15px;">
                    Eliminar
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
