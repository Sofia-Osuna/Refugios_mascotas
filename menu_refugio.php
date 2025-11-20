<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!-- ESTE ARCHIVO LO VAN A AGREGAR EN TODOS LAS PAGINAS DE REFUGIO -->
    <nav class="navbar navbar-expand-lg" style="background-color: #FCCA46; padding: 1rem;">
    <div class="container-fluid">
    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRefugio" aria-controls="navbarRefugio" aria-expanded="false" aria-label="Toggle navigation" style="border-color: #000;">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse justify-content-center" id="navbarRefugio">
            <ul class="navbar-nav gap-5">
        
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="editar_refugio.php?id=<?= $refugio['id_refugio'] ?>">
                        Editar Refugio
                    </a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="controladores/eliminar_refugio.php?id=<?= $refugio['id_refugio'] ?>" onclick="return confirm('¿Estás seguro de eliminar este refugio?')">
                        Eliminar Refugio
                    </a>
                </li>
        
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="Lista_mascota.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Lista de Mascotas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3s" href="#">
                        Historias Felices
                    </a>
                </li>
        
            </ul>
        </div>
    </div>
</nav>

</body>
</html>