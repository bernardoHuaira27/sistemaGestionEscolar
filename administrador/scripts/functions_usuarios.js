

$("#tambleUsuario").DataTable();

let tableusuarios;

document.addEventListener("DOMContentLoaded", function () {
  tableusuarios = $("#tableUsuario").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: "./models/usuarios/table_usuarios.php",
      dataSrc: "",
    },

    columns: [
      { data: "acciones" },
      { data: "usuario_id" },
      { data: "nombre" },
      { data: "usuario" },
      { data: "nombre_rol" },
      { data: "estado" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "asc"]],
  });

  var formUsuario = document.querySelector('#formUsuario');
  formUsuario.onsubmit = function(e){
    e.preventDefault();
      var nombre = document.querySelector('#nombre').value;
      let usuario = document.querySelector("#usuario").value;
      let password = document.querySelector("#password").value;
      let rol = document.querySelector("#listRol").value;
      let estado = document.querySelector("#listEstado").value;

     
 
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let url = './models/usuarios/ajax_usuarios.php';
      let form = new FormData(formUsuario);

      request.open('POST', url, true);
      request.send(form);

      request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
          var data = JSON.parse(request.responseText);
          if(data.status){ 
            setTimeout(function () {
              $("#modalUsuario").modal("hide");
            },3000);
            formUsuario.reset();
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'success');
            tableusuarios.ajax.reload();
          } else {
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'danger');
          }
          console.error("Error al analizar JSON:", e);
          showNotification('usuario', 'Error en la respuesta del servidor.', 'error');
        }
      }


    }

});


function openModal() {
  $("#modalUsuario").modal("show");
}


function editarUsuario(id){
  let idusuario = id;
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let url = './models/usuarios/edit_usuarios.php?idusuario =' +idusuario;
  request.open('GET', url, true);
  request.send();

  request.onreadystatechange = function() {
    try {
      var data = JSON.parse(request.responseText);
      if(data.status){ 
          setTimeout(function () {
            $("#modalUsuario").modal("hide");
          },1000);
          formUsuario.reset();
          showNotification("modalAlertContainer",'Atención:', data.msg, 'success');
          tableusuarios.ajax.reload();
        } else {
            showNotification("modalAlertContainer",'Atención:', data.msg, 'danger');
        }
    } catch (e) {
        console.error("Error al analizar JSON:", e);
        console.error("Respuesta del servidor:", request.responseText);
        showNotification('usuario', 'Error en la respuesta del servidor.', 'error');
    }
  }
};
