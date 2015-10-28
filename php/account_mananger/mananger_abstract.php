<?php

abstract class ManangerAbstract{
    public static function doAction(&$class, &$svc, $person){
        $class->controll($svc, $person);
    }
}

?>