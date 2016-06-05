<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:22
 */
class User
{
    private $id;
    private $username;
    private $mail;
    private $pw;
    private $isAdmin;
    private $galleries;

    /**
     * User constructor.
     *
     * @param $id
     * @param $username
     * @param $mail
     * @param $pw
     * @param $isAdmin
     * @param array $galleries Gallery
     */
    public function __construct($id, $username, $mail, $pw, $isAdmin, $galleries = array())
    {
        $this->id = $id;
        $this->username = $username;
        $this->mail = $mail;
        $this->pw = $pw;
        $this->isAdmin = $isAdmin;
        $this->galleries = $galleries;
    }

    /**
     * @return array
     */
    public function getGalleries()
    {
        return $this->galleries;
    }

    /**
     * @param array $galleries
     */
    public function setGalleries($galleries)
    {
        $this->galleries = $galleries;
    }
    
    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPw()
    {
        return $this->pw;
    }

    /**
     * @param mixed $pw
     */
    public function setPw($pw)
    {
        $this->pw = $pw;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
    
    
    
    
}