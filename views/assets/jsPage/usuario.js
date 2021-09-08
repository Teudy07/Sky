$(function() {

    /**
     * EVENTO PARA ACTUALIZAR USUARIO 
     */
    $('.editarUsuario').click(function () { 
        console.log('click editando');
        
        const idUsuario = $(this).attr('idusuario');
        console.log(`idUsuario: ${idUsuario}`);

        const data = new FormData();
        data.append('idUsuario', idUsuario);
        data.append('exec', 'getUsuario');

        $.ajax({
            url: 'ajax/UsuarioAjax.php',
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            ssucess: function (respuesta) {
                console.log('Respuesta: ', respuesta);
    
            }
        })
    });

    $('#registra').click( function() {
        
        $.ajax({
            url: 'ajax/UsuarioAjax.php',
          method: "POST",
          data: $('#formRegistrarUsuario').serialize(),

          dataType: "json",            ssucess: function (respuesta) {
                console.log('Respuesta: ', respuesta);
    
            }
        })

    })
    
});