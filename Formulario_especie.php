<?php 
    include('menu.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para nuevas especies</title>



    <style>
        .boton-agregar{
             background-color: #85B79D;
            color: #333;
            padding: 12px ;
            border: none;
            border-radius: 15px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tarejta-agregar{
             max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background: ghostwhite;
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
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border-color: black;
    }

    </style>
</head>
<body>
    <br>
   
     <br>
     <div class="tarejta-agregar">
    <form action="controladores/Insertar_especie.php" method="POST" enctype="multipart/form-data">
        <label for="">nombre de la especie:</label>
        <br>
        <input class="inp" type="text" name="nombre" id="">
        <br>

       <a href="">
        <br>
           <button class="boton-agregar">Confirmar</button>
           <br>
       </a>
    <br>
    </form>
    </div>
    <br>
</body>
<br> <br> <br> <br> <br> <br>
</html>
<?php 
    include('Pie_pagina.php');
?>