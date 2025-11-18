<?php 
include('menu.php');
 ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Refugio</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h3{
            text-align: center;
        }

        .card-ref{
             max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background: ghostwhite;
        }
    </style>
</head>
<body>
    <div class="card-ref">
    
        <br>
        <h3>Hola</h3>
        <label for="">Nombre del refugio: </label>
        <input class="inp" type="text" name="nombre" id=""><br><br>

        <label for="">descripción del refugio: </label>
        <textarea name="descripcion" id=""></textarea>

        <label for="">Foto: </label>
        <input type="file" name="foto"><br><br>


        <h3>Dirección</h3>

        <label for="">Estado: </label>
        <input class="inp" type="text" name="estado" id=""><br><br>

        <label for="">Municipio: </label>
        <input class="inp" type="text" name="municipio" id=""><br><br>

        <label for="">Nombre de la calle: </label>
        <input class="inp" type="text" name="nombre_calle" id=""><br><br>

        <label for="">Número Interior: </label>
        <input class="inp" type="text" name="numero_interior" id=""><br><br>

        <label for="">Número Exterior: </label>
        <input class="inp" type="text" name="numero_exterior" id=""><br><br>

        <label for="">Codigo Postal: </label>
        <input class="inp" type="text" name="cp" id=""><br><br>

        <input  class="boton" type="submit" name="guardar" id="">
    </form>
    </div>
    <?php 
    include('Pie_pagina.php');
     ?>

