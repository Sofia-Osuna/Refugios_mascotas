<?php
   session_start();
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);


    session_destroy();
    header('location: ../index.php');

?>