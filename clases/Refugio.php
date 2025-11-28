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
        // public function getConexion() {
        //     return $this->conexion;
        // }   

        function guardar($nombre,  $descripcion, $colonia, $nombre_calle,  $numero_exterior, $numero_interior, $telefono, $correo,$foto,$id_usuario){
            $consulta = "INSERT INTO direccion (id_direccion, nombre_calle, numero_exterior, numero_interior, fk_colonia) VALUES (null, '{$nombre_calle}', '{$numero_exterior}', '{$numero_interior}', '{$colonia}' );";
            $respuesta = $this -> conexion -> query($consulta);
            $id = mysqli_insert_id($this->conexion);

            $consulta = "INSERT INTO refugio (id_refugio, nombre, descripcion, foto, estatus) VALUES (null, '{$nombre}', '{$descripcion}', '{$foto}', 1);";
            $respuesta = $this -> conexion -> query($consulta);
            $id2 = mysqli_insert_id($this->conexion);

            $consulta = "INSERT INTO correo_refugio (id_correo_refugio, correo, fk_refugio, estatus) VALUES (null, '{$correo}', '{$id2}', 1);";
            $respuesta = $this -> conexion -> query($consulta);

            $consulta = "INSERT INTO telefono_refugio (id_telefono_refugio, telefono, fk_refugio, estatus) VALUES (null, '{$telefono}', '{$id2}', 1);";
            $respuesta = $this -> conexion -> query($consulta);

            $consulta = "INSERT INTO refugio_direcciones (id_refugio_direcciones, fk_refugio, fk_direccion, estatus) VALUES (null, '{$id2}','{$id}', 1);";
            $respuesta = $this -> conexion -> query($consulta);

            $consulta = "INSERT INTO usuario_refugio (id_usuario_refugio, fk_usuario, fk_refugio, estatus) VALUES (null, '{$id_usuario}', '{$id2}', 1);";
            $respuesta = $this->conexion->query($consulta);
            return $respuesta;
        }

        // esto es para poder tener los refugios y mostrarlos en la tabla si te lo juro
       function mostrar(){
    $consulta = "SELECT r.id_refugio, r.nombre, r.descripcion, r.estatus, r.foto, c.nombre as colonia, m.nombre as municipio, e.nombre as estado
    FROM refugio r INNER JOIN refugio_direcciones rd ON r.id_refugio = rd.fk_refugio 
    INNER JOIN direccion d ON rd.fk_direccion=d.id_direccion 
    INNER JOIN colonia c ON d.fk_colonia=c.id_colonia 
    INNER JOIN  municipio m ON c.fk_municipio=m.id_municipio
    INNER JOIN estado e ON m.fk_estado=e.id_estado WHERE r.estatus = 1
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
    if (!$id_refugio) {
        return null;
    }
    
    $consulta = "SELECT 
        r.*, d.*, t.telefono, cr.correo, 
        c.nombre as localidad, c.codigo_postal, c.tipo, c.id_colonia, c.fk_municipio,
        m.nombre as municipio, m.id_municipio, m.fk_estado,
        e.nombre as estado, e.id_estado
        FROM refugio r 
        INNER JOIN telefono_refugio t ON t.fk_refugio = r.id_refugio
        INNER JOIN correo_refugio cr ON cr.fk_refugio = r.id_refugio
        INNER JOIN refugio_direcciones rd ON r.id_refugio = rd.fk_refugio
        INNER JOIN direccion d ON rd.fk_direccion = d.id_direccion 
        INNER JOIN colonia c ON d.fk_colonia = c.id_colonia
        INNER JOIN municipio m ON c.fk_municipio = m.id_municipio
        INNER JOIN estado e ON m.fk_estado = e.id_estado 
        WHERE r.id_refugio = ?
        AND r.estatus = 1
        AND rd.estatus = 1
        LIMIT 1";
    
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("i", $id_refugio);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    return $resultado->fetch_assoc();
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
       function actualizar($id_refugio, $nombre, $descripcion, $colonia, $nombre_calle, $numero_exterior, $numero_interior, $telefono, $correo, $foto){
    
    // 1. Obtener el id_direccion del refugio
    $consulta = "SELECT fk_direccion FROM refugio_direcciones WHERE fk_refugio = $id_refugio";
    $resultado = $this->conexion->query($consulta);
    $row = $resultado->fetch_assoc();
    $id_direccion = $row['fk_direccion'];
    
    // 2. Actualizar dirección
    $consulta = "UPDATE direccion SET nombre_calle = '$nombre_calle', numero_exterior = '$numero_exterior', 
                 numero_interior = '$numero_interior', fk_colonia = '$colonia' WHERE id_direccion = $id_direccion";
    $this->conexion->query($consulta);
    
    // 3. Actualizar refugio
    if($foto != ''){
        $consulta = "UPDATE refugio SET nombre = '$nombre', descripcion = '$descripcion', foto = '$foto' 
                     WHERE id_refugio = $id_refugio";
    } else {
        $consulta = "UPDATE refugio SET nombre = '$nombre', descripcion = '$descripcion' 
                     WHERE id_refugio = $id_refugio";
    }
    $this->conexion->query($consulta);
    
    // 4. Actualizar correo
    $consulta = "UPDATE correo_refugio SET correo = '$correo' WHERE fk_refugio = $id_refugio";
    $this->conexion->query($consulta);
    
    // 5. Actualizar teléfono
    $consulta = "UPDATE telefono_refugio SET telefono = '$telefono' WHERE fk_refugio = $id_refugio";
    $this->conexion->query($consulta);
    
    return true;
}
 //KKAAKKAKAKKA de aqui saco todos los datos del formulario 
    function verificar($id_refugio){
        $consulta = "SELECT * FROM formulario_refugio WHERE fk_refugio = $id_refugio AND estatus = 1";
        $respuesta = $this -> conexion -> query($consulta);
        return $respuesta;
    }
    
  function mostrarPorUsuario($id_usuario){
    $consulta = "SELECT r.*, e.nombre as estado, m.nombre as municipio
                 FROM refugio r
                 INNER JOIN usuario_refugio ur ON r.id_refugio = ur.fk_refugio
                 INNER JOIN refugio_direcciones rd ON r.id_refugio = rd.fk_refugio
                 INNER JOIN direccion d ON rd.fk_direccion = d.id_direccion
                 INNER JOIN colonia c ON d.fk_colonia = c.id_colonia
                 INNER JOIN municipio m ON c.fk_municipio = m.id_municipio
                 INNER JOIN estado e ON m.fk_estado = e.id_estado
                 WHERE ur.fk_usuario = $id_usuario
                 AND r.estatus = 1
                 AND ur.estatus = 1
                 ORDER BY r.nombre";
    
    $respuesta = $this->conexion->query($consulta);
    
    $refugios = [];
    while($row = $respuesta->fetch_assoc()){
        $refugios[] = $row;
    }
    return $refugios;
}
public function esDelUsuario($id_refugio, $id_usuario){
    // DEBUG: Mostrar los parámetros que llegan
    error_log("DEBUG esDelUsuario: id_refugio=$id_refugio, id_usuario=$id_usuario");
    
    // SI EL ID_REFUGIO ES NULL, DEVOLVER FALSE DIRECTAMENTE
    if($id_refugio === NULL || empty($id_refugio)) {
        error_log("DEBUG esDelUsuario: id_refugio es NULL o vacío");
        return false;
    }
    
    // CORREGIR: Usar prepared statements para evitar SQL injection
    $consulta = "SELECT * FROM usuario_refugio 
                 WHERE fk_refugio = ? 
                 AND fk_usuario = ? 
                 AND estatus = 1";
    
    $stmt = $this->conexion->prepare($consulta);
    $stmt->bind_param("ii", $id_refugio, $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    $es_dueño = $resultado->num_rows > 0;
    error_log("DEBUG esDelUsuario: resultado = " . ($es_dueño ? 'TRUE' : 'FALSE'));
    
    return $es_dueño;
}
function obtenerFotoActual($id_refugio) {
    $consulta = "SELECT foto FROM refugio WHERE id_refugio = $id_refugio";
    $resultado = $this->conexion->query($consulta);
    if($resultado && $row = $resultado->fetch_assoc()) {
        return $row['foto'];
    }
    return "sin_foto.jpg"; // Valor por defecto si no encuentra
}
}
?>