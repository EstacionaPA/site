<?php

echo 'a';

$var = $_POST['teste'];

for($i=0;$i<10;$i++)
        $var = $var . $var;
        
echo $var;
        
    return;

?>