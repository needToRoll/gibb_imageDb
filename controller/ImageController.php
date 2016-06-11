<?php
require_once "/model/ImageModel.php";
require_once "/model/AccessModel.php";
require_once "/view/View.php";
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:46
 */
class ImageController
{

    private $imageModel;
    private $accessModel;


    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->imageModel = new ImageModel();
        $this->accessModel = new AccessModel();
    }

    public function upload()
    {
        $originalFileName = $_FILES["file"]["name"];
        $tempFilePath = $_FILES["file"]["tmp_name"];
        $galleryId = $_POST["galleryId"];
        $imgName = $_POST["imageName"];
        $fileExt = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        $img = $this->getImage($tempFilePath,$fileExt);
        $timeStamp = (new DateTime())->getTimestamp();
        $fileName = hash("sha512",$imgName.$galleryId.$timeStamp);
        $relPath = "/data/uploaded/".$fileName.".".$fileExt;
        $path = __DIR__."/..".$relPath;
        move_uploaded_file($tempFilePath,$path);
        $thumbPath = $this->makeThumbnail($img,$path,"thumbNail_".$fileName.".png");
        $this->imageModel->create($relPath,$thumbPath,$imgName,$galleryId);
        header("Location: /gallery/showGallery/$galleryId");
    }

    public function getImage($file, $extension)
    {
        $image = null;
        switch ($extension) {
            case "png":
                $image = imagecreatefrompng($file);
                break;
            case "jpeg":
            case "jpg":
                $image = imagecreatefromjpeg($file);
                break;
            case "gif":
                $image = imagecreatefromgif($file);
                break;
        }
        return $image;
    }

    public function makeThumbnail($original, $filename, $targetFileName){

        $imageData = @getimagesize($filename);
        if (!$imageData)
            throw new \Exception("Create Thumbnail failed");
        list ($width, $height, $sourceType) = $imageData;
        $scale = max($width, $height) / 175;
        $newWidth = $width / $scale;
        $newHeight = $height / $scale;
        $thumbnail = imagescale($original, $newWidth, $newHeight);
        $relThumbPath = "/data/uploaded/thumbnails/".$targetFileName;
        $thumbPath = __DIR__."/..".$relThumbPath;
        imagepng($thumbnail, $thumbPath, 0);
        return $relThumbPath;
    }

    public function showImage($args){
        $targetId = $args[0];
        $viewArgs = array();
        $relation = $this->accessModel->getUserImageRelation($_SESSION["userId"],$targetId);
        if($relation!=null){
            $viewArgs["isOwner"] = $relation;
            $viewArgs["image"] = $this->imageModel->readById($targetId);
            $view = new View("imageDetail.htm", $viewArgs);
            $view->render();
        } else {
            echo "<script>alert('Zugriff verweigert'</script>";
        }

    }
}