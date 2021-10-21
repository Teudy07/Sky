
//Funcion para la tabla imprimir etc.
$(function () {

  $('#tbContacto').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
/////////////////////

////Funcion change provincia segun pais
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
//////



///funcion registrar
  $('#btnRegistrar').click(function () {
    $('#titulo').text('REGISTRANDO');
    $('#idContacto').val("0");
    $('#nombre').val('');
    $('#razonSocial').val('');
    $('#tipoIdentificacion').val('');
    $('#identificacion').val('');
    $('#direccion').val('');
    $('#provincia').val('');
    $('#pais').val('');
    $('#correo').val('');
    $('#telefono').val('');
    $('#identificacion').val('');
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
   * ACTUALIZAR Contacto
   */
  $(".editarContacto").click(function () {
    console.log("click editando");

    const idContacto = $(this).attr("idContacto");
    console.log(`idContacto: ${idContacto}`);
    $('#idContacto').val(idContacto);
    
    console.log('idContacto: ', idContacto);

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
          $('#direccion').val(response[0].direccion);

          $('#pais').val(response[0].idpais);
          $('#pais').change();

          setTimeout(() => {
            $('#provincia').val(response[0].idprovincia);
          },200);

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
        },
        "json"
      );

    }
  });
});


