<?php

$json = file_get_contents('dados.json');
$dados = json_decode($json, true);


foreach ($dados as $key => $value) {// tem uma variável pra cada pergunta do json
    foreach ($value as $key => $value) {
        /*echo "<pre>";
        print("{$key} => {$value}");
        echo "<pre>";*/

        switch ($key) {
            case 'curso':
                $curso[] = $value;
                break;
            
            case 'ano':
                $ano[] = $value;
                break;
            
            case 'cor':
                $cor[] = $value;
                break;
            
            case 'idade':
                $idade[] = $value;
                break;
            
            case 'sexo':
                $sexo[] = $value;
                break;
            
            case 'orientacao':
                $orientacao[] = $value;
                break;
            
            case 'religiao':
                $religiao[] = $value;
                break;

            case 'moradia':
                $moradia[] = $value;
                break;

            case 'trabalho':
                $trabalho[] = $value;
                break;
            
            case 'fundamental':
                $fundamental[] = $value;
                break;

            case 'escolhaIF':
                $escolhaIF[] = $value;
                break;

            case 'ensinoSuperior':
                $ensinoSuperior[] = $value;
                break;

            case 'streaming':
                $streaming[] = $value;
                break;

            case 'politica':
                $politica[] = $value;
                break;

            case 'alimentacao':
                $alimentacao[] = $value;
                break;

            case 'atividadeFisica':
                $atividadeFisica[] = $value;
                break;

            case 'drogas':
                $drogas[] = $value;
                break;

            case 'renda':
                $renda[] = $value;
                break;

            case 'divorcio':
                $divorcio[] = $value;
                break;

            case 'irmao':
                $irmao[] = $value;
                break;

            case 'cansacoAula':
                $cansacoAula[] = $value;
                break;

            case 'pressao':
                $pressao[] = $value;
                break;

            case 'tempoEstudo':
                $tempoEstudo[] = $value;
                break;

            case 'relacionamentosIF':
                $relacionamentosIF[] = $value;
                break;

            case 'estadoEspirito':
                $estadoEspirito[] = $value;
                break;

            case 'tmepoParticular':
                $tmepoParticular[] = $value;
                break;

            case 'prodCultural':
                $prodCultural[] = $value;
                break;

            case 'suicidio':
                $suicidio[] = $value;
                break;
            default:
                //algo deu muito errado;
                break;
        }
        //$curso[$key] .=$value ;
    }
}
function getJSON($arquivo){
    $json = file_get_contents("{$arquivo}");
    $dados = json_decode($json, true);
    return $dados;
}

function variavel($dados, $chaveJson){// n tá funfando
    foreach ($dados as $key => $value) {
        foreach ($value as $chave => $valor) {
            if ($chaveJson == $chave) {
                $dados[] = $valor;
            }
        }
    }
    return $dados;
}


/**
 * Retorna o valor que mais aparece no array (moda estatistica)
 * @param array $a Array de valores
 * @param int $quantidade Quantidade de vezes que a moda foi observada
 * @return array Valores mais observados no array
 */
function moda(array $a, &$quantidade = 0) { 
//funcao que dá a moda definitiva
//peguei pronta de um site
    $moda = array();
    if (empty($a)) {
        return $moda;
    }

    // Calcular quantidade de ocorrencias de cada valor
    $ocorrencias = array();
    foreach ($a as $valor) {
        $valor_str = var_export($valor, true);
        if (!isset($ocorrencias[$valor_str])) {
            $ocorrencias[$valor_str] = array(
                'valor' => $valor,
                'ocorrencias' => 0
            );
        }
        $ocorrencias[$valor_str]['ocorrencias'] += 1;
    }

    // Determinar maior ocorrencia
    $quantidade = null;
    foreach ($ocorrencias as $item) {
        if ($quantidade === null || $item['ocorrencias'] >= $quantidade) {
            $quantidade = $item['ocorrencias'];
        }
    }

    // Obter valores com a maior ocorrencia
    foreach ($ocorrencias as $item) {
        if ($item['ocorrencias'] == $quantidade) {
            $moda[] = $item['valor'];
        }
    }
    return $moda;
}
function calcModa($pergunta){
// funcao que dá os dados da moda
    $moda = array_count_values($pergunta);
    return $moda;
}

function porcentagem($moda){
    foreach ($moda as $key => $value) {
        $dados[$key] = number_format((100*$value)/246, 1, '.','');
    }
    return $dados;
//pega a moda de cada resposta e já calcula as suas porcentagens
}
//print_r(porcentagem(calcModa($religiao)));
/*
$a = porcentagem(calcModa($curso)); 
                foreach ($a as $key => $value) {
                    print("{$value}%, ");
                }*/
//print_r(calcModa($ano));
//print_r(array_count_values($curso)); //moda
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([

            <?php
                echo "['religiao', 'porcentagem'],";
                $a = calcModa($religiao);
                foreach ($a as $key => $value) {
                    echo "['{$key}', {$value}],";
                }
            ?>


          /*['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]*/
        ]);

        var options = {
          title: 'religião',
          pieHole: 0.6,
          height: 1500,
          width: 1500
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

         google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart_div.innerHTML);
      });

        chart.draw(data, options);


      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
