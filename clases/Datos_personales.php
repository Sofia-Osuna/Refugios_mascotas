<!-- esto es para que el usuario llene sus datos personales dentro de la pagina del refugio -->
<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Datos{
        private $conexion;
    
        function __construct(){
            require_once('Conexion.php');
            $this->conexion = new Conexion();
        }

        function guardar($nombre, $ap, $am, $edad, $fnac, $colonia, $nombre_calle, $n_exterior, $n_interior, $id_usuario, $telefono){
            //Insertar primero los datos personales
            $consulta1 = "INSERT INTO datos_personales (id_datos_personales, nombre, apellido_p, apellido_m, edad, fecha_nacimiento, fk_usuario) VALUES (null, '{$nombre}', '{$ap}', '{$am}', '{$edad}', '{$fnac}', '{$id_usuario}');";
            $respuesta1 = $this -> conexion -> query($consulta1);
            //Insertar la direccion nueva
            $consulta2 = "INSERT INTO direccion (id_direccion, nombre_calle, numero_exterior, numero_interior, fk_colonia) VALUES (null, '{$nombre_calle}', '{$n_exterior}', '{$n_interior}', '{$colonia}');";
            $respuesta2 = $this -> conexion -> query($consulta2);
            $id = mysqli_insert_id($this->conexion);
            //Insertar la fk_usuario y fk_direccion a la tabla de usuario_direcciones
            $consulta3 = "INSERT INTO usuarios_direcciones (id_usuarios_direcciones, fk_usuario, fk_direccion, estatus) VALUES (null, '{$id_usuario}', '{$id}', 1);";
            $respuesta3 = $this -> conexion -> query($consulta3);

            $consulta4 = "INSERT INTO telefono_usuario (id_telefono_usuario, telefono, fk_usuario, estatus) VALUES (null, '{$telefono}', '{$id_usuario}', 1);";
            $respuesta3 = $this -> conexion -> query($consulta4);

            return $respuesta1;
        }

        function obtener($id_usuario){
            //estado->municipio->colonia->direccion->usuarios_direcciones->usuario->datos_personales->telefono_usuario
            //tuve que usar left joins pq..... 
            // LEFT JOIN en lugar de INNER JOIN: Así devuelve el usuario aunque falten datos en tablas relacionadas -Deepseek xdxd
            $consulta ="SELECT 
            e.nombre as estado,
            e.id_estado,
            m.nombre as municipio,
            m.id_municipio,
            c.nombre as colonia,
            c.id_colonia,
            c.codigo_postal,
            d.nombre_calle, 
            d.numero_exterior,
            d.numero_interior,
            u.nombre as username,
            u.password,
            u.foto,
            u.fk_rol,
            dp.nombre as Nombre,
            dp.apellido_p,
            dp.apellido_m,
            dp.edad,
            dp.fecha_nacimiento,
            t.telefono FROM estado e 
            LEFT JOIN municipio m ON e.id_estado=m.fk_estado
            LEFT JOIN colonia c ON m.id_municipio = c.fk_municipio
            LEFT JOIN direccion d ON c.id_colonia = d.fk_colonia
            LEFT JOIN usuarios_direcciones du ON d.id_direccion = du.fk_direccion
            LEFT JOIN usuario u ON du.fk_usuario=u.id_usuario
            LEFT JOIN datos_personales dp ON u.id_usuario = dp.fk_usuario
            LEFT JOIN telefono_usuario t ON u.id_usuario = t.fk_usuario AND t.estatus = 1 
            WHERE u.id_usuario = ? ";

            $stmt = $this->conexion->prepare($consulta);
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            $datos = $resultado->fetch_assoc();
    
            // SI ES NULL, DEVOLVER ARRAY VACÍO
            return $datos ?? [];
        }
        
        function editar($nombre, $ap, $am, $edad, $fnac, $colonia, $nombre_calle, $n_exterior, $n_interior, $id_usuario, $telefono){
            //primerooo sacar el id_usuarios_direcciones xdxd con el id_usuario xd
            $consulta0 = "SELECT fk_direccion FROM usuarios_direcciones WHERE fk_usuario = $id_usuario";
            $resultado0 = $this->conexion->query($consulta0);
    
            // Extraer el valor del resultado
            $fila = $resultado0->fetch_assoc();
            $fk_direccion = $fila['fk_direccion'];

            //editar primero los datos personales
            $consulta1 = "UPDATE datos_personales SET  nombre= '$nombre', apellido_p='$ap', apellido_m='$am', edad='$edad', fecha_nacimiento='$fnac' WHERE fk_usuario='$id_usuario'";
            $respuesta1 = $this -> conexion -> query($consulta1);
            //editar la direccion nueva
            $consulta2 = "UPDATE direccion SET nombre_calle='$nombre_calle', numero_exterior='$n_exterior', numero_interior='$n_interior', fk_colonia='$colonia' WHERE id_direccion= '$fk_direccion'";
            $respuesta2 = $this -> conexion -> query($consulta2);
            $id = mysqli_insert_id($this->conexion);

            $consulta4 = "UPDATE telefono_usuario SET estatus=0 WHERE  fk_usuario='$id_usuario'";
            $respuesta3 = $this -> conexion -> query($consulta4);
            
            $consulta5 = "INSERT INTO telefono_usuario (id_telefono_usuario, telefono, fk_usuario, estatus) VALUES (null, '{$telefono}', '{$id_usuario}', 1);";
            $respuesta5 = $this -> conexion -> query($consulta5);


            return $respuesta1;
        }

        }

    
    
?>