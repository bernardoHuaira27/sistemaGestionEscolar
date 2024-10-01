

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
      let idusuario = document.querySelector('#idusuario').value; 
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
          console.log(request.responseText)
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
        }
      }
    }

});


function openModal() {
  document.querySelector('#idusuario').value = "";
  document.querySelector('#tituloModal').innerHTML = 'Nuevo Usuario';
  document.querySelector('#action').innerHTML = 'Guardar';
  document.querySelector('#formUsuario').reset()
  $("#modalUsuario").modal("show");
}
function editarUsuario(id){
  let idusuario = id;

  document.querySelector('#tituloModal').innerHTML = 'Actualizar Usuario';
  document.querySelector('#action').innerHTML = 'Actualizar';

  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let url = './models/usuarios/edit_usuarios.php?idusuario='+idusuario;
  request.open('GET', url, true);
  request.send();

  request.onreadystatechange = function() {
    if(request.readyState === 4 && request.status === 200) {
        var data = JSON.parse(request.responseText);
        console.log(data)
        if(data.status){ 
         
          document.querySelector('#idusuario').value = data.data.usuario_id;
          document.querySelector('#nombre').value = data.data.nombre;
          document.querySelector('#usuario').value = data.data.usuario;
          document.querySelector('#listRol').value = data.data.rol;
          document.querySelector('#listEstado').value = data.data.estado;
          $("#modalUsuario").modal("show");
          tableusuarios.ajax.reload();

          console.error("usuario_id no está definido en los datos recibidos.");
 
        } else {
            showNotification("modalAlertContainer",'Atencion:', data.msg, 'danger');
        }
    }   
  };
};

function eliminarUsuario(id) {
  let idusuario = id;

  Swal.fire({
    title: 'Eliminar Usuario',
    text: '¿Realmente quieres eliminar el usuario?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, Eliminar',
    cancelButtonText: 'No, cancelar',
  }).then((result) => {
    if (result.isConfirmed) {
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let url = './models/usuarios/delete_usuarios.php';
      request.open('POST', url, true);
      let strData = "idusuario=" + idusuario;
      console.log(strData)
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(strData);
      request.onreadystatechange = function() {
        request.onreadystatechange = function() {
          if (request.readyState === 4 && request.status === 200) {
            console.log("Respuesta del servidor: ", request.responseText);
            let data = JSON.parse(request.responseText);
            if (data.status) { 
                Swal.fire('Eliminado', data.msg, 'success');
                tableusuarios.ajax.reload();
            } else {
                Swal.fire('Atención', data.msg, 'warning');
            }
          } 
        };
      };
    }
  });
}
