<?php 
include('menu.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>

    
    <style>
        h3{
            text-align: center;
            
        }



        

   .contenedor-usuario{
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

        body{
           
        }

        .boton-cuenta{
            background: #419D78;
            border-color: #419D78;
            border-radius: 10px;
             height: 50px;
            width: 150px;
            font-weight: bold;
        }

        

      

        
    </style>
</head>
<body>
    <br>
    
    

    <div class="contenedor-usuario">
    <form action="controladores/Insertar_usuario.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 style="font-weight: 700;">Crea tu cuenta</h3>
        <br><br>
        <label for="">Nombre de usuario:</label>
        <br>
        <input class="inp" type="text" name="nombre" id="">
        <br>

        <label for="">Contraseña: </label>
        <br>
        <input class="inp" type="password" name="password" id="">
        <br>
        <!--Que no se me olvide ver como hacer para ocultar y mostrar la contraseña, se hace con javascript, un boton y asi xdxd-->
        <label for="">Foto: </label>

        <input type="file" name="foto">
        <br>
        
        <label for="">Correo electronico: </label>
        <input class="inp" type="text" name="correo" id="">
        <br>
        
        <a href="">
            <button class="boton-cuenta">Crear cuenta</button>
          <br> <br> <br>
        </a>
        

    </div>
    </form>

</body>
</html>
<?php 
include('Pie_pagina.php')
 ?>