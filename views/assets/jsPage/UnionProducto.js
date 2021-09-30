$(function () {

    $('#tbUnionProducto').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  
  
    $('#btnRegistrar').click(function () {
      console.log('registrando');
      //LIMPIANDO LOS CAMPOS
      $('#idmarca').val('0');
       $("#descripcion").val('');
       $("#estado").val('');
  
      //CAMBIAR EL TIULO DEL MODAL
       $('#titulo').html('REGISTRANDO');
    });
  
  
    /**
     * EVENTO PARA ELIMINAR Marca
     */
     $(".eliminarMarca").click(function () {
       const idmarca = $(this).attr("idmarca");
  
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
            "ajax/UnionProductoAjax.php?exec=eliminarMarca",
            {
              idmarca: idmarca
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
     * EVENTO PARA ACTUALIZAR Marca
     */
    $(".editarMarca").click(function () {
      console.log("click editando");
  
      //CAMBIANDO EL TITULO DEL MODAL
       $('#titulo').html('ACTUALIZANDO');
  
  
      const idmarca = $(this).attr("idmarca");
      console.log(`idmarca: ${idmarca}`);
      $('#idmarca').val(idmarca);
      
      const data = new FormData();
      data.append('idmarca', idmarca);
  
      $.post(
        "ajax/UnionProductoAjax.php?exec=getMarca",
        $("#formRegistrarUnionProducto").serialize(),
        function (response) {
  
          $("#idmarca").val(response.idmarca);
          $("#descripcion").val(response.descripcion);
          $("#estado").val(response.estado);
          console.log("Response: ", response);
        },
        "json"
      );
    });
  
    $("#formRegistrarUnionProducto").validate({
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
  
    $("#formRegistrarUnionProducto").on("submit", function (e) {
      var isvalid = $("#formRegistrarUnionProducto").valid();
      if (isvalid) {
        e.preventDefault();
          const exec = Number($('#idmarca').val()) == 0 ? 'registrarMarca' : 'actualizarMarca';
  
          console.log('Exec: ', exec);
          // return;
        $.post(
          `ajax/index.php?c=UnionProducto&m=registrarMarca`,
          $("#formRegistrarUnionProducto").serialize(),
          function (response) {
              // return;
              if(response.ssucess) {
                  $('#formRegistrarUnionProducto').hide();
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