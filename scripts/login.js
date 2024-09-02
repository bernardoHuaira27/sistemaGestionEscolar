
$(document).ready(function(){
    $('#loginAdministrador').on('click',function(){
        loginAdministrador();
    })
    $('#loginDocente').on('click',function(){
        loginDocente();
    })
})

function loginAdministrador(){
    let usuario = $('#username-admin').val();
    let password = $('#password-admin').val();


    $.ajax({
        url: './includes/loginAdministrador.php',
        method: 'POST',
        data: {
            usuario:usuario,
            password:password
        },
        success: function(data){
            $('#messageAdministrador').html(data);
            setTimeout(function(){
                if(data.indexOf('Redirecting') >= 0){
                    window.location = 'Administrador/';
                }
            }, 1000)
            // Muestra el mensaje por 2 segundos y luego lo oculta
            setTimeout(function(){
                $('#messageAdministrador').html('');
            }, 2000);
            console.log("error")
        }
    })
}
function loginDocente(){
    let usuario = $('#username-docente').val();
    let password = $('#password-docente').val();

    console.log(usuario)
    console.log(password)

    $.ajax({
        url: './includes/loginDocente.php',
        method: 'POST',
        data: {
            usuario:usuario,
            password:password,
        },
        success: function(data){
            $('#messageDocente').html(data);
            setTimeout(function(){
                if(data.indexOf('Redirecting') >= 0){
                    window.location = 'Docente/';
                }
            }, 1000)
            // Muestra el mensaje por 2 segundos y luego lo oculta
            setTimeout(function(){
                $('#messageDocente').html('');
            }, 2000);
            console.log("error")
        }
    })
}