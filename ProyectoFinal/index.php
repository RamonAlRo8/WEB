<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class='bg-light'>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center mb-4">Iniciar Sesión</h3>

                <form action="auth/procesar_login.php" method="post">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                </form>

                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php
                            switch($_GET['error']){
                                case 'campos_vacios': echo "Ingresa tu email y contraseña."; break;
                                case 'credenciales_invalidas': echo 'Email o contraseña incorrectas'; break;
                            }
                        ?>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['registro']) && $_GET['registro'] == 'exitoso'): ?>
                    <div class="alert alert-success">¡Registro exitoso!</div>
                    <?php endif; ?>

                <div class="mt-3 text-center">
                    <a href="signup.php">¿No tienes cuenta?</a><br>
                    <a href="recuperar_password.php">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>