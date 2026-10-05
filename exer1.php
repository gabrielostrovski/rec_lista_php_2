<?php 

$senha = "Senha@123.";


function contadorMaiusculas($senha) 
{
    $contador = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $contador++;
        }
    }

    return $contador;
}


function contadorMinusculas($senha) 
{
    $contador = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $contador++;
        }
    }

    return $contador;
}


function contadorNumeros($senha) 
{
    $contador = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (is_numeric($senha[$i])) {
            $contador++;
        }
    }

    return $contador;
}


function contadorCaracteresEspeciais($senha) 
{
    $contador = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $contador++;
        }
    }

    return $contador;
}


function contadorSenha($senha) 
{
    $contador = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        $contador++;
    }

    return $contador;
}


function classificarSenha($senha, $maiuscula, $minuscula, $numeros, $caracteres)
{
    $tamanho = strlen($senha);

    if ($tamanho < 8) {
        return "Fraca";
    }


    if ($maiuscula >= 1 && 
        $minuscula >= 1 && 
        $numeros >= 1 && 
        $caracteres >= 1) {

        return "Muito Forte";

    } elseif ($maiuscula >= 1 && 
              $minuscula >= 1 && 
              $numeros >= 1) {

        return "Forte";

    } elseif ($minuscula >= 1 && 
              $numeros >= 1) {

        return "Média";

    } else {

        return "Fraca";
    }
}



$maiuscula = contadorMaiusculas($senha);

$minuscula = contadorMinusculas($senha);

$numeros = contadorNumeros($senha);

$caracteres = contadorCaracteresEspeciais($senha);

$tamanho = contadorSenha($senha);

$seguranca = classificarSenha($senha, $maiuscula, $minuscula, $numeros, $caracteres);



echo "1 - A quantidade de letras maiúsculas é $maiuscula.<br>";

echo "2 - A quantidade de letras minúsculas é $minuscula.<br>";

echo "3 - A quantidade de números é $numeros.<br>";

echo "4 - A quantidade de caracteres especiais é $caracteres.<br>";

echo "5 - O tamanho da senha é $tamanho caracteres.<br>";

echo "6 - A segurança da senha é: $seguranca.";

?>