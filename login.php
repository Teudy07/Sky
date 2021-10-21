<!doctype html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php
  include("./views/partials/header.php");
  ?>


  <title>LOGIN</title>

  </head>
  <body>

    <!-- CONTENT
    ================================================== -->
    <section class="section-border border-primary">
      <div class="container d-flex flex-column ">
        <div class="row justify-content-center align-items-center justify-content-center no-gutters min-vh-100">
          <div class="col-8 texto-lateral">
            <div class="login-main-text">
              <div class="cajita">
              <h1 class="hi my-element">SKY <br> Control de Inventario.<br></h1>
              <p class="text-light my-element">Simplifica tu trabajo en cuestion de minutos.!!</p>
              </div>
            </div>
          </div>
          <div class="col-4 col-xs-12 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
          <?php if(isset($_GET['r']))
          
    {
      ?>
      <div class="alert alert-success" role="alert">
                  <strong>Datos de acceso incorrectos!</strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">X</span>
                  </button>
                </div>
                <?php
    }?>
            <!-- Heading -->
            <h1 class="text-light text-center fst-italic">
              Iniciar Sesión
            </h1> 
              <br>
            <!-- Form -->
            <div class="login-form">
            <form class="text-light" action="loginexe.php" method="post" class="p-container">
                <!-- Email -->
                
                <div class="form-group fst-italic">
                  <label for="email">
                  <i class="fa fa-user "></i> 
                  USUARIO
                  </label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa tu usuario" value="teudy07" required>
                </div>

                <!-- Password -->
                <div class="form-group mb-5 fst-italic">
                  <label for="password">
                  <i class="fa fa-lock"></i>  
                  CONTRASEÑA
                  </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" value="123" required>
                </div>
                <br>
                <!-- Submit -->
                <button class="btn btn-block btn-info" type="submit">
                  LOGIN
                </button>

                </form>
            </div>
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
      
  </body>

<!-- Mirrored from landkit.goodthemes.co/signin-illustration.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Mar 2020 00:11:01 GMT -->
</html>