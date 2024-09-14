<?php 
require_once '../../../includes/conexion.php';


    if (isset($_POST['idusuario'])) {
        $idusuario = $_POST['idusuario'];

        $sql = 'DELETE FROM usuarios WHERE usuario_id = ?';
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($idusuario));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Usuario Eliminado Correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al Eliminar');
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>
