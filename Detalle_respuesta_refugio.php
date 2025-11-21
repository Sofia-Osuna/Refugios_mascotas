<!-- Aqui es practicamente lo mismo que el detalle respuesta usuario, pero se accede a travez de la lista de respuestas de 
 de un refugio, el cual puede ser de muchos usuario, y se accede por medio del menu del refugio, -->

<?php 
include("menu.php");
?>  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles formulario</title>
    
</head>
<body>

<div class="py-3" style="background-color: #FCCA46;">
    <div class="container d-flex flex-wrap justify-content-start gap-4">
        <span class="fw-bold">Ver Mascotas</span>
        <span class="fw-bold">Historias Felices</span>
        <span class="fw-bold">Formulario de Adopción / Respuestas</span>
        <span class="fw-bold">Editar</span>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-body">

                 
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="refugio" class="form-label fw-bold">Refugio</label>
                                <input type="text" id="refugio" name="refugio" class="form-control" placeholder="Nombre del refugio">
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label for="fecha" class="form-label fw-bold">Fecha</label>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="estatus" class="form-label fw-bold">Estatus</label>
                                <select id="estatus" name="estatus" class="form-select">
                                    <option value="">Seleccionar</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="aprobado">Aprobado</option>
                                    <option value="rechazado">Rechazado</option>
                                </select>
                            </div>
                        </div>

                       
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="mascotas" class="form-label fw-bold">Mascotas</label>
                                <input type="text" id="mascotas" name="mascotas" class="form-control" placeholder="Nombre de mascotas">
                            </div>
                            <div class="col-md-6">
                                <label for="hora" class="form-label fw-bold">Hora</label>
                                <input type="time" id="hora" name="hora" class="form-control">
                            </div>
                        </div>

                      
                        <div class="mb-3">
                            <label for="respuestas" class="form-label fw-bold">Respuestas</label>
                            <textarea id="respuestas" name="respuestas" class="form-control" rows="5"></textarea>
                        </div>

                        <!-- Botones Rechazar y Aceptar -->
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button type="button" class="btn btn-danger fw-bold px-4">Rechazar</button>
                            <button type="button" class="btn" style="background-color: #FCCA46; color: #333; font-weight: bold; padding: 10px 20px;">Aceptar</button>
                        </div>
                    </form>

                   

                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include("Pie_pagina.php");
?>


</body>
</html>
