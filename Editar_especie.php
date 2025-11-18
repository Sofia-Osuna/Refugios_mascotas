
<?php
include('menu.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id_especie = $_GET['id'] ?? null;

if (!$id_especie) {
    echo "Error: ID no proporcionado";
    exit;
}
include('clases/Especie.php');
$clase = new Especie();
$resultado= $clase->Id($id_especie);

if (!$resultado ){
    echo "Especie no encontrada";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar especie</title>
   <link rel="stylesheet" href="css/bootstrap.css">
    <style>
         h1{
            text-align: center;
        }


        form {
        margin: 50px auto;
        width: 90%;
        max-width: 500px;
        padding: 20px;
    }
    
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    
    input[type="text"] {
     
    }

    .formulario_contenedor{
         max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background: ghostwhite;
    }

    .actualizar-boton{
          background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 200px;
            font-weight: bold;
    }

    .cancelar-boton{
          background: #FF802E;
            border-radius: 10px;
            border-color: #FF802E;
            height: 50px;
            width: 150px;
            font-weight: bold;

    }

    body{

    }

    
    


    </style>
</head>
<body>
<br> 
    
    <div class="formulario_contenedor">
    <form method="POST" action="controladores/actualizar_especie.php">
        <input type="hidden" name="id_especie" value="<?= $resultado['id_especie'] ?>">
        <h3 style="font-weight: 700;">Editar especie</h3>
        <br> <br>
        <label>Nombre de la especie:</label>
        <br>
        <input type="text" name="nombre" value="<?= $resultado['nombre'] ?>" required>
        <br><br>
        
        <button class="actualizar-boton" type="submit">Actualizar especie</button>
        <br> <br>
        <button class="cancelar-boton">Cancelar <a href="Lista_especie.php"></a> </button> 
        <br><br>
    </form>
    <br> <br>
  </div>
  <br> <br> <br> <br>
</body>
</html>
<?php 
include('Pie_pagina.php');
 ?>