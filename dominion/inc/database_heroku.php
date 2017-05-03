<?php
class Database
{
    private static $dbName = 'e39qii64avx5w7jg' ;
    private static $dbHost = 
    'y2w3wxldca8enczv.cbetxkdyhwsb.us-east-1.rds.amazonaws.com' ;
    private static $dbUsername = 'spji4fpaud8o9w6n';
    private static $dbUserPassword = 'cfbnylplrfbdad42';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>