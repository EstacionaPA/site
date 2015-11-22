<?php
class ManagerService{
    public function checkVar($var) {
        
        if(isset($var) or isset($var[0])) 
            return 'done';
        else 
            return NULL;
    }
}
?>