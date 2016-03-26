<?php

class VacanciesServices {
    
     public function checkDate($date){
        
        /*
         *VALIDAÇÕES:
         *SE CONTÉM 10 CARACTERES   
         *SE OQUE CONTEM ENTRES OS NUMEROS SÃO BARRAS
         *SE É DO TIPO DATA
        */
        
        $day = 0;
        $month = 0;
        $year = 0;
        $config = array('posInitChar1' => 2,
                        'posEndChar1' => -7,
                        'posInitChar2' => 5,
                        'posEndChar2' => -4,
                        'ASCIICode' => 47, // '/' on ASCII table = 47
                        'strLenMax' => 10); 
                               
                                // '/' on ASCII table = 47
        if($this->validVars($date, $config)) return 'not';
       
        $day = substr($date, 0, 2);
        $month = substr($date, 4, 6);
        $year = substr($date, 8, 10);
        
        if(!checkdate($month, $day, $year))
            return 'not';
            
        return 'done';
    }
    
    public function checkHour($hourInit, $hourEnd){
        
        /*
         *VALIDAÇÕES:
         *SE CONTÉM 8 CARACTERES   
         *SE OQUE CONTEM ENTRES OS NUMEROS SÃO DOIS PONTOS
         *SE É DO TIPO HORA
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
        if($this->validVars($hourInit, $config) or 
            $this->validVars($hourEnd, $config)) 
                return 'not';
        
        return 'done';

    }
     
    public function checkResult($result, $object){
        
        $i = 0;
        $validHourReserve = true;
        $validHourEnd = true;
        $validHourEndBetween = true;
        
        for($i; $i < count($result); $i++){
            if(($object['hora_reserva'] >= $result[$i]['hora_reserva'] and
                $object['hora_reserva'] < $result[$i]['hora_fim']))
                    $validHourReserve = false;
                    
            if(($object['hora_fim'] > $result[$i]['hora_reserva'] and
                $object['hora_fim'] <= $result[$i]['hora_fim'])){
                    $validHourEnd = false; 
                    
                }
                    
            if(($object['hora_fim'] > $result[$i]['hora_reserva'] and
                $object['hora_reserva'] < $result[$i]['hora_reserva']))
                $validHourEndBetween = false;
                
        echo 'reserva: ' . $object['hora_reserva'] . '. ini: ' . $result[$i]['hora_reserva'] . '<br>';
        echo 'fim: ' . $object['hora_fim'] . '. end: ' . $result[$i]['hora_fim'] . '<br>';
                
        }
        if($object['hora_fim'] < $object['hora_reserva'])
            return '!validInitEndHour';
        if($validHourReserve == false)
            return '!validHourReserve';
        elseif($validHourEnd == false)
            return '!validHourEnd';
        elseif($validHourEndBetween == false)
            return '!validHorEndBetween';
        
        else
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
    
    public function validVars($str, $config){
        
        $char1 = '';
        $char2 = '';
        
        if(!strlen($str) == $config['strLenMax'])
            return 'not';
        
        $char1 = substr($str, $config['posInitChar1'], $config['posEndChar1']);//FIRST '/' OR ':'
        $char2 = substr($str, $config['posInitChar2'], $config['posEndChar2']);//SECOND '/' OR ':'
        
        //ord() returns the ASCII code of the string
        if(ord($char1) != $config['ASCIICode'] or 
            ord($char2) != $config['ASCIICode']) 
            return 'not';
            
        if($config['checkHour']){
            
            $time = $this->returnTimes($str);
            
            $hour = $time['hour'];
            $min = $time['min'];
            $sec = $time['sec'];
            
            if(!((is_numeric($hour) and ($hour >= 00 and $hour < 24)) and
                 (is_numeric($min) and ($min >= 00 and $min < 60)) and
                 (is_numeric($sec) and $sec == 00)))
                    return 'not';
        }    
            
        return NULL;
    }
    
    public function returnTimes($times){
        
        $time = array('hour' => substr($times, 0, -6),
                      'min' => substr($times, 3, -3),
                      'sec' => substr($times, 6));
    
        return $time;
    }
    
    public function registerVacancy($object){
        $result = SqlController::Insert('RegisterVacancy', $object);
        return $result;
    }
}

?>