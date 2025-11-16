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
    <title>Editar informacion del usuario</title>

    <style>
        h2{
            text-align: center;
        }

        .tarjeta-editar{
     min-height: 60vh; 
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    background: gray;
     max-width: 800px;
     margin: 40px auto;
     padding: 0 20px;
     background: ghostwhite;
        }

        .boton-guardar{
            background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 150px;
        }

        .boton-eliminar{
            background: #FF802E;
            border-radius: 10px;
            border-color: #FF802E;
            height: 50px;
            width: 150px;
        }


    </style>
</head>
<body>
  <br>
    <h2>Editar datos del usuario</h2>
    <br>
    <div class="tarjeta-editar">
    <form action="controladores/actualizar_usuario.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
        <br>
        <label for="">Nombre de usuario: </label>
        <input class="inp" type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br><br>

        <label for="">Contraseña: </label>
        <input class="inp" type="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required><br><br>
        <!--Que no se me olvide ver como hacer para ocultar y mostrar la contraseña, se hace con javascript, un boton y asi xdxd-->
        <label for="">Foto de perfil</label>
        <input type="file" name="foto"><br><br>
        
        <label for="">Correo </label>
        <input class="inp" type="text" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required><br><br>

        <a href="">
            <button class="boton-guardar">Guardar cambios</button>
            <br>
        </a>
          <br>
        <a href="">
            <button class="boton-eliminar">Eliminar</button>
            <br> <br>
        </a>
     <br>

</form>

</div>
<br>
</body>
<br>
</html>
<br>
<?php 
include('Pie_pagina.php');
 ?>