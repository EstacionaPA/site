<?php
class LicenseService {
    
    public static function listLicense() {
        $db = ConnectionFactory::getDB();
        
        $license = array();
        foreach($db->carro() as $licenses) {
           $license[] = array (
               'id' => $licenses['id'],
               'placa' => $licenses['placa'],
               'marca_id' => $licenses['marca_id'],
               'pessoas_id' => $licenses['pessoas_id'],
               'modelo_id' => $licenses['modelo_id'],
           ); 
        }
        return $license;
    }
    
    public static function getById($id) {
        $db = ConnectionFactory::getDB();
        return $db->carro[$id];
    }
}
?>