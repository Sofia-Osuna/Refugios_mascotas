<!-- Aquí el usuario podra ver todas sus respuestas de un formulario en especifico, en figma esta como "ver detalle de un respuesta"-->
<?php 
include("menu.php");
 ?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style>
		.form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background: ghostwhite;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        input, select, textarea {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            font-family: Arial, sans-serif;

        }

        textarea {
            min-height: 120px;
            resize: none;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .cancel-btn {
            background-color: #FF802E;
            color: #333;
            padding: 12px ;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;


        }

        .cancel-btn:hover {
            background-color: #d4c4b4;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
	</style>
</head>
<body>
	<br>
<h1>Detalles de respuesta del usuario</h1>
<br>

<div class="form-container">
        <div class="form-grid">
            <div class="form-group">
                <br>
                <label for="refugio">Refugio</label>
                <input type="text" id="refugio" name="refugio" placeholder="Nombre del refugio">
            </div>

            <div class="form-group">
                <br>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha">
            </div>

            <div class="form-group">
                <br>
                <label for="estatus">Estatus</label>
                <select id="estatus" name="estatus">
                    <option value="">Seleccionar</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>

            </div>

            <div class="form-group">
                <label for="mascotas">Mascotas</label>
                <input type="text" id="mascotas" name="mascotas" placeholder="Nombre de mascotas">
            </div>

            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora">
            </div>

            <div class="form-group full-width">
                <label for="respuestas">Respuestas</label>
                <textarea id="respuestas" name="respuestas" ></textarea>
            </div>
        </div>
        
        
    </div>
    <div class="button-container">
            <button class="cancel-btn">Cancelar solicitud</button>
        </div>
</body>
</html>
<?php 
include("Pie_pagina.php");
 ?>



