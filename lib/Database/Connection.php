<?php 
 
    namespace Lib\Database; 

    class Connection  
    {
        private static $conn;

        public static function getConn()
        {
            if(self::$conn == null)
            { 
                self::$conn = new \PDO(DB_DRIVE . ": host=" . DB_HOST ."; dbname=". DB_NAME . ";",  DB_USER, DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 1);  
            } 
 
            return self::$conn;
        }
    }
   