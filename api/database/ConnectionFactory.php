<?php
class ConnectionFactory {

    public static function getDB() {
        $connection = self::getConnection();
        $db = new NotORM($connection);
        return $db;
    }
    
    private static function getConnection() {
        $dbhost = getenv('localhost');
        $dbuser = getenv('alfredudu');
        $dbpass = 'Sn@keDoctor_007';
        $dbname = 'estacionapa';
        
        try {
            $connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        }
        catch(Exception $e) {
           echo $e->getMessage();
           die;
        }
        
        return $connection;
    }
}
?>