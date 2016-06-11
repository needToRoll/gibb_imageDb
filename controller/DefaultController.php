<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 11:11
 */

require_once "/view/View.php";
require_once "/controller/GalleryController.php";

class DefaultController
{


    public function showHome()
    {
        if (!isset($_SESSION["userId"])) {
            $view = new View("home.htm");
            $view->render();
        } else {
            header("Location: /gallery/showOverview");
        }
        // print "show Home called";
    }
}