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
    private $owner;


    /**
     * Gallary constructor.
     * @param $id
     * @param $name string
     * @param $images
     * @param $owner User
     * @param $readUsers Users with read access
     */
    public function __construct($id, $name, $images, $owner, $readUsers)
    {
        $this->id = $id;
        $this->name = $name;
        $this->images = $images;
        $this->readUsers = $readUsers;
        $this->owner = $owner;
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
     * @return Image[]
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
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return User[]
     */
    public function getReadUsers()
    {
        return $this->readUsers;
    }

    /**
     * @param User[] $readUsers
     */
    public function setReadUsers($readUsers)
    {
        $this->readUsers = $readUsers;
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


}