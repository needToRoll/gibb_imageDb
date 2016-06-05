<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:30
 */
class Image
{
    private $id;
    private $file;
    private $thumbnail;
    private $name;
    private $tags;

    /**
     * Image constructor.
     * @param $id
     * @param $file
     * @param $thumbnail
     * @param $name
     * @param $tags
     */
    public function __construct($id, $file, $thumbnail, $name, $tags)
    {
        $this->id = $id;
        $this->file = $file;
        $this->thumbnail = $thumbnail;
        $this->name = $name;
        $this->tags = $tags;
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    

}