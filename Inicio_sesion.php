<?php
session_start();
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-100" style="max-width: 400px;">

        <h2 class="text-center mb-4 fw-bold" style="color:#85B79D;">
            Bienvenido
        </h2>

        <!-- MENSAJES DE ERROR -->
        <?php if($error == 'vacio'){ ?>
            <div class="alert alert-warning text-center">
                 Por favor ingresa tu usuario y contraseña
            </div>
        <?php } ?>
        
        <?php if($error == 'incorrecto'){ ?>
            <div class="alert alert-danger text-center">
                 Usuario o contraseña incorrectos
            </div>
        <?php } ?>

        <form action="controladores/iniciar_sesion.php" method="POST">

            <div class="mb-3">
                <label class="form-label fw-bold">Nombre de usuario</label>
                <input type="text" name="user" class="form-control fw-bold">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Contraseña</label>
                <input type="password" name="contra" class="form-control fw-bold">
            </div>

            <button type="submit" name="Ingresar"
                class="btn w-100 fw-bold text-white"
                style="background-color: #85B79D;">
                Iniciar sesión
            </button>
        </form>

        <div class="text-center mt-3">
            <p class="mb-1 fw-bold text-muted">¿No tienes cuenta?</p>
            <a href="Formulario_usuario.php" class="fw-bold text-decoration-none" style="color:#85B79D;">
                Crea tu cuenta aquí
            </a>
        </div>

    </div>
</div>

</body>
</html>