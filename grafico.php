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

print_r(calcModa($ano));
print_r(array_count_values($curso)); //moda


?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['2010', 10, 24, 20, 48, 2, 5, ''],//porcentagens (em moda já)
        ['2020', 16, 22, 23, 30, 16, 9, ''],
        ['2030', 28, 19, 29, 30, 12, 13, '']
      ]);

       var options_fullStacked = {
          isStacked: 'percent',
          height: 300,
          legend: {position: 'top', maxLines: 3},
          hAxis: {
            minValue: 0,
          }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options_fullStacked);

        google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart_div.innerHTML);
      });

      chart.draw(data, options_fullStacked);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
