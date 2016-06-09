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
        $controller = (!empty($arguments[1]) ? ucfirst($arguments[1]) : "Default")."Controller";
        $action = (!empty($arguments[2])? strtolower($arguments[2]):"showHome");
        require_once "/controller/$controller.php";
        $controllerObject = new $controller();
        If(sizeof($arguments)>3) {
            $args = array_slice($arguments, 3);
            var_dump($args);
            $controllerObject->$action($args);
        } else {
            $controllerObject->$action();
        }
    }
}