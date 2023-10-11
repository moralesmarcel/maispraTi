<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Calculadora de IMC</title>
    </head>

    <body>
        <h2>Calculadora de IMC</h2>
        <hr size="3">  
        <p>Entre com as medidas solicitadas</p>
      
        <form>
            Peso (kg): <input name="peso">
            <br />
            Altura (metros): <input name="altura">
            <br />
            <br>
            <button> Calcular o IMC </button>
        </form>

        <?php
            if (isset($_GET["peso"]) && isset($_GET["altura"])){
                $peso = $_GET["peso"];
                $altura = $_GET["altura"];
                
                // Fórmula do IMC
                $imc = $peso / ($altura * $altura);
            
                echo "<p>O seu IMC é $imc</p>";

                // Classificação do IMC
                if ($imc < 18.5) {
                    echo "<p>Você está Abaixo do Peso Normal.</p>";
                } else if ($imc >= 18.5 && $imc < 24.9) {
                    echo "<p>Seu peso está dentro do Peso Normal.</p>";
                } else if ($imc >= 25 && $imc < 29.9) {
                    echo "<p>Você está com Excesso de peso.</p>";
                } else if ($imc >= 30 && $imc < 34.9) {
                    echo "<p>Você está com Obesidade grau 1.</p>";
                } else if ($imc >= 35 && $imc < 39.9) {
                    echo "<p>Você está com Obesidade grau 2.</p>";
                } else {
                    echo "<p>Você está com Obesidade grau 3.</p>";
                }
            }
        ?>
    
    </body>
</html>
