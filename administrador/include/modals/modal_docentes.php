

<div class="modal fade" id="modalDocente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tituloModal">Nuevo Docente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Contenedor para la notificación -->
        <div id="modalAlertContainer"></div>
        <form id="formDocente" name="formDocente">
          <input type="hidden" name="iddocente" id="iddocente" value="">
          <div class="form-group mb-3">
            <label for="control-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <div class="form-group mb-3">
            <label for="control-label">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
          <div class="form-group mb-3">
            <label for="control-label">Cedula</label>
            <input type="text" class="form-control" name="cedula" id="cedula">
          </div>
          
          <div class="form-group mb-3">
            <label for="control-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="form-group mb-3">
            <label for="control-label">Telefono</label>
            <input type="text" class="form-control" name="telefono" id="telefono">
          </div>
          <div class="form-group mb-3">
            <label for="control-label">Correo</label>
            <input type="text" class="form-control" name="correo" id="correo">
          </div>
          <div class="form-group mb-3">
            <label for="control-label">Nivel de Estudios</label>
            <input type="text" class="form-control" name="nivel_est" id="nivel_est">
          </div>
          <div class="form-group mb-3">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerra</button>
            <button id="action" type="submit" class="btn btn-primary">Guardar</button>
        </div>
          
        </form>
      </div>

    </div>
  </div>
</div>