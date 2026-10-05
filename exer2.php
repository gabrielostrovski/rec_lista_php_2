<?php

$texto = "Olá, mundo! Como você está? Acredito que tudo bem. Eu estou bem, obrigado!";

function prepararPalavras($texto)
{
    $texto = preg_replace('/[^\p{L}\s]/u', '', $texto);

    return explode(" ", strtolower($texto));
}


function contarCaracteres($texto)
{
    return mb_strlen($texto);
}


function contarPalavras($texto)
{
    $palavras = prepararPalavras($texto);

    return count($palavras);
}


function contarFrases($texto)
{
    preg_match_all('/[.!?]/', $texto, $resultado);

    return count($resultado[0]);
}


function encontrarMaiorPalavra($texto)
{
    $palavras = prepararPalavras($texto);

    $maior = "";

    foreach ($palavras as $palavra) {

        if (mb_strlen($palavra) > mb_strlen($maior)) {
            $maior = $palavra;
        }

    }

    return $maior;
}


function encontrarMenorPalavra($texto)
{
    $palavras = prepararPalavras($texto);

    $menor = $palavras[0];

    foreach ($palavras as $palavra) {

        if (mb_strlen($palavra) < mb_strlen($menor)) {
            $menor = $palavra;
        }

    }

    return $menor;
}


function contarPalavrasRepetidas($texto)
{
    $palavras = prepararPalavras($texto);

    $quantidade = array_count_values($palavras);

    $repetidas = [];

    foreach ($quantidade as $palavra => $vezes) {

        if ($vezes > 1) {
            $repetidas[$palavra] = $vezes;
        }

    }

    return $repetidas;
}


function cincoMaisFrequentes($texto)
{
    $palavras = prepararPalavras($texto);

    $quantidade = array_count_values($palavras);

    arsort($quantidade);

    return array_slice($quantidade, 0, 5);
}


function removerEspacosDuplicados($texto)
{
    return preg_replace('/\s+/', ' ', trim($texto));
}


function formatarTexto($texto)
{
    return ucfirst(strtolower($texto));
}


function processarTexto($texto)
{
    return [


        "quantidade_caracteres" => contarCaracteres($texto),

        "quantidade_palavras" => contarPalavras($texto),

        "quantidade_frases" => contarFrases($texto),

        "palavra_mais_longa" => encontrarMaiorPalavra($texto),

        "palavra_mais_curta" => encontrarMenorPalavra($texto),

        "palavras_repetidas" => contarPalavrasRepetidas($texto),

        "cinco_frequentes" => cincoMaisFrequentes($texto),

        "texto_sem_espacos" => removerEspacosDuplicados($texto),

        "texto_formatado" => formatarTexto($texto)

    ];
}



$resultado = processarTexto($texto);


echo "Características do Texto: <br>";
echo "Quantidade de caracteres: " . $resultado["quantidade_caracteres"] . "<br>";
echo "Quantidade de palavras: " . $resultado["quantidade_palavras"] . "<br>";
echo "Quantidade de frases: " . $resultado["quantidade_frases"] . "<br>";
echo "Palavra mais longa: " . $resultado["palavra_mais_longa"] . "<br>";
echo "Palavra mais curta: " . $resultado["palavra_mais_curta"] . "<br>";


echo "<br>Palavras repetidas:<br>";

foreach ($resultado["palavras_repetidas"] as $palavra => $quantidade) {

    echo "$palavra apareceu $quantidade vezes<br>";

}

echo "<br>5 palavras mais frequentes:<br>";

foreach ($resultado["cinco_frequentes"] as $palavra => $quantidade) {

    echo "$palavra: $quantidade vezes<br>";

}

echo "<br>Texto sem espaços duplicados:<br>";

echo $resultado["texto_sem_espacos"];


echo "<br><br>Texto formatado:<br>";

echo $resultado["texto_formatado"];

?>