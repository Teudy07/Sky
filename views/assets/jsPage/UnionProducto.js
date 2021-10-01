

$(function () {

  function getNombreDelParametro(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    const regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  
  const type = getNombreDelParametro('type');
  const operacion = {};
  
  console.log(type);
  
  switch(type) {
    case 'modelo':
      operacion.modal = 'ModalformularioModelo';
      operacion.formulario = 'formularioModelo';
      operacion.ejecturar = 'registrarModelo';
      operacion.actualizar = 'actualizarModelo';
      operacion.eliminar = 'eliminarModelo';
    break;

    case 'marca':
      operacion.modal = 'ModalformularioMarca';
      operacion.formulario = 'formularioMarca';
      operacion.ejecturar = 'registrarMarca';
      operacion.actualizar = 'actualizarMarca';
      operacion.eliminar = 'eliminarMarca';
    break;
  }

  console.log('operaciones: ', operacion);
  
  if(type === undefined || type === null) {
    console.log('error');
    return;
  }


  $("#tbUnionProducto").DataTable({
    dom: "Bfrtip",
    buttons: ["copy", "csv", "excel", "pdf", "print"],
  });

  $("#btnRegistrar").click(function () {
    console.log("registrando");
    //LIMPIANDO LOS CAMPOS
    $("#idmarca").val("0");
    $("#descripcion").val("");
    $("#estado").val("1");

    //CAMBIAR EL TIULO DEL MODAL
    $("#titulo").html("REGISTRANDO");
  });

  /**
   * EVENTO PARA ELIMINAR Marca
   */
   $(".eliminar").click(function () {

    //CAMTURANDO EL VALOR DEL REGISTRO DE LA TABLA 
    let idDato = 0;
    switch(type) {
      case 'modelo':
        idDato =  $(this).attr("idmodelo");
        break;

      case 'marca':
        idDato =  $(this).attr("idmarca");
        break;
    }


    // console.log(`Estoy en ${type} y voy a eliminar al: ${idDato}`);
    // return;

    Swal.fire({
      title: "Estas seguro?",
      text: "Estas seguro que deseas eliminarlo!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Eliminarlo!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          `ajax/index.php?c=Producto&m=${operacion.eliminar}`,
          {
            eliminar: idDato,
          },
          function (response) {
            if (response.success === true) {
              Swal.fire("Eliminado!", `${response.msg}`, "success").then(
                (result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                }
              );
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ah ocurrido un error, comunique con el administrador!!",
              });
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
    console.log("editando");
    console.log("click editando");

    //CAMBIANDO EL TITULO DEL MODAL
    $("#titulo").html("ACTUALIZANDO");

    const idmarca = $(this).attr("idmarca");
    console.log(`idmarca: ${idmarca}`);
    $("#idmarca").val(idmarca);

    const data = new FormData();
    data.append("idmarca", idmarca);

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

  $(`#${operacion.formulario}`).validate({
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

  $(".formulario").on("submit", function (e) {
    // $(".btnRegistrar").click(function () {
      e.preventDefault();

    console.log('preciono el formulario');
    //Valida el formulario
    var isvalid = $(`#${operacion.formulario}`).valid();

    if (isvalid) {
      $.post(
        `ajax/index.php?c=Producto&m=${operacion.ejecturar}`,
        $(`#${operacion.formulario}`).serialize(),
        function (response) {
          // return;
          if (response.ssucess) {
            //Cierra el modal activo
            $(`#${operacion.modal} .close`).click();
            Swal.fire("Notificacion!", `${response.msg}!`, "success").then(
              (result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              }
            );
          }
          console.log("Response: ", response);
        },
        "json"
      );
    }
  });
});
