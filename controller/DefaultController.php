<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 11:11
 */

require_once "/view/View.php";

class DefaultController
{
    public function showHome()
    {
        $view = new View("home.htm");
        $view->render();
        // print "show Home called";
    }

    public function showOverview()
    {
        if(isset($_SESSION['userId'])){
        }
    }
}