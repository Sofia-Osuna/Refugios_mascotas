<?php
include('menu.php');
include('clases/Refugio.php');
include('menu_refugio.php');


$clase = new Refugio();
$id = $_GET['id'];
$refugio = $clase->Id($id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


</body>
</html>
<?php 
include('Pie_pagina.php');
 ?>

 