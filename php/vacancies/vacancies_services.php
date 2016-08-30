<?php

class VacanciesServices {
    
    public function checkDate($date, &$object){
        
        /*
         *VALIDATIONS:
         *IF CONTAINS 10 CARACTERS   
         *IF THAT CONTAINS BETWEEN NUMBERS IS '/'
         *IF IS SET LIKE DATE
        */
        
        $day = 0;
        $month = 0;
        $year = 0;
        $config = array('posInitChar1' => 2,
                        'posEndChar1' => -7,
                        'posInitChar2' => 5,
                        'posEndChar2' => -4,
                        'ASCIICode' => 47, // '/' on ASCII table = 47
                        'strLenMax' => 10,
                        'checkDate' => 'yes');
                               
                                // '/' on ASCII table = 47
        if($this->validVars($date, $config, $object)) return 'not';
            
        return 'done';
    }
    
    public function checkHour($hourInit, $hourEnd){
        
        /*
         *VALIDATIONS:
         *IF CONTAINS 10 CARACTERES   
         *IF THAT CONTAINS BETWEEN NUMBERS IS ':'
         *IF IS SET LIKE HOUR
        */
        
        $hour = 0;
        $min = 0;
        $sec = 0;
        $config = array('posInitChar1' => 2,
                        'posEndChar1' => -5,
                        'posInitChar2' => 5,
                        'posEndChar2' => -2,
                        'ASCIICode' => 58,
                        'strLenMax' => 8,
                        'checkHour' => 'yes');
                        
                            // ':' on ASCII table = 58
        if($this->validVars($hourInit, $config, NULL) or 
            $this->validVars($hourEnd, $config, NULL)) 
                return 'not';
        
        return 'done';

    }
     
    public function checkResult($result, $object, $index){
        
        if($object['hora_fim'] <= $object['hora_reserva'] or
           $object['hora_fim'] == $object['hora_reserva'])
            return '!validHourConsult';

        if(($object['hora_reserva'] >= $result[$index]['hora_reserva'] and
            $object['hora_reserva'] < $result[$index]['hora_fim'])
           and 
           ($object['hora_fim'] <= $result[$index]['hora_fim'] and
            $object['hora_fim'] > $result[$index]['hora_reserva']))
                return '!validHourBetween';
        
        if(($object['hora_reserva'] <= $result[$index]['hora_reserva'] and 
            $object['hora_reserva'] <= $result[$index]['hora_fim']) 
           and
           ($object['hora_fim'] > $result[$index]['hora_reserva'] and
            $object['hora_fim'] <= $result[$index]['hora_fim']))
                return '!validHourEnd';
        
        if(($object['hora_reserva'] < $result[$index]['hora_fim'] and
            $object['hora_reserva'] > $result[$index]['hora_reserva'])
           and
           ($object['hora_fim'] >= $result[$index]['hora_fim'] and
            $object['hora_fim'] > $result[$index]['hora_reserva']))
                return '!validHourInit';
        
        if(($object['hora_reserva'] <= $result[$index]['hora_reserva'] and
            $object['hora_reserva'] <= $result[$index]['hora_fim'])
           and
           ($object['hora_fim'] > $result[$index]['hora_fim'] and
            $object['hora_fim'] >= $result[$index]['hora_reserva']))
                return '!validHourInitEnd';
        
        return NULL;
    }
    
    public function checkIdCar($idCar){
        $idCar = SqlController::Validate('CheckIdCar', $idCar);
        return $idCar;
    }
    
    public function requestVacancies($object){
        $reserves = SqlController::Request('RequestReserves', $object);
        return $reserves;
    }
     
    public function requestIdUser($user){
        $id = SqlController::Request('RequestIdUser', $user);
        return $id;
    }
    
    public function requestMaxVacancies($idPark){
        $max = SqlController::Request('RequestMaxVacancies', $idPark);
        return $max;
    }
    
    public function requestSomeDataReserves($filters){
        $data = SqlController::Request('RequestSomeDataReserve', $filters);
        return $data;
    }
    
    public function validVars($str, $config, $object){
        
        $char1 = '';
        $char2 = '';
        
        if(strlen($str) > $config['strLenMax'])
            return 'not';
       
        $char1 = substr($str, $config['posInitChar1'], $config['posEndChar1']);//FIRST '/' OR ':'
        $char2 = substr($str, $config['posInitChar2'], $config['posEndChar2']);//SECOND '/' OR ':'
        
        //ord() returns the ASCII code of the string
        if(ord($char1) != $config['ASCIICode'] or 
            ord($char2) != $config['ASCIICode']) 
            return 'not';

        if(isset($config['checkHour'])){
            
            $time = $this->returnTimes($str, 'hour');

            $hour = $time['hour'];
            $min = $time['min'];
            $sec = $time['sec'];
            
            if(!((is_numeric($hour) and ($hour >= 00 and $hour < 24)) and
                 (is_numeric($min) and ($min >= 00 and $min < 60)) and
                 (is_numeric($sec) and $sec == 00)))
                    return 'not';
        }
        
        elseif(isset($config['checkDate'])){
            
            $date = $this->returnTimes($str, 'date');

            if(!checkdate($date['month'], $date['day'], $date['year']))
                return 'not';
        }
        //$object['data'] = $date['year']  . '.' . $date['month'] . '.' . 'day'
        return NULL;
    }
    
    public function returnTimes($times, $parameter){
       
        if($parameter == 'hour'){
            $time = array('hour' => substr($times, 0, 2),
                          'min' => substr($times, 3, 2),
                          'sec' => substr($times, 6));
        }
        else{
            $time = array('day' => substr($times, 0, 2),
                          'month' => substr($times, 3, 2),
                          'year' => substr($times, 6));
        }

        return $time;
    }
    
    public function registerVacancy($object){
        $result = SqlController::Insert('RegisterVacancy', $object);
        return $result;
    }
    
    public function checkHourFunc($object) {
        $hour = SqlController::Request('RequestHourFuncPark', $object['id_estac']);
        //print_r($hour);
        if($object['hora_reserva'] >= $hour[0]['h_func_init'] and 
           $object['hora_fim'] <= $hour[0]['h_func_fim'])
            return 'done';
        else
            return 'not';
    }
}

?>