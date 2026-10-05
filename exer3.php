<?php 

    $consultas = [

        [
            "paciente" => "João",
            "especialidade" => "Cardiologia",
            "data" => "06/08/2026",
            "horario" => "08:30"
        ],

        [
            "paciente" => "Maria",
            "especialidade" => "Dermatologia",
            "data" => "06/08/2026",
            "horario" => "10:00"
        ],

        [
            "paciente" => "Carlos",
            "especialidade" => "Cardiologia",
            "data" => "06/08/2026",
            "horario" => "09:00"
        ],

        [
            "paciente" => "João",
            "especialidade" => "Ortopedia",
            "data" => "06/08/2026",
            "horario" => "10:00"
        ]

    ];


    function contarConsultas($consultas)
    {
        return count($consultas);
    }

    function contarPacientesDiferentes($consultas)
    {
        $pacientes = [];

        foreach ($consultas as $consulta) {

            $pacientes[] = $consulta["paciente"];

        }
        return count(array_unique($pacientes));
    }

    function contarEspecialidades($consultas)
    {
        $especialidades = [];

        foreach ($consultas as $consulta) {

            $especialidade = $consulta["especialidade"];

            if (!isset($especialidades[$especialidade])) {
                $especialidades[$especialidade] = 0;
            }

            $especialidades[$especialidade]++;
        }

        return $especialidades;
    }


    function ordenarHorarios($consultas)
    {
        usort($consultas, function($a, $b){

            return strcmp($a["horario"], $b["horario"]);

        });
        return $consultas;
    }

    function primeiroAtendimento($consultas)
    {
        $ordenadas = ordenarHorarios($consultas);

        return $ordenadas[0];
    }

    function ultimoAtendimento($consultas)
    {
        $ordenadas = ordenarHorarios($consultas);

        return $ordenadas[count($ordenadas)-1];
    }

    function pesquisarPaciente($consultas, $nome)
    {
        $resultado = [];

        foreach ($consultas as $consulta) {

            if ($consulta["paciente"] == $nome) {
                $resultado[] = $consulta;
            }

        }

        return $resultado;
    }

    function verificarHorariosDuplicados($consultas)
    {
        $horarios = [];
        $duplicados = [];

        foreach ($consultas as $consulta) {

            $horario = $consulta["horario"];

            if (isset($horarios[$horario])) {

                $duplicados[] = $horario;

            } else {

                $horarios[$horario] = 1;
            }

        }

        return $duplicados;
    }

    function organizarAgenda($consultas)
    {

        return [

            "total_consultas" => contarConsultas($consultas),

            "pacientes_diferentes" => contarPacientesDiferentes($consultas),

            "consultas_por_especialidade" => contarEspecialidades($consultas),

            "primeiro_atendimento" => primeiroAtendimento($consultas),

            "ultimo_atendimento" => ultimoAtendimento($consultas),

            "agenda_ordenada" => ordenarHorarios($consultas),

            "paciente_pesquisado" => pesquisarPaciente($consultas, "João"),

            "horarios_duplicados" => verificarHorariosDuplicados($consultas)

        ];

    }

    $resultado = organizarAgenda($consultas);

    echo "Quantidade total de consultas: " . $resultado["total_consultas"] . "<br>";

    echo "Quantidade de pacientes diferentes: " . $resultado["pacientes_diferentes"] . "<br><br>";

    echo "Consultas por especialidade:<br>";

    foreach ($resultado["consultas_por_especialidade"] as $especialidade => $quantidade) {

        echo "$especialidade: $quantidade consultas<br>";

    }


    echo "<br>Primeiro atendimento:<br>";

    print_r($resultado["primeiro_atendimento"]);

    echo "<br><br>Último atendimento:<br>";

    print_r($resultado["ultimo_atendimento"]);


    echo "<br><br>Agenda ordenada:<br>";

    foreach ($resultado["agenda_ordenada"] as $consulta) {

        echo $consulta["horario"] . " - " . 
            $consulta["paciente"] . " - " . 
            $consulta["especialidade"] . "<br>";

    }

    echo "<br>Paciente pesquisado:<br>";

    foreach ($resultado["paciente_pesquisado"] as $consulta) {

        echo $consulta["paciente"] . " - " .
            $consulta["especialidade"] . "<br>";

    }

    echo "<br>Horários duplicados:<br>";

    if(count($resultado["horarios_duplicados"]) > 0){

        echo implode(", ", $resultado["horarios_duplicados"]);

    } else {

        echo "Nenhum horário duplicado";

    }

?>