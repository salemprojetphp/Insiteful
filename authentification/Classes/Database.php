<?php
class Database{
    private static $dbname = "insiteful";
    private static $user = "root";
    private static $password = "";
    private static $host = "localhost";
    private static $database = null;
    private function __construct(){
        try{
            self::$database = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname,self::$user,self::$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        }
        catch(PDOException $e){
            die("Erreur : ".$e->getMessage());
        }
    }
    public static function getDatabase()
    {
        if (!self::$database){
            new Database();
        }
        return (self::$database);
    }


}