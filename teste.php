

<?php

require 'index.php';

$array = array( 'vaga' => 6,
                'data' => '22.03.16');
            
            

print_r($array);

$json = json_encode($array);
$serial = md5($json);   
echo $serial;


?>