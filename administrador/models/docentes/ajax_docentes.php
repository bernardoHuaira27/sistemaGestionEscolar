<?php 

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    // Validar que los campos no estén vacíos
    if (empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['cedula']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['nivel_est'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Recuperar los valores del formulario
        $iddocente = isset($_POST['iddocente']) ? intval($_POST['iddocente']) : 0; // El ID del docente (0 si es nuevo)
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $nivel_est = isset($_POST['nivel_est']) ? trim($_POST['nivel_est']) : '';
        $estado = isset($_POST['listEstado']) ? intval($_POST['listEstado']) : 0;

        // Cifrar la contraseña si no está vacía
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Comprobar si ya existe un docente con la misma cédula
        $sql = 'SELECT * FROM profesor WHERE cedula = ? AND profesor_id != ? AND estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute(array($cedula, $iddocente)); // Comparar la cédula y excluir al docente actual
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'El docente ya existe');
        } else {
            // Insertar o actualizar según sea necesario
            if ($iddocente == 0) {
                // Si no existe el ID del docente, entonces se está creando un nuevo docente
                $sqlInsert = 'INSERT INTO profesor (nombre, direccion, cedula, clave, telefono, correo, nivel_est, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $direccion, $cedula, $password, $telefono, $correo, $nivel_est, $estado));
                $accion = 1; // Indica que se ha creado un nuevo docente
            } else {
                // Actualizar el docente existente
                if (empty($password)) {
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, direccion = ?, cedula = ?, telefono = ?, correo = ?, nivel_est = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $direccion, $cedula, $telefono, $correo, $nivel_est, $estado, $iddocente));
                    $accion = 2; // Indica que se ha actualizado un docente
                } else {
                    $sqlUpdate = 'UPDATE profesor SET nombre = ?, direccion = ?, cedula = ?, clave = ?, telefono = ?, correo = ?, nivel_est = ?, estado = ? WHERE profesor_id = ?';
                    $queryUpdate = $pdo->prepare($sqlUpdate);
                    $request = $queryUpdate->execute(array($nombre, $direccion, $cedula, $password, $telefono, $correo, $nivel_est, $estado, $iddocente));
                    $accion = 3; // Indica que se ha actualizado un docente con nueva contraseña
                }
            }

            if ($request > 0) {
                if ($accion == 1) {
                    $respuesta = array('status' => true, 'msg' => 'Docente Creado Correctamente');
                } else {
                    $respuesta = array('status' => true, 'msg' => 'Docente Actualizado Correctamente');
                }
            }
        }
    }

    // Enviar la respuesta como JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}

?>