<?php
require "\\Controller\\Dispatcher.php";
/**  
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 10:54
 */
session_start();
session_regenerate_id();
$dispatcher = new Dispatcher();
$dispatcher->dispatch();