<?php 
require_once '../../../includes/conexion.php';

echo '<pre>';
print_r($_GET);
echo '</pre>';

if (isset($_GET['idusuario']) && !empty($_GET['idusuario'])) {
    $idusuario = $_GET['idusuario'];

    $sql = 'SELECT * FROM usuarios WHERE usuario_id = ?';
    $query = $pdo->prepare($sql);
    $query->execute(array($idusuario));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
    } else {
        $respuesta = array('status' => true, 'data' => $result);
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    $respuesta = array('status' => false, 'msg' => 'ID de usuario no proporcionado');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
