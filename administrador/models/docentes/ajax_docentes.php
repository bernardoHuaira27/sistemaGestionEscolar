<?php

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    // Verificar que los campos requeridos no estén vacíos
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['nivel_est'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Recoger datos del formulario
        $iddocente = isset($_POST['iddocente']) && $_POST['iddocente'] !== '' ? intval($_POST['iddocente']) : 0; // Convertir a entero
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $cedula = $_POST['cedula'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $nivel_est = $_POST['nivel_est'];
        $estado = isset($_POST['listEstado']) && $_POST['listEstado'] !== '' ? $_POST['listEstado'] : 1; // Estado predeterminado si no se envía

        // Validar cédula única excluyendo el registro actual
        $sql = 'SELECT * FROM profesor WHERE cedula = ? AND profesor_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula, $iddocente)); // Validar que la cédula sea única excluyendo el docente actual
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Si se encuentra un registro con la misma cédula para otro docente
        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'El docente con esta cédula ya existe');
        } else {
            // Si no hay conflicto de cédula, proceder con la inserción o actualización
            if ($iddocente == 0) {
                // Insertar un nuevo docente (cuando $iddocente es 0)
                $sqlInsert = 'INSERT INTO profesor (nombre, direccion, cedula, clave, telefono, correo, nivel_est, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $direccion, $cedula, $password, $telefono, $correo, $nivel_est, $estado));
                $accion = 1;            
            } else {
                // Actualizar un docente existente (cuando $iddocente es mayor a 0)
                if (empty($password)) {
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, direccion = ?, cedula = ?, telefono = ?, correo = ?, nivel_est = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $direccion, $cedula, $telefono, $correo, $nivel_est, $estado, $iddocente));
                    $accion = 2;
                } else {
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, direccion = ?, cedula = ?, clave = ?, telefono = ?, correo = ?, nivel_est = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $direccion, $cedula, $password, $telefono, $correo, $nivel_est, $estado, $iddocente));
                    $accion = 3;
                }
            }

            // Mensajes de éxito para creación o actualización
            if ($request) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'Docente creado correctamente');
                } else {
                    $respuesta = array('status' => true, 'msg' => 'Docente actualizado correctamente');
                }
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al guardar los datos');
            }
        }
    }

    // Enviar la respuesta
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
ñ