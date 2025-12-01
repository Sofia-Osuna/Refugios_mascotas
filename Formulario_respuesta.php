<?php
error_reporting(E_ALL); //esto es para que me muestre los errores
ini_set('display_errors', 1);
include('menu.php');
include('menu_refugio.php');
$id_usuario = $_SESSION['idusuario']; // O como lo tengas guardado

// Verificar que esté logueado
if(!isset($_SESSION['idusuario'])) {
    header('location: login.php');
    exit;
}
// copie y pegue lo que habia ennnnnnn detalle refugio
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

//verificar que el refugio tiene un formulario registrado
$respuesta = $clase->verificar($id_refugio);
$datos = $respuesta->fetch_assoc();

if($datos && isset($datos['id_formulario_refugio']) && !empty($datos['id_formulario_refugio'])){
    $tiene_formulario = true;
    $id_formulario = $datos['id_formulario_refugio'];
    
    //esto hace que se muestren las preguntas
    $clase2 = new Preguntas();
    $resultado_preguntas = $clase2->mostrar($id_formulario);
    
    //extraer las preguntas
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    
    <form action="controladores/Insertar_respuestas.php" method="POST">
        <input type="hidden" name="id_formulario" value="<?= $id_formulario?>">
        <input type="hidden" name="id_mascota" value="<?= $id_mascota ?>">
        <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
        <input type="hidden" name="id_refugio" value="<?= $id_refugio ?>">
        <input type="hidden" name="id_adopcion" value="<?= $id_adopcion ?>">
        <?php foreach($preguntas as $index => $pregunta): ?>
            <div class="pregunta-card bg-light p-3 mb-3 rounded">
                <div class="d-flex align-items-start">
                    <div class="numero-pregunta text-white me-3 flex-shrink-0"><?= $index + 1 ?></div>
                    <div class="flex-grow-1">
                        <p class="mb-2 fw-semibold" style="color: #283D3B; font-size: 1.05rem;">
                            <?= htmlspecialchars($pregunta['pregunta']) ?>
                        </p>
                                    
                    </div>
                    <div>
                        <!-- inputs -->
                         <input type="hidden" name="preguntas[<?= $index ?>][id_pregunta]" 
                            value="<?= $pregunta['id_pregunta'] ?>">
                         <textarea name="preguntas[<?= $index ?>][respuesta]"  
                            id="preguntas[<?= $index ?>][respuesta]"
                            class="form-control" 
                            placeholder="Escribe tu respuesta..." 
                            required></textarea>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>       
        <button type="submit" class="btn btn-primary">Terminar</button>
    </form>


</body>
</html>