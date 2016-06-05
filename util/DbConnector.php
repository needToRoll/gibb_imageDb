<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 05.06.2016
 * Time: 21:27
 */
class DbConnector
{
    private static $connection;
    
    public static function getConnection(){
        if(!isset(self::$connection)){
            self::$connection = new mysqli("localhost","root", "1234", "imageDb",3306);
        }
        return self::$connection;
    }
}