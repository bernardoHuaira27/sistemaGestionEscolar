<?php 

require_once '../../../includes/conexion.php';
if(!empty($_POST)) {
    if(empty($_POST['nombre']) || empty($_POST['usuario'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        $idusuario = isset($_POST['idusuario']) ? intval($_POST['idusuario']) : 0;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $rol = isset($_POST['listRol']) ? intval($_POST['listRol']) : 0;
        $estado = isset($_POST['listEstado']) ? intval($_POST['listEstado']) : 0;


        // Cifrar la contraseña solo si no está vacía
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Corregir el error tipográfico en la consulta SQL
        $sql = 'SELECT * FROM usuarios WHERE usuario = ? AND usuario_id != ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($usuario, $idusuario));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El usuario ya existe');
        } else {
            if($idusuario == 0){
                $sqlInsert = 'INSERT INTO usuarios (nombre, usuario, clave, rol, estado) VALUES (?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $usuario, $password, $rol, $estado));
                $accion = 1;
            }else{
                if(empty($password)){
                    $sqlUpdate = 'UPDATE usuarios  SET nombre = ?, usuario = ?, rol = ?, estado = ? WHERE usuario_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $usuario, $rol, $estado, $idusuario));
                    $accion = 2;
                }else {
                    $sqlUpdate = 'UPDATE usuarios  SET nombre = ?, usuario = ?, clave = ?, rol = ?, estado = ? WHERE usuario_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $usuario, $password, $rol, $estado, $idusuario));
                    $accion = 3;
                }
            }

            if($request > 0){
                if($accion == 1){
                    $respuesta = array('status' => true, 'msg' => 'Usuario Creado Correctamente');
                }else{
                    $respuesta = array('status' => true, 'msg' => 'Usuario Actualizado Correctamente');
                }
            }
            
        }
            
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>