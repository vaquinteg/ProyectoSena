<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/Login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container row m-2 mt-5 pt-5 d-flex justify-content-between">
            
            <!-- Formulario login -->
            
               <div class="col-md-6 d-flex justify-content-center p-5"><img src="imagen/Logo.png" alt="Logo" height=200px></div>
                <div class="col-md-6 d-flex justify-content-center">
            <form action="php/validar_usuario.php" id="loginFor" class="login" method="post" onsubmit="return false" >
                <h1>Ingresar</h1>
                <input type="number" id="identificacion" name="identificacion" class="login-input" placeholder="Identificación" autofocus>
                <input type="password" id="password" name="password" class="login-input" placeholder="Contraseña">
                <input  type="submit" value="Ingresar" class="login-submit">
                <p class="login-help"><a href="">¿Olvidó su password?</a></p>
            </form>
            </div>
          </div>

       
       
         
         
         
        
       
<script src="js/Login.js"></script>
    
    </body>
</html>
