$(function () {

  $('#tbContacto').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });

  $('#pais').change(function () {
    const idPais = $(this).val();
    if(idPais > 0) {
      $.get(
        `ajax/index.php?c=Contacto&m=getProvincia`,
        {idPais: idPais},
        function (response) {
          $('#provincia').html(response.html);
        console.log('respuesta: ', response);
        },
        "json"
      );
    }
    console.log('idpais haciendo referencia: ', $('#pais').val());
    console.log('idpais: propiedad del evento', $(this).val());
  });



  $('#btnRegistrar').click(function () {
    $('#titulo').text('REGISTRANDO');
    $('#idContacto').val("0");
    $('#nombre').val('');
    $('#razonSocial').val('');
    $('#tipoIdentificacion').val('');
    $('#identificacion').val('');
    $('#correo').val('');
    $('#telefono').val('');
    $('#identificacion').val('');
    // $('#esProveedor').prop('checked', Number(response[0].esProveedor) === 1 ? true : false);
    // $('#esCliente').prop('checked', Number(response[0].esCliente) === 1 ? true : false);
    $('#estado').val('1');

    console.log('registrando');
    //LIMPIANDO LOS CAMPOS
    // $('#idUsuario').val('0');
    // $("#nombre").val('');
    // $("#apellido").val('');
    // $("#tipoIdentificacion").val('');
    // $("#identificacion").val('');
    // $("#sexo").val('');
    // $("#correo").val('');
    // $("#telefono").val('');
    // $("#rolModal").val('');
    // $("#usuario").val('');
    // $("#clave").val('');
    // $("#estado").val('');

    //CAMBIAR EL TIULO DEL MODAL
    // $('#titulo').html('REGISTRANDO');
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
    
            if(response.success === true) {
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
   * EVENTO PARA ACTUALIZAR Contacto
   */
  $(".editarContacto").click(function () {
    console.log("click editando");

    //CAMBIANDO EL TITULO DEL MODAL
    // $('#titulo').html('ACTUALIZANDO');


    const idContacto = $(this).attr("idContacto");
    console.log(`idContacto: ${idContacto}`);
    $('#idContacto').val(idContacto);
    
    console.log('idContacto: ', idContacto);
    // return;

    $.get(
      `ajax/index.php?c=Contacto&m=getContacto`,
      {
        idContacto: idContacto
      },
      function (response) {
        if(response.length > 0) {
          $('#titulo').text('ACTUALIZANDO');
          $('#idContacto').val(response[0].idContacto);
          $('#nombre').val(response[0].nombre);
          $('#razonSocial').val(response[0].razonSocial);
          $('#tipoIdentificacion').val(response[0].idTipoIdentificacion);
          $('#identificacion').val(response[0].identificacion);
          $('#correo').val(response[0].correo);
          $('#telefono').val(response[0].telefono);
          $('#identificacion').val(response[0].Identificacion);
          $('#esProveedor').prop('checked', Number(response[0].esProveedor) === 1 ? true : false);
          $('#esCliente').prop('checked', Number(response[0].esCliente) === 1 ? true : false);
          $('#estado').val(response[0].estado);

        } else {
          Swal.fire(
            "Notificacion!",
            `Ah ocurrido un error!`,
            "error"
          ).then((result) => {
              if (result.isConfirmed) {
                  location.reload();
              }
          });
        }
        $('#idConsorcio').val()
        console.log("Response: ", response);
      },
      "json"
    );
  });

  $("#formRegistrarContacto").validate({
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

  $("#formRegistrarContacto").on("submit", function (e) {
    var isvalid = $("#formRegistrarContacto").valid();
    if (isvalid) {
      e.preventDefault();
        const exec = Number($('#idContacto').val()) == 0 ? 'registrarContacto' : 'actualizarContacto';

        console.log('Exec: ', exec);
        // return;
      $.post(
        `ajax/index.php?c=Contacto&m=${exec}`,
        $("#formRegistrarContacto").serialize(),
        function (response) {
            // return;
            if(response.success) {
                $('#formRegistrarContacto').hide();
                Swal.fire(
                    "Notificacion!",
                    `${response.msg}!`,
                    "success"
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })    
            } else {
              Swal.fire(
                "Notificacion!",
                `Ah ocurrido un error, favor de comunicarse con Don Teudy alias Orochimaru!`,
                "success"
            ).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            })    
            }
          // console.log("Response: ", response);
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
