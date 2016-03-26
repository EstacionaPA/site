

<?php

require 'php/SQL/sql_controller.php';

$array = array( 'vaga' => 6,
                'data' => '22.03.16');
            
            
$array = SqlController::Request('RequestReserves', $array);

print_r($array);

echo '<br>------------<br>';

echo ' reserva: ' . $array[4]['data'] . ' ';
echo ' fim: ' . $array[1]['data'] .'.';

echo ' ' . count($array) . ' ';

if($array[1]['data'] < $array[4]['data'])
    echo ' hora reserva: menor';
    
elseif($array[1]['data'] > $array[4]['data'])
    echo ' hora reserva: maior';

else
    echo ' outro ';
    
$count = count($array);
for($i = 0; $i < $count; $i++){
    echo '<br>';
    echo ' reserva: ' . $array[$i]['hora_reserva'] . ' ';
    echo ' fim: ' . $array[$i]['hora_fim'] .'.';
    if($array[$i]['hora_reserva'] < $array[$i]['hora_fim'])
        echo ' hora reserva: menor';
        
    elseif($array[$i]['hora_reserva'] > $array[$i]['hora_fim'])
        echo ' hora reserva: maior';
    echo '<br>';
    echo $array[$i];
    echo '---';
    echo '<br>';
    echo count($array);
    echo '<br>';
    for($l=0;$l<count($array[$i]); $l++){
        echo $array[$i][$l];
        echo '<br>';
    }
}


?>