<?php
include('menu.php');
require_once('clases/Mascota.php');

$id_refugio = $_GET['id_refugio'];

if(empty($id_refugio)){
    die("Error: No se recibió el ID del refugio. <a href='Lista_refugio.php'>Volver</a>");
}

$mascota_obj = new Mascota();
$especies = $mascota_obj->obtenerEspecies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Mascota</title>

  

    <style>
        h1{
            text-align: center;
        }

        .tarjeta-mascotas{

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

        .btn-guardar-mascota{
           background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 200px;
            font-weight: bold;
        }

        .btn-cancelar-mascota{
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

        textarea{
            width: 250px;
            height: 140px;
            border-radius: 7px;

        }

        
    </style>
</head>
<body>
    <div class="tarjeta-mascotas">
    <form action="controladores/insertar_mascota.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="fk_refugio" value="<?= $id_refugio ?>">
        <br> <br> 
        <h3 style="font-weight: bold;">Agregar Mascota al Refugio</h3>
        <br> <br>
        <label for="">Nombre de la mascota: </label>
        <input type="text" name="nombre" required><br><br>

        <label for="">Descripción: </label>
          <textarea style="border-radius: 7px;" name="descripcion" required></textarea>
          <br><br>
      <label for="">Foto: </label>
        <input type="file" name="foto"><br><br>
        <label for="">Especie: </label>
        <select name="fk_especie" required>
            <option value="">Selecciona una especie</option>
            <?php foreach($especies as $especie){ ?>
                <option value="<?= $especie['id_especie'] ?>">
                    <?= $especie['nombre'] ?>
                </option>
            <?php } ?>
        </select>

        <br><br><br>

        <input class="btn-guardar-mascota" type="submit" name="guardar" value="Guardar Mascota">
        <br>
        <a href="detalles_refugio.php?id=<?= $id_refugio ?>">
            <button class="btn-cancelar-mascota">Cancelar</button>

            <br> <br>
        </a>
    </form>
    </div>
</body>
</html>
<?php 
include('Pie_pagina.php');
 ?>