<?php
include('menu.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_usuario = $_GET['id'] ?? null;



include('clases/Usuario.php');
$clase = new Usuario();
$usuario = $clase->obtenerPorId($id_usuario);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del usuario</title>

    <style>
        h2{
            text-align: center;
        }

         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Contenedor principal */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;

        }

        /* Sección de perfil */
        .profile-section {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .profile-image {
            flex-shrink: 0;
        }

        .image-placeholder {
            width: 180px;
            height: 180px;
            border: 2px solid #ddd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 18px;
            background-color: #fafafa;
        }

        .profile-info {
            flex: 1;
        }

        .info-item {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
        }

        /* Botones */
        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .actions a {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #e8f4f1;
            color: #2c3e50;
        }

        .btn-primary:hover {
            background-color: #d0ebe4;
        }

        .btn-secondary {
            background-color: #fef0f0;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background-color: #fde0e0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .chat-icon {
                position: static;
                margin: 10px auto;
            }

            .actions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<br>
    <h2>
        Informacion personal
    </h2>

    <br>

    <div class="container">
        <div class="profile-section">
            <div class="profile-image">
                <div class="image-placeholder">Imagen</div>
            </div>

            <div class="profile-info">
                
                <div class="info-item">
                    <div class="info-label">Nombre del usuario</div>
                    <div class="info-value"></div>
                </div>

                <div class="info-item">
                    <div class="info-label">Correo</div>
                    <div class="info-value"></div>
                </div>

                <div class="info-item">
                    <div class="info-label">Teléfono</div>
                    <div class="info-value"></div>
                </div>

                <div class="info-item">
                    <div class="info-label">Datos personales</div>
                    <div class="info-value"></div>
                </div>
   <div class="actions">  
    <a href="Editar_usuario.php?id=<?= $usuario['id_usuario'] ?>">Editar información</a>
    <a href="controladores/eliminar_especie.php?id=<?= $usuario['id_usuario'] ?>" onclick="return confirm('¿Estás seguro de eliminar esta especie?')">Eliminar</a>
</div>
</div>
</div>
</div>

    
</body>

</html>
<br> <br> <br> <br>
<?php 
include('Pie_pagina.php')
 ?>