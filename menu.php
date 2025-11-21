<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="css/estilo.css">
    <!-- Poner otra imagen, no se con un corazon o algo asi -->


    <link rel="icon" type="image/png" href="img_sistema/logo_color.png"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
  .navbar-collapse {
    background-color: #85B79D;
    padding: 15px;
    margin-top: 10px;
    border-radius: 5px;
}
</style>

<nav class="navbar navbar-dark navbar-custom">
  <div class="container-fluid">
    
    <a class="navbar-brand" href="#">
        <img  src="img_sistema/logo.png" alt="logo" class="d-inline-block align-text-top me-2" style="height: 60px" >

        RefuPETS
    </a>

     <!-- Botón hamburguesa (se muestra en móviles) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Menú que se colapsa -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="row">
            
        <div class="col-md-4">
          <ul class="navbar-nav">

<?php if(isset($_SESSION['username'])){ ?>
    <h5 class="navbar-"><?= $_SESSION['username'] ?></h5>
<?php } else { ?>
    <a href="Inicio_sesion.php">Iniciar sesión</a>
<?php } ?>            

<li class="nav-item"><a class="nav-link" href="Datospersonales.php">Ver perfil</a></li>
            <li class="nav-item"><a class="nav-link" href="controladores/cerrar_sesion.php">Cerrar sesión </a></li>
            <li class="nav-item"><a class="nav-link" href="Lista_usuario.php">Lista de usuario</a></li>
          </ul>
        </div>

        <div class="col-md-4">
          <ul class="navbar-nav">

            <li class="nav-item"><a class="nav-link" href="Lista_refugio.php">Lista de Refugio</a></li>
            <li class="nav-item"><a class="nav-link" href="Formulario_refugio.php">Crear un nuevo refugio</a></li>
            <li class="nav-item"><a class="nav-link" href="detalles_refugio.php">ver mi Refugio</a></li>
            <li class="nav-item"><a class="nav-link" href="Lista_refugio.php">Lista de refugios</a></li>
            <li class="nav-item"><a class="nav-link" href="Lista_especie.php">ver especies</a></li>
          </ul>
          


        </div>
      
    </div>
    
  </div>
</nav>

<!-- Bootstrap JS Bundle (incluye Popper) -->
  <script src="js/bootstrap.bundle.min.js"></script></body>
</html>