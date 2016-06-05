<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:28
 */
class Model
{
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new mysqli("localhost","root", "1234", "imageDb",3306);
    }


}