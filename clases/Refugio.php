<?php
    error_reporting(E_ALL); //esto es para que me muestre los errores
    ini_set('display_errors', 1);

    class Refugio{
        public $conexion; 
        //método constructor
        function __construct(){
            //hola, serequiere una vez el archivo de conexion
            require_once('conexion.php');
            $this -> conexion = new Conexion();

        }
        public function getConexion() {
    return $this->conexion;
}

        function guardar($nombre,  $descripcion, $colonia, $nombre_calle,  $numero_exterior, $numero_interior, $telefono, $correo){
            $consulta = "INSERT INTO direccion (id_direccion, nombre_calle, numero_exterior, numero_interior, fk_colonia) VALUES (null, '{$nombre_calle}', '{$numero_exterior}', '{$numero_interior}', '{$colonia}' );";
            $respuesta = $this -> conexion -> query($consulta);
            $id = mysqli_insert_id($this->conexion);

            $consulta = "INSERT INTO refugio (id_refugio, nombre, descripcion, foto, estatus) VALUES (null, '{$nombre}', '{$descripcion}', 'pendiente', 1);";
            $respuesta = $this -> conexion -> query($consulta);
            $id2 = mysqli_insert_id($this->conexion);

            $consulta = "INSERT INTO correo_refugio (id_correo_refugio, correo, fk_refugio, estatus) VALUES (null, '{$correo}', '{$id2}', 1);";
            $respuesta = $this -> conexion -> query($consulta);

            $consulta = "INSERT INTO telefono_refugio (id_telefono_refugio, telefono, fk_refugio, estatus) VALUES (null, '{$telefono}', '{$id2}', 1);";
            $respuesta = $this -> conexion -> query($consulta);

            $consulta = "INSERT INTO refugio_direcciones (id_refugio_direcciones, fk_refugio, fk_direccion, estatus) VALUES (null, '{$id2}','{$id}', 1);";
            $respuesta = $this -> conexion -> query($consulta);
            return $respuesta;
        }

        // esto es para poder tener los refugios y mostrarlos en la tabla si te lo juro
  function mostrar(){

        $consulta = "SELECT r.id_refugio, r.nombre, r.descripcion, r.estatus, c.nombre as colonia, m.nombre as municipio, e.nombre as estado
        FROM refugio r INNER JOIN refugio_direcciones rd ON r.id_refugio = rd.fk_refugio 
        INNER JOIN direccion d ON rd.fk_direccion=d.id_direccion 
        INNER JOIN colonia c ON d.fk_colonia=c.id_colonia 
        INNER JOIN  municipio m ON c.fk_municipio=m.id_municipio
        INNER JOIN estado e ON m.fk_estado=e.id_estado
        ORDER BY r.nombre ASC";
        $respuesta = $this->conexion->query($consulta);
    
        $refugios = [];
        while($row = $respuesta->fetch_assoc()){
            $refugios[] = $row;
        }
        return $refugios;
}

//esto es pa obtener el id del refugio xd
function Id($id_refugio){
    //EDITAR ESTO actualizar al estandar de insertar -sofía
    /*
     $consulta = "SELECT r.*, rd.id_refugio_direcciones, rd.fk_direccion,
                 d.nombre_calle, d.numero_exterior, d.numero_interior, d.cp, d.fk_municipio,
                 m.nombre as municipio, m.fk_estado,
                 e.nombre as estado
                 FROM refugio r, refugio_direcciones rd, direccion d, municipio m, estado e
                 WHERE r.id_refugio = rd.fk_refugio
                 AND rd.fk_direccion = d.id_direccion
                 AND d.fk_municipio = m.id_municipio
                 AND m.fk_estado = e.id_estado
                 AND r.id_refugio = $id_refugio
                 AND rd.estatus = 1";
    */
    $consulta = "SELECT 
    r.*, d.*, t.telefono, cr.correo, c.nombre as localidad, c.codigo_postal, c.tipo, m.nombre as municipio, e.nombre as estado FROM refugio r 
    INNER JOIN telefono_refugio t ON t.fk_refugio=r.id_refugio
    INNER JOIN correo_refugio cr ON cr.fk_refugio=r.id_refugio
    INNER JOIN refugio_direcciones rd ON r.id_refugio = rd.fk_refugio
    INNER JOIN direccion d ON rd.fk_direccion = d.id_direccion 
    INNER JOIN colonia c ON d.fk_colonia = c.id_colonia
    INNER JOIN municipio m ON c.fk_municipio = m.id_municipio
    INNER JOIN estado e ON m.fk_estado = e.id_estado ";
    $respuesta = $this->conexion->query($consulta);
    return $respuesta->fetch_assoc();
    }
    function eliminar($id_refugio){
    // esto pa dar de baja la direcion refugi pa 
    $consulta = "UPDATE refugio_direcciones SET estatus = 0 WHERE fk_refugio = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $id_refugio);
    $stmt->execute();
    
    // y esto da de baja el refugio kakakakaakaka
    $consulta = "UPDATE refugio SET estatus = 0 WHERE id_refugio = ?";
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $id_refugio);
    return $stmt->execute();
}
function actualizar($id_refugio, $nombre, $descripcion, $estado_nombre, $municipio_nombre, 
                   $nombre_calle, $numero_exterior, $numero_interior, $cp){
    
    $refugio = $this->Id($id_refugio);
    $id_direccion = $refugio['fk_direccion'];
    
    // 1. Buscar el ID del estado por nombre
    $consulta = "SELECT id_estado FROM estado WHERE nombre = '$estado_nombre'";
    $resultado = $this->conexion->query($consulta);
    
    if($resultado->num_rows > 0){
        $estado = $resultado->fetch_assoc();
        $id_estado = $estado['id_estado'];
    } else {
        // Si no existe, crearlo
        $consulta = "INSERT INTO estado (nombre, fk_pais, estatus) VALUES ('$estado_nombre', 1, 1)";
        $this->conexion->query($consulta);
        $id_estado = mysqli_insert_id($this->conexion);
    }
    
    //
    $consulta = "SELECT id_municipio FROM municipio WHERE nombre = '$municipio_nombre' AND fk_estado = $id_estado";
    $resultado = $this->conexion->query($consulta);
    
    if($resultado->num_rows > 0){
        $municipio = $resultado->fetch_assoc();
        $id_municipio = $municipio['id_municipio'];
    } else {
        // esto es para que se cree el municipio por si no existe creo...
        $consulta = "INSERT INTO municipio (nombre, fk_estado, estatus) VALUES ('$municipio_nombre', $id_estado, 1)";
        $this->conexion->query($consulta);
        $id_municipio = mysqli_insert_id($this->conexion);
    }
    
    // para actualizar los datos del refugio
    $consulta = "UPDATE refugio SET nombre = '$nombre', descripcion = '$descripcion' 
                 WHERE id_refugio = $id_refugio";
    $this->conexion->query($consulta);
    
    //pa actualizar la direcion
    $consulta = "UPDATE direccion SET nombre_calle = '$nombre_calle', 
                 numero_exterior = '$numero_exterior', numero_interior = '$numero_interior', 
                 cp = '$cp', fk_municipio = $id_municipio 
                 WHERE id_direccion = $id_direccion";
    $this->conexion->query($consulta);
    
     return true;
    }
}
?>