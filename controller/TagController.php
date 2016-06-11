<?php

require_once "/model/TagModel.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:48
 */
class TagController
{
    private $tagModel;

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->tagModel = new TagModel();
    }


    public function create()
    {
        $inputString = htmlentities($_POST["tags"]);
        $tags = explode(" ", $inputString);
        foreach ($tags as $tag) {
            $this->tagModel->create($_POST["imageId"], $tag);
        }
        header("Location: /image/showImage/{$_POST['imageId']}");
    }
}