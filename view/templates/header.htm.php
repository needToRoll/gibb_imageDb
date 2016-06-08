<?php
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 11:23
 */
require_once "/model/UserModel.php";
?>
<!doctype html>
<html lang="en">
<head>
    <link href="/yeti/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>ImageDB</title>
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/index.php">ImageDB</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Übersicht<span class="sr-only">(current)</span></a></li>
                    <?php
                    If (isset($_SESSION["userId"])) {
                        $userModel = new UserModel();
                        $user = $userModel->readById($_SESSION["userId"]);
                        if (isset($user)) {
                            echo "<li><a>Hallo " .$userModel->readById($_SESSION['userId'])->getUsername() . "</a></li></ul><ul class='nav navbar-nav navbar-right'>" .
                                "<li><a href='/User/Logout'>Logout</a></li>";
                        }
                    } else {
                        echo "<li><a>Hallo Gast</a></li></ul><ul class='nav navbar-nav navbar-right'>" .
                            "<li><a href='/Default/showHome'>Registrierung / Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
