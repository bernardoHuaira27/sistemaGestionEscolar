<?php 
    require_once 'include/header.php';
    require_once 'include/modals/modals.php';
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Lista de Usuarios</h1>
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Usuario</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Usuarios</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableUsuario">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>USUARIO</th>
                      <th>ROL</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    

<?php 
    require_once 'include/footer.php';
?>