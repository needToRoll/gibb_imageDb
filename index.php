<?php
require_once "/Controller/Dispatcher.php";
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 10:54
 */
session_start();
session_regenerate_id();
$_SESSION["generatedAt"] = (new DateTime())->getTimestamp();
$dispatcher = new Dispatcher();
$dispatcher->dispatch();