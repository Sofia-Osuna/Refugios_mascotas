<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('clases/Refugio.php');

$clase = new Refugio();

// Intentar obtener el ID del refugio de varias fuentes
$id = $_GET['id_refugio'] ?? $_GET['id'] ?? null;

$refugio = $clase->id($id);

// Verificar si el refugio es del usuario
$es_suyo = false;
if(isset($_SESSION['idusuario'])){
    $es_suyo = $clase->esDelUsuario($id, $_SESSION['idusuario']) || $_SESSION['fk_rol'] == 1;
}

// Si viene id_formulario, buscar el refugio
if (!$id && isset($_GET['id_formulario'])) {
    $conexion = new Conexion(); // O como tengas tu conexión
    $sql = "SELECT fk_refugio FROM formulario_refugio WHERE id_formulario_refugio = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $_GET['id_formulario']);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    $id = $resultado['fk_refugio'] ?? null;
}

// Verificar que tengamos un ID válido
if (!$id) {
    die("Error: No se pudo identificar el refugio. Por favor, regresa a la lista de refugios.");
}

$refugio = $clase->Id($id);

// Verificar que el refugio existe
if (!$refugio) {
    die("Error: Refugio no encontrado.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Refugio</title>
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
                <!-- Botón home -->
                <li class="nav-item">
                    <a href="detalles_refugio.php?id_refugio=<?= $refugio['id_refugio'] ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                        </svg> 
                    </a>
                </li>

<?php if($es_suyo){ ?>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="editar_refugio.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Editar Refugio
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="controladores/eliminar_refugio.php?id_refugio=<?= $refugio['id_refugio'] ?>" onclick="return confirm('¿Estás seguro de eliminar este refugio?')">
                        Eliminar Refugio
                    </a>
                </li>
<?php } ?>
        
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="Lista_mascota.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Lista de Mascotas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="Lista_historia_feliz.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Historias Felices
                    </a>
                </li>
                   <?php if($es_suyo){ ?>

                <?php if(isset($_SESSION['fk_rol']) && ($_SESSION['fk_rol'] == 1 || $_SESSION['fk_rol'] == 3)): ?>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="Detalle_formulario.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Cuestionario de adopción
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark px-3" href="Lista_respuesta_refugio.php?id_refugio=<?= $refugio['id_refugio'] ?>">
                        Lista de respuestas
                    </a>
                </li>
                <?php endif; ?>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>

</body>
</html>