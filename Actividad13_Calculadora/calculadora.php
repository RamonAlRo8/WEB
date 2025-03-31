<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Variables
    $N1 = floatval($_POST["Num1"]);
    $N2 = floatval($_POST["Num2"]);
    $operacion = $_POST['operacion'];

    //Validacion
    if(!is_numeric($N1) || !is_numeric($N2)){
        die("<h4>Ingrese valores numericos.</h4>");
    }

    //Operacion
    switch($operacion){
        case "+":
            $resultado = $N1 +$N2;
            break;
        case "-":
            $resultado = $N1 - $N2;
            break;
        case "x":
            $resultado = $N1 * $N2;
            break;
        case "/":
            if($N2 == 0){
                die("<h4>No se puede dividir entre 0.</h4>");
            }
            $resultado = $N1 / $N2;
            break;
    }

    //Resultado
    echo "<h4>Resultado: $resultado</h4>";
    echo "<br><a href= 'index.html'>Volver</a>";
}
?>