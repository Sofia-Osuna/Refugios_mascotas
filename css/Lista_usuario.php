<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('clases/Usuario.php');
$clase = new Usuario();
$usuario = $clase->mostrar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista usuarios</title>
</head>
<body>
    <h1>Gestión de Usuarios</h1>
    
    <?php if(isset($_GET['msg'])): ?>
        <div class="mensaje success">
            <?php 
                if($_GET['msg'] == 'actualizado') echo 'Usuario actualizado correctamente';
                if($_GET['msg'] == 'eliminado') echo 'Usuario eliminado correctamente';
                if($_GET['msg'] == 'creado') echo 'Usuario creado correctamente';
            ?>
        </div>
        <?php endif; ?>
        <a href="Formulario_usuario.php">+ Nuevo Usuario</a>
        <table border="1">
             <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
             <tbody>
            <?php if(count($usuario) > 0): ?>
                <?php foreach($usuario as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['foto']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['password']) ?></td>
                        <td><?= htmlspecialchars($usuario['correo']) ?></td>
                        <td>
                     <a href="Detalles_usuario.php?id=<?= $usuario['id_usuario'] ?>">Detalles</a>
                            
                            <a href="controladores/eliminar_usuario.php?id=<?= $usuario['id_usuario'] ?>" 
                               onclick="return confirm('¿Estás seguro de eliminar a este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay usuarios registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
</body>
</html>