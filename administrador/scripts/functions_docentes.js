

$("#tableDocentes").DataTable();

let tabledocentes;

document.addEventListener("DOMContentLoaded", function () {
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

  var formDocente = document.querySelector('#formDocente');
  formDocente.onsubmit = function(e){
    e.preventDefault();
      let iddocente = document.querySelector('#iddocente').value; 
      var nombre = document.querySelector('#nombre').value;
      let direccion = document.querySelector("#direccion").value;
      let cedula = document.querySelector("#cedula").value;
      let password = document.querySelector("#password").value;
      let telefono = document.querySelector("#telefono").value;
      let correo = document.querySelector("#correo").value;
      let nivel_est = document.querySelector("#nivel_est").value;
      let estado = document.querySelector("#listEstado").value;

     
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let url = './models/docentes/ajax_docentes.php';
      let form = new FormData(formDocente);
      request.open('POST', url, true);
      request.send(form);

      request.onreadystatechange = function() {
       
        if(request.readyState == 4 && request.status == 200){
          var data = JSON.parse(request.responseText);
          if(data.status){ 
            setTimeout(function () {
              $("#modalDocente").modal("hide");
            },3000);
            formDocente.reset();
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'success');
            tabledocentes.ajax.reload();
          } else {
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'danger');
          }
        }
      }


    }

});


function openModal() {
  document.querySelector('#iddocente').value = "";
  document.querySelector('#tituloModal').innerHTML = 'Nuevo Docente';
  document.querySelector('#action').innerHTML = 'Guardar';
  document.querySelector('#formDocente').reset()
  $("#modalDocente").modal("show");
}
function editarDocente(id){
  let iddocente = id;

  document.querySelector('#tituloModal').innerHTML = 'Actualizar Docente';
  document.querySelector('#action').innerHTML = 'Actualizar';

  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let url = './models/docentes/edit_docentes.php?iddocente='+iddocente;
  request.open('GET', url, true);
  request.send();

  request.onreadystatechange = function() {
    if(request.readyState === 4 && request.status === 200) {
        var data = JSON.parse(request.responseText);
        console.log(data)
        if(data.status){
          document.querySelector('#iddocente').value = data.data.docente_id; 
          document.querySelector('#nombre').value = data.data.nombre;
          document.querySelector("#direccion").value = data.data.direccion;
          document.querySelector("#cedula").value = data.data.cedula;
          document.querySelector("#telefono").value = data.data.telefono;
          document.querySelector("#correo").value = data.data.correo;
          document.querySelector("#nivel_est").value = data.data.nivel_est;
          document.querySelector("#listEstado").value = data.data.estado;
          $("#modalDocente").modal("show");
          tableusuarios.ajax.reload();
 
        } else {
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'danger');
        }
    }   
  };
};

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

