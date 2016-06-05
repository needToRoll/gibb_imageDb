<?php
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:18
 */



class Dispatcher
{

    /**
     * Dispatcher constructor.
     */
    public function __construct()
    {
        // print "Dispatcher created";
    }

    public function dispatch(){
        $uri = $_SERVER["REQUEST_URI"];
        $arguments = explode("/",$uri);
        $controller = (!empty($arguments[0]) ? $arguments[0] : "Default")."Controller";
        $action = (!empty($arguments[1])? $arguments[1]:"showHome");
        require "\\controller\\$controller.php";
        $controllerObject = new $controller();
        $controllerObject->$action();


    }
}