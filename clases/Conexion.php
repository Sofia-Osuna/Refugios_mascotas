<?php
    class Conexion extends mysqli {
        function __construct(){
            parent :: __construct('localhost', 'proye477_brayanlopez', 'proye477_brayanlopez', 'proye477_brayanlopez');
        }
    }
?>