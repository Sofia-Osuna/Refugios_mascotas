<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('menu.php');
include('menu_refugio.php');

// Verificar que esté logueado
if(!isset($_SESSION['idusuario'])) {
    header('location: login.php');
    exit;
}

$id_usuario = $_SESSION['idusuario'];

// Verificar datos personales
include('clases/Datos_personales.php');
$clase_datos = new Datos();
$datos_personales = $clase_datos->obtener($_SESSION['idusuario']);

// Obtener parámetros
include('clases/Preguntas_form.php');
$id_refugio = $_GET['id_refugio'];
$id_mascota = $_GET['id_mascota'];
$id_usuario = $_GET['id_usuario'];
$id_adopcion = $_GET['id_adopcion'];

if(!$id_refugio && !$id_mascota && !$id_usuario){
    echo"Error al pasar los datos";
}

$clase = new Refugio();
$refugio = $clase->Id($id_refugio);

// Verificar que el refugio tiene un formulario registrado
$respuesta = $clase->verificar($id_refugio);
$datos = $respuesta->fetch_assoc();

if($datos && isset($datos['id_formulario_refugio']) && !empty($datos['id_formulario_refugio'])){
    $tiene_formulario = true;
    $id_formulario = $datos['id_formulario_refugio'];
    
    // Esto hace que se muestren las preguntas
    $clase2 = new Preguntas();
    $resultado_preguntas = $clase2->mostrar($id_formulario);
    
    // Extraer las preguntas
    $preguntas = [];
    if ($resultado_preguntas) {
        while ($fila = $resultado_preguntas->fetch_assoc()) {
            $preguntas[] = $fila;
        }
    }
}else{
    $tiene_formulario = false;
    $id_formulario = null;
    $preguntas = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Adopción</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container my-5">
    
    <!-- Header -->
    <div class="card mb-4 border-0 shadow-sm header-formulario">
        <div class="card-body text-white p-4">
            <h2 class="mb-2">Formulario de Adopción</h2>
            <p class="mb-0">Refugio: <strong><?= htmlspecialchars($refugio['nombre_refugio'] ?? '') ?></strong></p>
        </div>
    </div>

    <?php if(empty($datos_personales)): ?>
        <!-- Alerta si no tiene datos personales -->
        <div class="alert border-0 shadow-sm mb-4" style="background-color: #FFF3CD; border-left: 4px solid #FE7F2D !important;">
            <div class="d-flex align-items-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FE7F2D" class="me-3 flex-shrink-0" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div class="flex-grow-1">
                    <h5 class="mb-2" style="color: #2c3e50;">Completa tu información personal</h5>
                    <p class="mb-2">Para facilitar el proceso de adopción, ¡te recomendamos proporcionar tus datos personales! estos los puedes llenar a travez de tu perfil, ¡o en este boton! Luego puedes volver al formulario</p>
                    <a href="Formulario_datos_personales.php?id=<?=$id_usuario?>" class="btn btn-naranja btn-sm mt-2">
                        Completar mis datos
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Información Personal del Usuario -->
        <div class="card border-0 mb-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="mb-3" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                     Tu Información Personal
                </h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">Nombre completo</small>
                            <strong style="color: #2c3e50;">
                                <?= htmlspecialchars(($datos_personales['Nombre'] ?? '') . ' ' . 
                                   ($datos_personales['apellido_p'] ?? '') . ' ' . 
                                   ($datos_personales['apellido_m'] ?? '')) ?>
                            </strong>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">Fecha de nacimiento</small>
                            <strong style="color: #2c3e50;">
                                <?= !empty($datos_personales['fecha_nacimiento']) ? date('d/m/Y', strtotime($datos_personales['fecha_nacimiento'])) : 'No especificada' ?>
                            </strong>
                        </div>
                    </div>

                    <?php if(!empty($datos_personales['edad'])): ?>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">Edad</small>
                            <strong style="color: #2c3e50;">
                                <?= htmlspecialchars($datos_personales['edad']) ?> años
                            </strong>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">Teléfono</small>
                            <strong style="color: #2c3e50;">
                                <?= htmlspecialchars($datos_personales['telefono']) ?>
                            </strong>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-3 bg-light rounded">
                            <small class="text-muted d-block mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                                Dirección
                            </small>
                            <strong style="color: #2c3e50;">
                                <?= htmlspecialchars($datos_personales['nombre_calle'] ?? '') ?> 
                                <?= !empty($datos_personales['numero_exterior']) ? htmlspecialchars($datos_personales['numero_exterior']) : 's/n' ?>,
                                <?= htmlspecialchars($datos_personales['colonia'] ?? '') ?>,
                                <?= htmlspecialchars($datos_personales['municipio'] ?? '') ?>,
                                <?= htmlspecialchars($datos_personales['estado'] ?? '') ?>
                                (CP: <?= htmlspecialchars($datos_personales['codigo_postal'] ?? '') ?>)
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Formulario de Preguntas (siempre se muestra) -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="mb-4" style="color: #419D78; border-bottom: 2px solid #FCCA46; padding-bottom: 10px;">
                Cuestionario de Adopción
            </h5>

            <?php if($tiene_formulario && !empty($preguntas)): ?>
                <form action="controladores/Insertar_respuestas.php" method="POST">
                    <input type="hidden" name="id_formulario" value="<?= $id_formulario?>">
                    <input type="hidden" name="id_mascota" value="<?= $id_mascota ?>">
                    <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
                    <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">
                    <input type="hidden" name="id_adopcion" value="<?= $id_adopcion ?>">
                    
                    <?php foreach($preguntas as $index => $pregunta): ?>
                        <div class="pregunta-card mb-3 p-3 rounded" style="background-color: #f8f9fa; border-left: 4px solid #85B79D;">
                            <div class="d-flex align-items-start mb-3">
                                <div class="numero-pregunta me-3 flex-shrink-0">
                                    <?= $index + 1 ?>
                                </div>
                                <div class="flex-grow-1">
                                    <label class="mb-2 fw-semibold" style="color: #2c3e50; font-size: 1.05rem;">
                                        <?= htmlspecialchars($pregunta['pregunta']) ?>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="ms-5">
                                <input type="hidden" name="preguntas[<?= $index ?>][id_pregunta]" 
                                       value="<?= $pregunta['id_pregunta'] ?>">
                                <textarea name="preguntas[<?= $index ?>][respuesta]"  
                                          id="preguntas_<?= $index ?>_respuesta"
                                          class="form-control" 
                                          rows="3"
                                          placeholder="Escribe tu respuesta aquí..." 
                                          required></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-naranja btn-lg px-5">
                            Enviar Solicitud de Adopción
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-warning border-0">
                    <p class="mb-0">Este refugio aún no tiene un formulario de adopción configurado.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>