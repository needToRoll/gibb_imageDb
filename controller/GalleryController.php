<?php
require_once "/model/AccessModel.php";
require_once "/view/View.php";
require_once "/model/GalleryModel.php";
require_once "/model/UserModel.php";
require_once "ImageController.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:47
 */
class GalleryController
{

    private $galleryModel;
    private $accessModel;
    private $userModel;
    private $imageController;

    /**
     * GallaryController constructor.
     */
    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->accessModel = new AccessModel();
        $this->userModel = new UserModel();
        $this->imageController = new ImageController();
    }

    public function create()
    {
        $galleryName = htmlentities($_POST["name"]);
        $owner = $this->userModel->readById($_SESSION["userId"]);
        $this->galleryModel->create($galleryName, $owner);
        $this->showOverview();
    }

    public function showOverview()
    {
        if(!isset($_SESSION["userId"])){
            header("Location: /");
        }
        $own = $this->accessModel->getOwnGalleries(($_SESSION['userId']));
        $read = $this->accessModel->getReadGalleries($_SESSION['userId']);
        $viewOptions = array();
        $viewOptions["ownGalleries"] = $own;
        $viewOptions["readGalleries"] = $read;
        $view = new View("overview.htm", $viewOptions);
        $view->render();
    }

    public function showGallery($args)
    {
        $targetId = $args[0];
        $viewOptions = array();
        $viewOptions["gallery"] = $this->galleryModel->readById($targetId);
        $view = new View("galleryDetail.htm", $viewOptions);
        $view->render();
    }

    public function delete($args){
        $id = $args[0];
        $gallery = $this->galleryModel->readById($id);
        if($gallery->getOwner()->getId()==$_SESSION["userId"]){
            foreach ($gallery->getImages() as $image){
                $arguments = array();
                $arguments[0] = $image->getId();
                $arguments[1] = false;
                $this->imageController->delete($arguments);
            }
            $this->galleryModel->delete($id);
            header("Location: /");
        }
    }

    public function filter($args){
        $id = $args[0];
        $gallery = $this->galleryModel->readById($id);
    }
}