<?php

abstract class ManagerAbstract{
    public static function doAction(&$class, $data){
        $class->controll($data);
    }
}

?>