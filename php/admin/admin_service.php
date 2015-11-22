<?php

class AdminService{
    
    public function update($index, $value, $user){
        
        $obj = array('column' => $index,
                     'value' => $value,
                     'user' => $user);
                     
        $update = SqlController::Update('UpdateUser', $obj);
        return $update;
    }  
    
    public function register($person){
        $sql = SqlController::Insert('registerPerson', $person);
        return $sql;
    }
    
    public function inactive($user, $cause){
        //Insert a user on inactive person table
        
        $obj = array('user' => $user,
                     'cause' => $cause);
        
        $inactive = SqlController::Insert('InactivePerson', $obj);
        return $inactive;
        
    }
    
    public function checkSingleValue($toCheck, $value){
        $check = SqlController::Validate($toCheck, $value);
        return $check;
    }
    
    public function checkInactive($user){
        
        $check = SqlController::Validate('CheckInactive', $user);
        return $check;
    }
    
    public function checkValues($person) {
        
        //Validate Fields (HTML)
        if($person['user'] <> '' and $person['pass'] <> '' and 
           $person['email'] <> '' and $person['cpf'] <> '' and
           $person['address'] <> '' and $person['number'] <> '' and 
           $person['block'] <> '' and $person['city'] <> '' and $person['tel'] <> '' )
            
                return 'done';
        else
            return 'dont';
    }
}

?>