<?php
    include('menu.php');
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

  
<?php
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


?>

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
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Estos amigos necesitan un hogar</h2>
            
            <div class="row g-4">
                <!-- Card Mascota 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/placeholder.jpg" class="card-img-top" alt="Mascota" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Nombre</h5>
                            <p class="card-text flex-grow-1">Descripción de la mascota...</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #85B79D;">Ver más información</a>
                        </div>
                    </div>
                </div>

                <!-- Card Mascota 2 - Max -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/max.jpg" class="card-img-top" alt="Max" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Max</h5>
                            <p class="card-text flex-grow-1">Perrito recién rescatado, 4-5 meses de edad, bastante juguetón y amigable</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #85B79D;">Ver más información</a>
                        </div>
                    </div>
                </div>

                <!-- Card Mascota 3 - Güera -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/guera.jpg" class="card-img-top" alt="Güera" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Güera</h5>
                            <p class="card-text flex-grow-1">Perrita de 1-2 años de edad, bastante inteligente, amigable, sabe dar la pata y aprende trucos con facilidad</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #85B79D;">Ver más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Refugios Disponibles -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Explora los refugios disponibles</h2>
            
            <div class="row g-4">
                <!-- Card Refugio 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/refugio-placeholder.jpg" class="card-img-top" alt="Refugio" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Nombre del Refugio</h5>
                            <p class="card-text flex-grow-1">Descripción del refugio...</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #FCCA46;">Ver más información</a>
                        </div>
                    </div>
                </div>

                <!-- Card Refugio 2 - La Lomita -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/lomita.jpg" class="card-img-top" alt="Refugio la lomita" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Refugio La Lomita</h5>
                            <p class="card-text flex-grow-1">Ubicado en el corazón de la ciudad, dedicado al rescate y cuidado de mascotas abandonadas.</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #FCCA46;">Ver más información</a>
                        </div>
                    </div>
                </div>

                <!-- Card Refugio 3 - Girasol -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card">
                        <img src="Imagenes_animales/girasol.jpg" class="card-img-top" alt="Refugio girasol" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">Refugio Girasol</h5>
                            <p class="card-text flex-grow-1">Espacio amplio y seguro para nuestros amigos peludos, con atención veterinaria profesional.</p>
                            <a href="#" class="btn text-white mt-auto" style="background-color: #FCCA46;">Ver más información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

</body>
</html>
<?php
    include('Pie_pagina.php');
?>