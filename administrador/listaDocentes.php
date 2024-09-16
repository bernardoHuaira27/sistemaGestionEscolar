<?php 
    require_once 'include/header.php';
    require_once 'include/modals/modal_docentes.php';
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i>Lista de Docentes</h1>
            <button class="btn btn-success" type="button" onclick="openModal()">Nuevo Docente</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Lista de Docentes</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableDocentes">
                  <thead>
                    <tr>
                      <th>ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>DIRECCION</th>
                      <th>CEDULA</th>
                      <th>TELEFONO</th>
                      <th>CORREO</th>
                      <th>NIVEL DE ESTUDIOS</th>
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