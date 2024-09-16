

<?php 
    require_once '../../../includes/conexion.php';

    try {
        $sql = 'SELECT * FROM profesor  WHERE estado != 0';
        $query = $pdo->prepare($sql);
        $query->execute();
        $consulta = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($consulta); $i++){
            if($consulta[$i]['estado'] == 1){
                $consulta[$i]['estado'] = ' <span class="text-success">Activo</span>';
            }else{
                $consulta[$i]['estado'] = '<span class="text-danger">Inactivo</span>';
            }

            $consulta[$i]['acciones'] = '
                <button class="btn btn-primary" title="Editar" onclick="editarDocente('.$consulta[$i]['profesor_id'].')">Editar</button>
                <button class="btn btn-danger" title="Editar" onclick="eliminarDocente('.$consulta[$i]['profesor_id'].')">Eliminar</button>
            ';
        }
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>