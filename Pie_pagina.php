<!-- este va a ser el pie de pagina, nuevamente se tiene que incluir en casi todas las paginas  -->
 <!-- sofia -->

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
     <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/estilo.css">
    <!-- Poner otra imagen, no se con un corazon o algo asi -->
    <link rel="icon" type="image/png" href="img_sistema/logo_color.png"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 </head>
 <body>

    <!-- ya se que le dije que todo lo del texto va en el estilo. una vez que terminen  -->
    <style>

        .textocolor{
            color: #283D3B;
        }
        .Piecustom{
            background-color: #85B79D; 
        }   

    </style>
<footer class=" Piecustom py-4 mt-5">
  <div class="container">
    <!-- div con la clase de row, fila para que los divs dentro de esta aparezcan como fila, uno al lado de otro xd -->
    <div class="row">
      
      <!-- Columna 1-->
      <div class="col-md-4 textocolor mb-3">
        <img  src="img_sistema/logo.png" alt="logo" class="d-inline-block align-text-top me-2" style="height: 60px" >
        <h5 class="textocolor">RefuPets</h5>
        <p class="small"> "Conectando Familias."</p>
      </div>
      
      <!-- Columna 2-->
      <div class="col-md-4 mb-3">
        <h5 class="textocolor">Enlaces</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="textocolor">Inicio</a></li>
          
          <li><a href="Lista_refugio.php" class="textocolor">Refugios</a></li>
          <!-- <li><a href="Informacion.php" class="textocolor">información</a></li> -->
        </ul>
      </div>
      
      <!-- Columna 3-->
      <div class="col-md-4 mb-3">
        <h5 class="textocolor">Proyecto Final 4to Cuatrimestre</h5>
        <p class="small textocolor textocolor">
          <strong>Integrantes del equipo:</strong><br>
          Sofía Osuna Delgado<br>
          Brayan Martin Lopez Flores<br>
          Carla Lorena Cardenaz Hernandez <br> 
          Pedro Antonio Sanchez Sandoval<br>
          
          
        </p>
        <p class="small">UNIVERSIDAD TECNOLOGICA DE ESCUINAPA<br>Aplicaciones web</p>
      </div>
      
      <!-- fin del div con la clase row -->
    </div>
    
    <!-- Línea separadora -->
    <hr class="bg-white">
    
    <!-- Copyright -->
    <div class="text-center small">
      <p class="mb-0 textocolor">© 2024 RefuPets - Todos los derechos reservados | Proyecto con fines educativos</p>
    </div>
    
  </div>
</footer>


 </body>
 </html>