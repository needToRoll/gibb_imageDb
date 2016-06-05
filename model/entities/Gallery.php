<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:27
 */
class Gallery
{
    private $id;
    private $name;
    private $images;
    private $readUsers;
    
    

    /**
     * Gallary constructor.
     * @param $id
     * @param $name
     * @param $images
     * @param $readUsers Users with read access
     */
    public function __construct($id, $name, $images, $readUsers)
    {
        $this->id = $id;
        $this->name = $name;
        $this->images = $images;
        $this->readUsers = $readUsers;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return Users
     */
    public function getReadUsers()
    {
        return $this->readUsers;
    }

    /**
     * @param Users $readUsers
     */
    public function setReadUsers($readUsers)
    {
        $this->readUsers = $readUsers;
    }

    

}