<?php
require_once "/model/AccessModel.php";
require_once "/view/View.php";
require_once "/model/GalleryModel.php";
require_once "/model/Usermodel.php";

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

    /**
     * GallaryController constructor.
     */
    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->accessModel = new AccessModel();
        $this->userModel = new UserModel();

    }

    public function showOverview()
    {
        print $_SESSION["userId"];
        $own = $this->accessModel->getOwnGalleries(($_SESSION['userId']));
        var_dump($own);
        $read = $this->accessModel->getReadGalleries($_SESSION['userId']);
        $viewOptions = array();
        $viewOptions["ownGalleries"] = $own;
        $viewOptions["readGalleries"] = $read;
        $view = new View("overview.htm", $viewOptions);
        $view->render();
    }

    public function create()
    {
        $galleryName = $_POST["name"];
        $owner = $this->userModel->readById($_SESSION["userId"]);

        $this->galleryModel->create($galleryName, $owner);
        $this->showOverview();
    }

    public function showGallery($args)
    {
        $targetId = $args[0];
        $viewOptions = array();
        $viewOptions["gallery"] = $this->galleryModel->readById($targetId);
        $view = new View("galleryDetail.htm", $viewOptions);
        $view->render();
    }
}