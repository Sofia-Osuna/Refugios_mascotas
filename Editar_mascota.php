<?php
include('menu.php'); 
require_once('clases/Mascota.php');
$id = $_GET['id'];
$id_refugio = $_GET['id_refugio'];

$mascota_obj = new Mascota();
$mascota = $mascota_obj->obtenerMascota($id);
$especies = $mascota_obj->obtenerEspecies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>

    <style>
        h2{
            text-align: center;
        }

        .tarjeta-mascota-editar{
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



        label{
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        textarea{
            width: 250px;
            height: 140px;
            border-radius: 7px;

        }

        .boton-actualizar-mascota{
            background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 150px;
            font-weight: bold;
        }

        .boton-cancelacion{
        background: #FF802E;
            border-radius: 10px;
            border-color: #FF802E;
            height: 50px;
            width: 150px;
            font-weight: bold;
        }

        select{
            border-radius: 6px;
        }

        
           
        
    </style>
</head>
<body>

    
   <div class="tarjeta-mascota-editar">
  <form action="controladores/actualizar_mascota.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_mascota" value="<?= $mascota['id_mascotas'] ?>">
    <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">
    <br> <br>
    <h2>Editar mascota</h2>
    <br> <br>
    Nombre:<br>
    <input type="text" name="nombre" value="<?= $mascota['nombre'] ?>" required><br><br>
    
    Descripción:
    <br> 
    <textarea name="descripcion" required><?= $mascota['descripcion'] ?></textarea>
    <br><br>
    
    Foto actual: <?= $mascota['foto'] ?>
    <br> <br>
    Nueva foto (opcional):
    <br> <br>
    <input type="file" name="foto">
    <br><br>
    
    Especie:<br>
    <select name="fk_especie" required>
        <?php foreach($especies as $especie){ ?>
            <option value="<?= $especie['id_especie'] ?>" <?= $especie['id_especie'] == $mascota['fk_especie'] ? 'selected' : '' ?>>
                <?= $especie['nombre'] ?>
            </option>
        <?php } ?>
    </select>

    <br><br><br>
    
    <button class="boton-actualizar-mascota" type="submit">Actualizar</button>
    <br> <br>
    <a href="Lista_mascota.php?id_refugio=<?= $id_refugio ?>">
        <button class="boton-cancelacion">Cancelar</button>
    </a>
    <br> <br> <br>
</form>
</div> 
</body>
</html>
<?php 
include('Pie_pagina.php');
 ?>