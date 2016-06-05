<?php
require_once "/model/AccessModel.php";
require_once "/view/View.php";
require_once "/model/GalleryModel.php";

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

    /**
     * GallaryController constructor.
     */
    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->accessModel = new AccessModel();
    }

    public function showOverview()
    {
        $own = $this->accessModel->getOwnGalleries(($_SESSION['userId']));
        $read = $this->accessModel->getReadGalleries($_SESSION['userId']);
        $viewOptions = array();
        $viewOptions["ownGalleries"] = $own;
        $viewOptions["readGalleries"] = $read;
        $view = new View("overview.htm",$viewOptions);
        $view->render();
    }
}