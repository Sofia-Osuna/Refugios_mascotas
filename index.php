<?php
    include('menu.php');

    // php para el carrusel
    $carpeta_imagenes = 'Imagenes_animales/'; // Carpeta donde están las imágenes
    $extensiones_validas = array('jpg', 'jpeg', 'png', 'gif', 'webp'); // Extensiones permitidas
    $numero_imagenes_aleatorias = 5; // Cuántas imágenes mostrar en el carrusel


    $imagenes = array();
    if (is_dir($carpeta_imagenes)) {
        $archivos = scandir($carpeta_imagenes);
        foreach ($archivos as $archivo) {
            $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            if (in_array($extension, $extensiones_validas)) {
                $imagenes[] = $carpeta_imagenes . $archivo;
            }
        }
    }
    shuffle($imagenes);
    $imagenes_carrusel = array_slice($imagenes, 0, $numero_imagenes_aleatorias);
    //fin del php del carrusel

    //imagenes dinamicas del pedro (Aqui pon todo el codigo de eso pedroo, para que no se revuelva con el html)
    $conexion = new mysqli("localhost", "root", "", "refugios_mascotas");

    if ($conexion->connect_error) {
    
        $mascotas = [];
        $refugios = [];
    } else {
    
        $query_mascotas = "SELECT m.* FROM mascotas m INNER JOIN refugio r ON m.fk_refugio = r.id_refugio WHERE m.estatus = 'disponible' AND r.estatus = 1 ORDER BY RAND() LIMIT 3";
        $result_mascotas = $conexion->query($query_mascotas);
        $mascotas = $result_mascotas ? $result_mascotas->fetch_all(MYSQLI_ASSOC) : [];

     
        $query_refugios = "SELECT r.* FROM refugio r 
                  WHERE r.estatus = 1 
                  ORDER BY RAND() LIMIT 3";
        $result_refugios = $conexion->query($query_refugios);
        $refugios = $result_refugios ? $result_refugios->fetch_all(MYSQLI_ASSOC) : [];

        $conexion->close();
    }
    

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefuPETS</title>
    <script src="js/carousel.js"></script>
 
</head>
<body>

  

<!--Inicio del carrusel -->
<section class="carousel-section py-5" style="background: linear-gradient(135deg, #85B79D 0%, #FCCA46 100%);">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-white">Nuestras Historias de Éxito</h2>
        
        <?php if (count($imagenes_carrusel) > 0): ?>
        <div id="carouselRefuPets" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!-- Indicadores -->
            <div class="carousel-indicators">
                <?php foreach ($imagenes_carrusel as $index => $imagen): ?>
                <button type="button" 
                        data-bs-target="#carouselRefuPets" 
                        data-bs-slide-to="<?php echo $index; ?>" 
                        <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?>
                        aria-label="Slide <?php echo $index + 1; ?>">
                </button>
                <?php endforeach; ?>
            </div>

            <!-- diapositivas? -->
            <div class="carousel-inner rounded shadow-lg">
                <?php foreach ($imagenes_carrusel as $index => $imagen): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo htmlspecialchars($imagen); ?>" 
                         class="d-block w-100 carousel-image" 
                         alt="Mascota <?php echo $index + 1; ?>">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                        <h5 class="fw-bold">¡Encuentra tu compañero ideal!</h5>
                        <p>Cada mascota tiene una historia única y está esperando por ti.</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- fin diapositiva o no sé como -->

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRefuPets" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRefuPets" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            <p class="texto-lora mb-0">No se encontraron imágenes en la carpeta especificada.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
    <!-- Fin del carusel -->


    <!-- Cómo Funciona -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">¿Cómo funciona?</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="text-center fs-5">
                        En RefuPet podrás encontrar refugios para mascotas ubicados en toda la república. 
                        Dentro de cada refugio podrás ver la amplia selección de mascotas disponibles para adoptar. 
                        ¡Será imposible no encontrar a un compañero que se adapte a ti!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mascotas Disponibles -->
    <!-- Mascotas Disponibles DINÁMICAS -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Estos amigos necesitan un hogar</h2>
        
        <div class="row g-4">
            <?php if (!empty($mascotas)): ?>
                <?php foreach ($mascotas as $mascota): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/<?php echo $mascota['foto'] ?? 'placeholder.jpg'; ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($mascota['nombre']); ?>" 
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($mascota['nombre']); ?></h5>
                            <p class="card-text flex-grow-1">
                                <?php 
                                $descripcion = $mascota['descripcion'] ?? 'Descripción no disponible';
                                if (strlen($descripcion) > 100) {
                                    echo substr(htmlspecialchars($descripcion), 0, 100) . '...';
                                } else {
                                    echo htmlspecialchars($descripcion);
                                }
                                ?>
                            </p>
                            <a href="Detalle_mascota.php?id=<?php echo $mascota['id_mascotas']; ?>&id_refugio=<?php echo $mascota['fk_refugio']; ?>" 
                            class="btn text-white mt-auto" 
                            style="background-color: #85B79D;">
                             Ver más información
                           </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No hay mascotas disponibles en este momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

    <!-- Refugios Disponibles -->
    <!-- Refugios Disponibles DINÁMICOS -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Explora los refugios disponibles</h2>
        
        <div class="row g-4">
            <?php if (!empty($refugios)): ?>
                <?php foreach ($refugios as $refugio): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <?php if(!empty($refugio['foto'])): ?>
                            <img src="img_refugio/<?php echo htmlspecialchars($refugio['foto']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($refugio['nombre']); ?>" 
                                 style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                                 style="height: 250px;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($refugio['nombre']); ?></h5>
                            <p class="card-text flex-grow-1">
                                <?php 
                                $descripcion = $refugio['descripcion'] ?? 'Descripción no disponible';
                                if (strlen($descripcion) > 120) {
                                    echo substr(htmlspecialchars($descripcion), 0, 120) . '...';
                                } else {
                                    echo htmlspecialchars($descripcion);
                                }
                                ?>
                            </p>
                            <a href="detalles_refugio.php?id=<?php echo $refugio['id_refugio']; ?>" 
                               class="btn text-white mt-auto" 
                               style="background-color: #FCCA46;">
                                Ver más información
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No hay refugios disponibles en este momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

    

</body>
</html>
<?php
    include('Pie_pagina.php');
?>