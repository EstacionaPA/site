<?php

require '../SQL/sql_controller.php';
require 'mananger_abstract.php';
require 'register_person.php';
require 'edit_person.php';

class ManangerService{
    
    public function convertActionToClass($action, &$person){
        
        if($action == 'cadastrar') {
            $class = new registerPersonController;
            return $class;
        }
        
        elseif($action == 'cadastrarCliente') {
            $class = new registerPersonController;
            $person->access = 'c';
            return $class;
        }
        elseif($action == 'editar'){
            $class = new EditPersonController;
            return $class;
        }
        else
            return 'dont';
    }
    
    public function getJSONPost($post) {
        $person = json_decode($post); //JSON
        return $person;
    }
    
    public function checkValues($person) {
        
        //Validate Fields (HTML)
        if($person->user <> '' and $person->pass <> '' and $person->email <> '' and $person->cpf <> ''
            and $person->address <> '' and $person->number <> '' and $person->block <> '' and $person->city <> '' and $person->tel <> '' )
            
                return 'done';
        else
            return 'dont';
    }
    
    public function checkPost($post) {
        
        if(isset($post)) {
 
            return 'done';}
        else 
            return NULL;
    }
    
    public function checkSingleValue($toCheck, $value){
        $check = SqlController::Validate($toCheck, $value);
        return $check;
    }
    
    public function register($person){
        $sql = SqlController::Insert('registerPerson', $person);
        return $sql;
    }
    
    public function update($index, $value, $user){
        
        $obj = array('column' => $index,
                     'value' => $value,
                     'user' => $user);
                     
        $update = SqlController::Update('UpdateUser', $obj);
        return $update;
    }   
}

?>