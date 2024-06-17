<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <form action="validar.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center">Iniciar Sesión</h3>
                                <div class="form-group">
                                    <label for="Correo">Correo:</label><br>
                                    <input type="text" name="Correo" id="Correo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Contraseña">Contraseña:</label><br>
                                    <input type="password" name="Contraseña" id="Contraseña" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <input type="submit" class="btn-login  btn  btn-md space btn-login" value="Ingresar">
                                    <div id="register-link" class="text-right">
                                        <br>
                                        <!-- <a href="registros.php"><input type="button"  class="btn btn-primary space" value="registrarse"></a> -->
                                        <a href="forgot_password.php" class="btn btn-link" style="color: #ffffff;">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
