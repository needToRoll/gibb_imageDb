<?php
require "entities/User.php";
require "Model.php";
require "GalleryModel.php";
require "UserModel.php";
require "entities/Gallery.php";
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 05.06.2016
 * Time: 14:18
 */
class AccessModel extends Model
{
    private $userModel;
    private $imageModel;
    private $galleryModel;

    /**
     * AccessModel constructor.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->imageModel = new ImageModel();
        $this->galleryModel = new GalleryModel();
    }


    public function getReadUsers($galleryId){
        $stmt = $this->db->prepare("SELECT user_userId FROM imagedb.gallery_user_rolle where gallery_galleryId = ? AND isOwner = FALSE ");
        $stmt->bind_param('i',$galleryId);
        $result = array();
        if ($stmt->execute()) {
            while($row = $stmt->get_result()->fetch_assoc()){
                $result[] = $this->userModel->readById($row["user_userId"]);
            }
            return $result;
        }
        return null;
    }
    
    public function getOwnGalleries($userId){
        $stmt = $this->db->prepare("SELECT gallery_galleryId FROM imagedb.gallery_user_rolle where user_userId  = ? AND isOwner = TRUE");
        $stmt->bind_param('i',$userId);
        $result = array();
        if ($stmt->execute()) {
            while($row = $stmt->get_result()->fetch_assoc()){
                $result[] = $this->galleryModel->readById($row["gallery_galleryId"]);
            }
            return $result;
        }
        return null;
    }

    private function grantAccess($userId, $galleryId, $isOwner){
        $stmt = $this->db->prepare("INSERT INTO imagedb.gallery_user_rolle (isOwner, user_userId, gallery_galleryId) VALUES (?, ?,?)");
        $stmt->bind_param('bii',$isOwner, $userId, $galleryId);
        return $stmt->execute();
    }
    
    public function grantReadAccess($userId, $galleryId){
        return $this->grantAccess($userId,$galleryId,false);
    }
    
    public function setOwner($userId,$galleryId){
        return $this->grantAccess($userId,$galleryId,true);

    }
    
    public function getOwner($galleryId){
        $stmt = $this->db->prepare("SELECT user_userId FROM imagedb.gallery_user_rolle where gallery_galleryId = ? and isOwner = TRUE");
        $stmt->bind_param('i', $galleryId);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $userId = $result["user_userId"];
            return $this->userModel->readById($userId);
        }
        return null;
        
    }
}