$(function () {

  $('#tbUsuarios').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });


  $('#btnRegistrar').click(function () {
    console.log('registrando');
    //LIMPIANDO LOS CAMPOS
    $('#idUsuario').val('0');
    $("#nombre").val('');
    $("#apellido").val('');
    $("#tipoIdentificacion").val('');
    $("#identificacion").val('');
    $("#sexo").val('');
    $("#correo").val('');
    $("#telefono").val('');
    $("#rolModal").val('');
    $("#usuario").val('');
    $("#clave").val('');
    $("#estado").val('');

    //CAMBIAR EL TIULO DEL MODAL
    $('#titulo').html('REGISTRANDO');
  });


  /**
   * VENTO PARA ELIMINAR USUARIO
   */
   $(".eliminarUsuario").click(function () {
     const idUsuario = $(this).attr("idusuario");

     Swal.fire({
      title: 'Estas seguro?',
      text: "Estas seguro que deseas eliminarlo!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminarlo!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        $.post(
          "ajax/UsuarioAjax.php?exec=eliminarUsuario",
          {
            idUsuario: idUsuario
          },
          function (response) {
    
            if(response.ssucess === true) {
              Swal.fire(
                'Eliminado!',
                `${response.msg}`,
                'success'
              ).then((result) => {
                if(result.isConfirmed) {
                  location.reload();
                }
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ah ocurrido un error, comunique con el administrador!!',
              })
            }
            console.log("Response: ", response);
          },
          "json"
        );
      }
  });
});


  /**
   * EVENTO PARA ACTUALIZAR USUARIO
   */
  $(".editarUsuario").click(function () {
    console.log("click editando");

    //CAMBIANDO EL TITULO DEL MODAL
    $('#titulo').html('ACTUALIZANDO');


    const idUsuario = $(this).attr("idusuario");
    console.log(`idUsuario: ${idUsuario}`);
    $('#idUsuario').val(idUsuario);
    
    const data = new FormData();
    data.append('idUsario', idUsuario);

    $.post(
      "ajax/UsuarioAjax.php?exec=getUsuario",
      $("#formRegistrarUsuario").serialize(),
      function (response) {

        $("#idUsuario").val(response.idUsuario);
        $("#nombre").val(response.nombre);
        $("#apellido").val(response.apellido);
        $("#tipoIdentificacion").val(response.apellido);
        $("#identificacion").val(response.apellido);
        $("#sexo").val(response.idSexo);
        $("#correo").val(response.correo);
        $("#telefono").val(response.telefono);
        $("#rolModal").val(response.idRol);
        $("#usuario").val(response.usuario);
        $("#clave").val(response.clave);
        $("#estado").val(response.estado);
        console.log("Response: ", response);
      },
      "json"
    );
  });

  $("#formRegistrarUsuario").validate({
    invalidHandler: function (event, validator) {
      // 'this' refers to the form
      var errors = validator.numberOfInvalids();
      if (errors) {
        var message =
          errors == 1
            ? "You missed 1 field. It has been highlighted"
            : "You missed " + errors + " fields. They have been highlighted";
        $("div.error span").html(message);
        $("div.error").show();
      } else {
        $("div.error").hide();
      }
    },
  });

  $("#formRegistrarUsuario").on("submit", function (e) {
    var isvalid = $("#formRegistrarUsuario").valid();
    if (isvalid) {
      e.preventDefault();
        const exec = Number($('#idUsuario').val()) == 0 ? 'registrarUsuario' : 'actualizarUsuario';

        console.log('Exec: ', exec);
        // return;
      $.post(
        `ajax/UsuarioAjax.php?exec=${exec}`,
        $("#formRegistrarUsuario").serialize(),
        function (response) {
            // return;
            if(response.ssucess) {
                $('#formRegistrarUsuario').hide();
                Swal.fire(
                    "Notificacion!",
                    `${response.msg}!`,
                    "success"
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })    
            }
          console.log("Response: ", response);
        },
        "json"
      );

    }
  });
});


// $.ajax({
//   url:"ajax/UsuarioAjax.php?exec=getUsuario",
//   type:"POST",
//   headers: { 
//     "Accept" : "application/json; charset=utf-8",
//     "Content-Type": "application/json; charset=utf-8"
//   },
//   data:$("#formRegistrarUsuario").serialize(),
//   dataType:"text",
// success: function(result){
//  console.log('data: ', result)
// }});




// $.ajax({
//   url:"ajax/UsuarioAjax.php?exec=getUsuario",
//   type:"POST",
//   headers: { 
//     "Accept" : "application/json; charset=utf-8",
//     "Content-Type": "application/x-www-form-urlencoded"
//   },
//   data: $('#formRegistrarUsuario').serialize(),
//   dataType:"text",
// success: function(result){
//  console.log('data: ', result)
// }});




// $.ajax({
//   url:"ajax/UsuarioAjax.php?exec=getUsuario",
//   type:"POST",
//   headers: { 
//     "Accept" : "application/json; charset=utf-8",
//     "Content-Type": "application/x-www-form-urlencoded"
//   },
//   data: $('#formRegistrarUsuario').serialize(),
//   dataType:"json",
// success: function(result){
//  console.log('data: ', result)
// }});
