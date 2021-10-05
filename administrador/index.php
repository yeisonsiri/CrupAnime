<?php
session_start();
if($_POST){
    if (($_POST['usuario']=="Admin")&&($_POST['contrasenia']=="1234")) {
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="Admin";
        header('Location:Inicio.php');
    }else{
        $mensaje= "ERROR: El usuario o contraseña son incorrecto";
    }
    
}
?>

<!doctype html>
<html lang="en">
  <head>

    <title>Login</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body background="../img/Cover.jpg">
      
      <div class="container">
          <div class="row">
          <div class="col-md-4">
          </div>

              <div class="col-md-4">
              
            <br/><br/><br/>
              <div class="card text-white">
                  <div class="card-header bg-info">
                     <div class="text-center">usuario: Admin contraseña:1234<br/>Loging</div>  
                      
                  </div>
                  <div class="card-body bg-dark">
                        <?php if (isset($mensaje)) {?>
                        
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje;?>
                        </div>
                    <?php } ?>
                      <form method="POST">
                      <div class = "form-group">
                      <label >Usuario</label>
                      <input type="text" class="form-control" name="usuario" placeholder="Introduce tu usuario">
                      </div>

                      <div class="form-group">
                      <label>Contraseña:</label>
                      <input type="password" class="form-control" name="contrasenia" placeholder="Introduce la contraseña">
                      </div>   
                      <button type="submit" class="btn btn-primary">Iniciar secciòn</button>

                      </form>
                      
                       
                  </div>
                  
              </div>
                  
              </div>
              
          </div>
      </div>
    
  </body>
</html>