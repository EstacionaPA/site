<?php

abstract class ManangerAbtstract{
    public static function doAction(&$class, &$svc, $person){
        $class->controll($svc, $person);
    }
}

?>