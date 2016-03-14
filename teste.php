

<?php

require 'php/SQL/sql_controller.php';
require 'php/objects/car.php';
//phpinfo();
$con = new SqlController;
$result = array();
//echo $con->Request('Req', 'Acura');
$obj = new Car(2, 'HFT1234', 1, '038001-6');
$result = $con->Report('InfUser', 'Andre');

if($result) echo 'Valido!';

echo count($result) . '....';
echo $result[0]['nome'] . '/';
echo $result[0]['telefone'] . '/';
echo $result[0]['marca'] . '/';
echo $result[0]['modelo'] . '/';

print_r($result);

;

?>