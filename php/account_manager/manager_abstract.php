<?php

abstract class ManagerAbstract{
    public static function doAction(&$class, &$svc, $person){
        $class->controll($svc, $person);
    }
}

?>