<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center mb-4">Crear Cuenta</h3>
                <?php
                    if(isset($_GET['error'])):
                ?>
                <div class="alert alert-danger">
                    <?php
                        switch($_GET['error']){
                            case 'campos-vacios': echo 'Por favor completa los campos solicitados.'; break;
                            case 'email_invalido': echo 'El correo no es válido.'; break;
                            case 'contrasena_corta': echo 'La contraseña debe tener al menos 8 caracteres.'; break;
                            case 'email_duplicado': echo 'Este correo ya esta en uso.'; break;
                            case 'fallo_registro': echo 'Error al registrar. Intenta de nuevo.'; break;
                        }
                    ?>
                </div>
                <?php endif; ?>
                <form action="auth/procesar_signup.php" method="post">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-succes w-100" type="submit">Registrarse</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="index.php">¿Ya tienes cuenta?</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>