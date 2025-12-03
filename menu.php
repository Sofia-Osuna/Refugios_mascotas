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
    <link rel="icon" type="image/png" href="img_sistema/logo_color.png"> 
</head>
<body>

<nav class="navbar navbar-dark navbar-custom">
    <div class="container-fluid">
        
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="img_sistema/logo.png" alt="logo" class="navbar-logo me-2">
            <span class="navbar-logo-text">RefuPETS</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse menu-mobile-container" id="navbarNav">
            <div class="row w-100 mt-3">
                
                <!-- Sección Usuario -->
                <div class="col-md-4 mb-3">
                    <p class="menu-section-title">Usuario</p>
                    
                    <?php if(isset($_SESSION['username'])){ ?>
                        <div class="user-welcome mb-3">
                            Bienvenido, <?= $_SESSION['username'] ?>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="Datospersonales.php">Ver perfil</a></li>
                            
                            <?php if($_SESSION['fk_rol'] == 1){ ?>
                                <li class="nav-item"><a class="nav-link" href="Lista_usuario.php">Lista de usuarios</a></li>
                            <?php } ?>
                            
                            <li class="nav-item mt-2">
                                <a class="btn-logout" href="controladores/cerrar_sesion.php">Cerrar sesión</a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <a href="Inicio_sesion.php" class="nav-link">
                            Iniciar sesión
                        </a>
                    <?php } ?>
                </div>

                <!-- Sección Refugios -->
                <?php if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 3){ ?>
                    <!-- PARA TODOS excepto GESTOR (3) -->
                    <div class="col-md-4 mb-3">
                        <p class="menu-section-title">Refugios</p>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="Lista_refugio.php">Ver refugios</a></li>
                            
                            <!-- Solo ADMIN (1) puede crear refugio -->
                            <?php if(isset($_SESSION['fk_rol']) && $_SESSION['fk_rol'] == 1){ ?>
                                <li class="nav-item"><a class="nav-link" href="Formulario_refugio.php">Crear refugio</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } else { ?>
                    <!-- SOLO PARA GESTOR (3) -->
                    <div class="col-md-4 mb-3">
                        <p class="menu-section-title">Mis Refugios</p>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="Formulario_refugio.php">Crear refugio</a></li>
                            <li class="nav-item"><a class="nav-link" href="mis_refugios.php">Ver mis refugios</a></li>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Sección Más opciones -->
                <div class="col-md-4 mb-3">
                    <p class="menu-section-title">Más opciones</p>
                    <ul class="navbar-nav">
                        <!-- Solo ADMIN (1) puede ver especies -->
                        <?php if(isset($_SESSION['fk_rol']) && $_SESSION['fk_rol'] == 1){ ?>
                            <li class="nav-item"><a class="nav-link" href="Lista_especie.php">Ver especies</a></li>
                        <?php } ?>
                        
                        <!-- Historias felices - SOLO para Admin y Usuario normal (NO gestor) -->
                        <?php if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 3){ ?>
                            <li class="nav-item"><a class="nav-link" href="Todas_historias_felices.php">Historias felices</a></li>
                        <?php } ?>
                        
                        <!-- Mascotas - SOLO para Admin y Usuario normal (NO gestor) -->
                        <?php if(!isset($_SESSION['fk_rol']) || $_SESSION['fk_rol'] != 3){ ?>
                            <li class="nav-item"><a class="nav-link" href="Todas_mascotas.php">Mascotas</a></li>
                        <?php } ?>
                        
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    </ul>
                </div>

            </div>
        </div>
        
    </div>
</nav>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>