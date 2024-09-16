<?php 
require_once '../../../includes/conexion.php';



    if (!empty($_GET)){

        $iddocente = $_GET['iddocente'];
        
        $sql = 'SELECT * FROM profesor WHERE profesor_id = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($iddocente));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            $respuesta = array('status' => false, 'msg' => 'Datos no encontrados');
        } else {
            $respuesta = array('status' => true, 'data' => $result);
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    } 
?>
