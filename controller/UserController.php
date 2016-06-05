<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:45
 */
class UserController
{
    private $userModel;
    private $user;

    public function __construct()
    {
        $this->userModel = new UserModel();
        
    }
    
    

}