<?php 
    require_once '../../../includes/conexion.php';

    if(!empty($_POST)) {
        if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['password'])) {
            $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
        } else {
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $rol = $_POST['listRol'];
            $estado = $_POST['listEstado'];

            // Cifrar la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Corregir el error tipográfico en la consulta SQL
            $sql = 'SELECT * FROM usuarios WHERE usuario = ?';
            $query = $pdo->prepare($sql);
            $query->execute(array($usuario));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if(count($result) > 0) {
                $respuesta = array('status' => false, 'msg' => 'El usuario ya existe');

            } else {
                $sqlInsert = 'INSERT INTO usuarios (nombre, usuario, clave, rol, estado) VALUES (?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $resultInsert = $queryInsert->execute(array($nombre, $usuario, $password, $rol, $estado));
                
                if($resultInsert) {
                    $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
                } else {
                    $respuesta = array('status' => false, 'msg' => 'Error al crear el usuario');
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
?>
