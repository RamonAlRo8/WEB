<!--  
    Programacion WEB
    30/03/2025
    Actividad 13 - Calculadora
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <!-- HTML -->
    <!-- Formulario -->
    <h1>Actividad 14</h1>
    <h2>Formulario: ISSET/EMPTY</h2>
    <form action="formulario.php" method="post">
        <input type="text" name="name" id="name" placeholder="Nombre">
        <input type="text" name="age" id="age" placeholder="Edad">
        <input type="email" name="email" id="email" placeholder="Email"><hr>

        <button type="submit">Enviar</button><hr>
    </form>

    <!-- PHP -->
    <?php
        if(isset($_POST['name']) || isset($_POST['age']) || isset($_POST['email'])){
            $name = $_POST['name'];
            $age = $_POST['age'];
            $email = $_POST['email'];

            if(!is_numeric($age)){
                echo "Ingrese un valor valido para la Edad!.<br>";
            }

            if(!empty($name && $age && $email)){
                echo "Nombre: $name<br>";
                echo "Edad: $age<br>";
                echo "Email: $email<br>";
            }else{
                echo "Ingrese los campos faltantes!.<br>";
                echo "Nombre: $name<br>";
                echo "Edad: $age<br>";
                echo "Email: $email<br>";
            }
        }else{
            echo "Porfavor, Ingrese los campos solicitados.<br>";
        }
    ?>
</body>
</html>