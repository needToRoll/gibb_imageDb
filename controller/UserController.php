<?php
require_once "/model/entities/User.php";
require_once "/model/UserModel.php";


/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:45
 */
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function login()
    {
        $userName = $_POST["email"];
        $pw = $_POST["password"];
        $userId = $this->userModel->checkLogin($userName, $pw);
        if ($userId != -1) {
            $_SESSION["userId"] = $userId;
            header("Location: /Gallery/showOverview");
        } else {
            var_dump($userId);
        }
    }

    public function register()
    {
        $userIdentification = $_POST["email"];
        $pw = $this->hashPw($_POST["password"]);
        $user = $this->userModel->create($userIdentification, $userIdentification, $pw, false);
        $_SESSION["userId"] = $user->getId();
        header("Location: /Gallery/showOverview");

    }

    public function hashPw($pw)
    {
        return password_hash($pw, PASSWORD_BCRYPT);
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }


}