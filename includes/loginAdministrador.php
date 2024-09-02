<?php 
    session_start();
    if(!empty($_POST)) {
        if(empty($_POST['usuario']) || empty($_POST['password'])){
            echo '<div class="alert alert-danger">Todos los campos son necesarios</div>';
        }else{
            require_once 'conexion.php';

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $sql = 'SELECT * FROM usuarios as u INNER JOIN rol as r ON u.rol = r.rol_id WHERE u.usuario = ? AND u.estado != 2';
            $query = $pdo->prepare($sql);
            $query->execute(array($usuario));
            $result = $query->fetch(PDO::FETCH_ASSOC);


            if($query->rowCount() > 0){
                if(password_verify($password, $result['clave'])){

                    if($result['estado'] == 1){
                        $_SESSION['active'] = true;
                        $_SESSION['id_usuairo'] = $result['usuario_id'];
                        $_SESSION['nombre'] = $result['usuario'];
                        $_SESSION['rol'] = $result['rol_id'];
                        $_SESSION['nombre_rol'] = $result['nombre_rol'];

                        echo '<div class="alert alert-success">Redirecting</div>';
                    }else {
                        echo '<div class="alert alert-warning">Usuario Inactivo Comuniquese con el administrador</div>';
                    }
                    

                }else{
                    echo '<div class="alert alert-danger">Usuario o contraseña incorrecta</div>';
                }
            }else{
                echo '<div class="alert alert-danger">Usuario o contraseña incorrecta</div>';
            }
        }
    }
?>