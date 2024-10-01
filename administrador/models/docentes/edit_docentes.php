<?php 
require_once '../../../includes/conexion.php';

if (!empty($_GET)) {
    // Asegúrate de que el ID sea un número entero
    $iddocente = intval($_GET['iddocente']);
    
    // Consulta para obtener los datos del profesor
    $sql = 'SELECT * FROM profesor WHERE profesor_id = ?';
    $query = $pdo->prepare($sql);
    $query->execute(array($iddocente));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
    } else {
        // Prepara la respuesta con los datos del docente
        $respuesta = array('status' => true, 'data' => array(
            'docente_id' => $result['profesor_id'], // Asegúrate de que la clave exista
            'nombre' => $result['nombre'],
            'direccion' => $result['direccion'],
            'cedula' => $result['cedula'],
            'telefono' => $result['telefono'],
            'correo' => $result['correo'],
            'nivel_est' => $result['nivel_est'],
            'estado' => $result['estado'] // Asegúrate de que esta columna también esté presente
        ));
    }
    // Devuelve la respuesta en formato JSON
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    // Respuesta si no se proporciona el ID
    echo json_encode(array('status' => false, 'msg' => 'ID de docente no proporcionado'));
}
?>
