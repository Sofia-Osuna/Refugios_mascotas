<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    require('clases/Conexion.php');
    $mysqli = new Conexion();
    //en esta consulta se pide solo el id y el nombre del estado, el order by es para que aparezcan en orden alfabetico
    $consulta = "SELECT nombre, id_estado FROM estado ORDER BY nombre ASC";
    $resultado = $mysqli->query($consulta);

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Refugio</title>
    <!-- este es el jQuery -->
    <script languaje="javascript" src="js/jquery-3.7.1.js" ></script>
    <!-- aqui inicia el script para los selects dinamicos, o anidados, no le muevan por favor -sofía -->
    <script language = "javascript" >
        $(document).ready(function(){
            
           

            $("#cbx_estado").change(function (){
                //esto de aqui es para que, si el usuario selecciona otro estado, ya habiendo seleccionado las 3 opciones, entoncese va borrar la opcion de
                //colonia, a su valor inicial xd
                $("#cbx_municipio").html('<option value="0">Cargando...</option>');
                $("#cbx_colonia").html('<option value="0">Selecciona primero un municipio</option>');
            
                $("#cbx_estado option:selected").each(function () {
                    id_estado = $(this).val();
                    $.post("includes/getMunicipio.php", {id_estado: id_estado
                    },function(data){
                        $("#cbx_municipio").html(data);
                    });
                });
            });
        });

        $(document).ready(function(){
            
            $("#cbx_municipio").change(function (){
                $("#cbx_municipio option:selected").each(function () {
                    id_municipio = $(this).val();
                    $.post("includes/getColonia.php", {id_municipio: id_municipio
                    },function(data){
                        $("#cbx_colonia").html(data);
                    });
                });
            });
        });
    </script>
    <!-- fin del script para los selects anidados -->
</head>
<body>
    <form action="controladores/Insertar_refugio.php" method="POST" enctype="multipart/form-data">
        <label for="">Nombre del refugio: </label>
        <input class="inp" type="text" name="nombre" id=""><br><br>

        <label for="">descripción del refugio: </label>
        <textarea name="descripcion" id=""></textarea>

        <label for="">Foto: </label>
        <input type="file" name="foto"><br><br>


        <h3>Dirección</h3>
        <!--  inicio de selects para estado, municipio y colonia -->
        <!-- select de estado -->
        <div>
            <label for="">Selecciona tu estado</label>
            <select name="cbx_estado" id="cbx_estado">
                <option value="0">Seleccionar estado: </option>
                <?php
                    while($fila = $resultado -> fetch_assoc()){
                        ?>  
                        <option value="<?php echo $fila['id_estado']?>"><?php echo $fila['nombre']?></option>
                        <?php
                    }
                    ?>
            </select>
        </div>
        <!-- select para municipio -->
        <div>
            <label for="">Selecciona tu municipio: </label>
            <select name="cbx_municipio" id="cbx_municipio"></select>
        </div>

        <!-- select para colonia -->
        <div>
            <label for="">Selecciona tu localidad o colonia: </label>
            <select name="cbx_colonia" id="cbx_colonia"></select>
        </div>
        <!-- Ttermina los select para estado, municipio, colonia -->

        <label for="">Nombre de la calle: </label>
        <input class="inp" type="text" name="nombre_calle" id=""><br><br>

        <label for="">Número Interior: </label>
        <input class="inp" type="text" name="numero_interior" id=""><br><br>

        <label for="">Número Exterior: </label>
        <input class="inp" type="text" name="numero_exterior" id=""><br><br>

        <input  class="boton" type="submit" name="guardar" id="">
    </form>

