<?php
class ConnectionFactory {

    public static function getDB() {
        $connection = self::getConnection();
        $db = new NotORM($connection);
        return $db;
    }
    
    private static function getConnection() {
        $dbhost = '127.0.0.1';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'projeto';
        
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