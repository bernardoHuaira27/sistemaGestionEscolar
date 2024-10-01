$("#tableDocentes").DataTable();

let tabledocentes;

document.addEventListener("DOMContentLoaded", function () {
    // Inicialización de DataTable
    tabledocentes = $("#tableDocentes").DataTable({
        aProcessing: true,
        aServerSide: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        ajax: {
            url: "./models/docentes/table_docentes.php",
            dataSrc: "",
        },
        columns: [
            { data: "acciones" },
            { data: "profesor_id" },
            { data: "nombre" },
            { data: "direccion" },
            { data: "cedula" },
            { data: "telefono" },
            { data: "correo" },
            { data: "nivel_est" },
            { data: "estado" },
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [[0, "asc"]],
    });

    // Manejo del formulario de docentes
    var formDocente = document.querySelector('#formDocente');
    formDocente.onsubmit = function (e) {
        e.preventDefault();

        // Variables del formulario
        let iddocente = document.querySelector('#iddocente').value;
        let password = document.querySelector('#password').value.trim();

        // Crear objeto XMLHttpRequest
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        
        // Diferenciar entre crear o actualizar
        let url = (iddocente === "") ? './models/docentes/ajax_docentes.php' : './models/docentes/update_docente.php';
        let form = new FormData(formDocente);

        // Si está editando y el campo de contraseña está vacío, lo eliminamos del FormData
        if (iddocente !== "" && password === "") {
            form.delete('password');
        }

        request.open('POST', url, true);
        request.send(form);

        // Manejo de la respuesta del servidor
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    setTimeout(function () {
                        $("#modalDocente").modal("hide");
                    }, 3000);
                    formDocente.reset();
                    showNotification("modalAlertContainer", 'Atención:', data.msg, 'success');
                    tabledocentes.ajax.reload(); // Recargar la tabla
                } else {
                    showNotification("modalAlertContainer", 'Atención:', data.msg, 'danger');
                }
            }
        };

        // Manejo de errores de conexión
        request.onerror = function () {
            showNotification("modalAlertContainer", 'Error:', 'No se pudo conectar con el servidor.', 'danger');
        };
    };
});

// Abrir el modal para agregar un nuevo docente
function openModal() {
    document.querySelector('#iddocente').value = "";
    document.querySelector('#tituloModal').innerHTML = 'Nuevo Docente';
    document.querySelector('#action').innerHTML = 'Guardar';
    document.querySelector('#formDocente').reset();
    $("#modalDocente").modal("show");
}

// Función para editar un docente
function editarDocente(id) {
    let iddocente = id;
    document.querySelector('#tituloModal').innerHTML = 'Actualizar Docente';
    document.querySelector('#action').innerHTML = 'Actualizar';

    // Crear objeto XMLHttpRequest
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let url = './models/docentes/edit_docentes.php?iddocente=' + iddocente;
    request.open('GET', url, true);
    request.send();

    // Manejo de la respuesta del servidor
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            try {
                var data = JSON.parse(request.responseText);
                if (data.status) {
                    document.querySelector('#iddocente').value = data.data.docente_id;
                    document.querySelector('#nombre').value = data.data.nombre;
                    document.querySelector("#direccion").value = data.data.direccion;
                    document.querySelector("#cedula").value = data.data.cedula;
                    document.querySelector("#telefono").value = data.data.telefono;
                    document.querySelector("#correo").value = data.data.correo;
                    document.querySelector("#nivel_est").value = data.data.nivel_est;
                    document.querySelector("#listEstado").value = data.data.estado;
                    $("#modalDocente").modal("show");
                } else {
                    showNotification("modalAlertContainer", 'Atención:', data.msg, 'danger');
                }
            } catch (e) {
                console.error("Error al procesar la respuesta del servidor: ", e);
            }
        }
    };

    // Manejo de errores de conexión
    request.onerror = function () {
        showNotification("modalAlertContainer", 'Error:', 'No se pudo conectar con el servidor.', 'danger');
    };
}


function eliminarDocente(id) {
  let iddocente = id;

  Swal.fire({
    title: 'Eliminar Docente',
    text: '¿Realmente quieres eliminar el docente?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, Eliminar',
    cancelButtonText: 'No, cancelar',
  }).then((result) => {
    if (result.isConfirmed) {
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let url = './models/docentes/delete_docentes.php';
      request.open('POST', url, true);
      let strData = "iddocente=" + iddocente;
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(strData);
      request.onreadystatechange = function() {
        request.onreadystatechange = function() {
          if (request.readyState === 4 && request.status === 200) {
            console.log("Respuesta del servidor: ", request.responseText);
            let data = JSON.parse(request.responseText);
            if (data.status) { 
                Swal.fire('Eliminado', data.msg, 'success');
                tabledocentes.ajax.reload();
            } else {
                Swal.fire('Atenciona', data.msg, 'danger');
            }
          } 
        };
      };
    }
  });
}

