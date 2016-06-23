<?php

namespace SON\connections;

class Connections {
    
    private static $path = 'sqlite:db_projeto.s3db';
    private static $conn = null;
    
    private static function connection()
    {
        try
        {
            if(self::$conn === null)
            {
                self::$conn = new \PDO(self::$path);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
            
        return self::$conn;
        
    }

    
    public static function getConn()
    {
        return self::connection();
       
    }
}
