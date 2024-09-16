<?php 
require_once '../../../includes/conexion.php';


    if (isset($_POST['iddocente'])) {
        $iddocente = $_POST['iddocente'];

        $sql = 'DELETE FROM profesor WHERE profesor_id = ?';
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($iddocente));

        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Usuario Eliminado Correctamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al Eliminar');
        }
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
?>
