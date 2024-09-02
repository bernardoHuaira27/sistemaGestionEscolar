<?php 

    session_start();
    if(!empty($_POST)) {
        if(empty($_POST['usuario']) || empty($_POST['password'])){
            echo '<div class="alert alert-danger">Todos los campos son necesarios</div>';
        }else{
            require_once 'conexion.php';

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $sql = 'SELECT * FROM docente WHERE cedula = ?';
            $query = $pdo->prepare($sql);
            $query->execute(array($usuario));
            $result = $query->fetch(PDO::FETCH_ASSOC);


            if($query->rowCount() > 0){
                if(password_verify($password, $result['clave'])){
                    $_SESSION['activeP'] = true;
                    $_SESSION['profesor_id'] = $result['profesor_id'];
                    $_SESSION['nombre'] = $result['nombre'];
                    $_SESSION['rol'] = $result['rol_id'];
                    $_SESSION['cedula'] = $result['cedula'];

                    echo '<div class="alert alert-success">Redirecting</div>';

                }else{
                    echo '<div class="alert alert-danger">Usuario o contraseña incorrecta</div>';
                }
            }else{
                echo '<div class="alert alert-danger">Usuario o contraseña incorrecta</div>';
            }
        }
    }
?>