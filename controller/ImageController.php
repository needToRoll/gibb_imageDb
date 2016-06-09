<?php
require_once "/model/ImageModel.php";
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:46
 */
class ImageController
{

    private $imageModel;

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->imageModel = new ImageModel();
    }

    public function upload()
    {
        $originalFileName = $_FILES["file"]["name"];
        $tempFilePath = $_FILES["file"]["tmp_name"];
        $galleryId = $_POST["galleryId"];
        $imgName = $_POST["imageName"];
        $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $img = $this->getImage($tempFilePath,$fileExt);
        $dt = new DateTime();
        $timeStamp = $dt->getTimestamp();
        $fileName = hash("sha512",$imgName.$galleryId.$timeStamp);
        $relPath = "/data/uploaded/".$fileName.".".$fileExt;
        $path = __DIR__."/..".$relPath;
        move_uploaded_file($tempFilePath,$path);
        $thumbPath = $this->makeThumbnail($img,$path,"thumbNail_".$fileName.".png");
        $this->imageModel->create($relPath,$thumbPath,$imgName,$galleryId);
    }

    public function getImage($file, $extension)
    {
        $image = null;
        switch ($extension) {
            case "png":
                $image = imagecreatefrompng($file);
                break;
            case "jpg":
                $image = imagecreatefromjpeg($file);
                break;
            case "gif":
                $image = imagecreatefromgif($file);
                break;
            case "jpeg":
                $image = imagecreatefromjpeg($file);
                break;
        }
        return $image;
    }

    public function makeThumbnail($original, $filename, $targetFileName){

        $imageData = @getimagesize($filename);
        if (!$imageData)
            throw new \Exception("Create Thumbnail failed");
        list ($width, $height, $sourceType) = $imageData;
        $scale = max($width, $height) / 100;
        $newWidth = $width / $scale;
        $newHeight = $height / $scale;
        $thumbnail = imagescale($original, $newWidth, $newHeight);
        $relThumbPath = "/data/uploaded/thumbnails/".$targetFileName;
        $thumbPath = __DIR__."/..".$relThumbPath;
        imagepng($thumbnail, $thumbPath, 0);
        return $relThumbPath;
    }
}