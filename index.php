<?php 
    session_start();
    if(!empty($_SESSION['active'])){
        header('Location: administrador/');
    } else if(!empty($_SESSION['activeP'])){
        header('Location: docente/.');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/main.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 

    <title>Document</title>
</head>
<body class="background-image">
    <header class="main-header vh-100 d-flex justify-content-center align-items-center">
        <div class="container gap-4 rounded-3">
            <div class="main-content">
                <img src="./img/school1.png" alt="">
            </div>
            <div class="form-container rounded-2">
                <h1 class="text-center pb-3">Welcome</h1>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button 
                            class="nav-link active" 
                            id="nav-home-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#nav-home" 
                            type="button" 
                            role="tab" 
                            aria-controls="nav-home" 
                            aria-selected="true">Administrador
                        </button>
                        <button 
                            class="nav-link" 
                            id="nav-profile-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#nav-profile" 
                            type="button" 
                            role="tab" 
                            aria-controls="nav-profile" 
                            aria-selected="false">Docente
                        </button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div 
                            class="tab-pane fade show active" 
                            id="nav-home" 
                            role="tabpanel" 
                            aria-labelledby="home-tab" 
                            tabindex="0">
                            <form action="" onsubmit="return validar()">
                           
                                <input class="form-control mb-2" type="text" name="username" id="username-admin" placeholder="Username">
                            
                                <input class="form-control mb-2" type="text" name="password" id="password-admin" placeholder="Password">

                                <div id="messageAdministrador"></div>
                                <button class="btn btn-success mt-4 w-100" id="loginAdministrador" type="button">Login</button>
                            </form>
                        </div>

                        <div 
                            class="tab-pane fade" 
                            id="nav-profile" 
                            role="tabpanel" 
                            aria-labelledby="profile-tab" 
                            tabindex="0">
                            <form action=""  onsubmit="return validar()">
                  
                                <input class="form-control mb-2" type="text" name="username" id="username-docente" placeholder="Username">
           
                                <input class="form-control mb-2" type="text" name="password" id="password-docente" placeholder="Password">

                                <div id="messageDocente"></div>
                                <button class="btn btn-success mt-4 w-100" id="loginDocente" type="button">Login</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <script src="scripts/jquery-3.7.0.min.js"></script>
    <script src="scripts/login.js"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>