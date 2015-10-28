<?php

$array = array(
    'fruit1' => 'apple',
    'kk' => 'k',
    'fruit3' => 'grape',
    'fruit4' => 'apple',
    'fruit5' => 'apple');

// this cycle echoes all associative array
// key where value equals "apple"
while ($fruit_name = current($array)) {

        echo key($array).'<br />';
    
    next($array);
}
?>