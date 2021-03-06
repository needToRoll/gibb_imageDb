<?php
require_once "entities/User.php";
require_once "Model.php";
require_once "GalleryModel.php";
require_once "UserModel.php";
require_once "entities/Gallery.php";
require_once "DatabaseInterface.php";

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

    /**
     * AccessModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->imageModel = new ImageModel();
    }


    public function getAccessByRequestedFile($path, $userId)
    {
        $imageId = $this->imageModel->getIdByPath($path);
        return $this->getUserImageRelation($userId, $imageId) != null;
    }

    public function getUserImageRelation($userId, $imageId)
    {
        $stmt = $this->db->prepare("SELECT isOwner FROM gallery_user_rolle JOIN image ON gallery_user_rolle.gallery_galleryId = image.gallery_galleryId WHERE user_userId = ? AND imageId = ?");
        $stmt->bind_param('ii', $userId, $imageId);
        if ($stmt->execute()) {
            $results = $stmt->get_result();
            if ($results->num_rows === 0) {
                return null;
            } else {
                return $results->fetch_assoc()["isOwner"];
            }
        }
    }

    public function getOwnGalleries($userId)
    {
        return $this->getRelatedGalleries($userId, 1);
    }

    public function getRelatedGalleries($userId, $isOwnerRelationship)
    {
        $stmt = $this->db->prepare("SELECT gallery_galleryId, name FROM imagedb.gallery_user_rolle JOIN imagedb.gallery ON gallery_user_rolle.gallery_galleryId = gallery.galleryId WHERE user_userId  = ? AND isOwner = ?");
        $stmt->bind_param('ii', $userId, $isOwnerRelationship);
        $result = array();
        if ($stmt->execute()) {
            $resultSet = $stmt->get_result();
            while ($row = $resultSet->fetch_assoc()) {
                $gId = $row["gallery_galleryId"];
                $gName = $row["name"];
                $images = $this->imageModel->readByGallery($gId);
                $result[] = new Gallery($gId, $gName, $images, $this->getOwner($gId), $this->getReadUsers($gId));
            }
            return $result;
        }
        return null;
    }

    public function getOwner($galleryId)
    {
        $stmt = $this->db->prepare("SELECT user_userId FROM imagedb.gallery_user_rolle WHERE gallery_galleryId = ? AND isOwner = 1");
        $stmt->bind_param('i', $galleryId);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $userId = $result["user_userId"];
            return $this->userModel->readById($userId);
        }
        return null;

    }

    public function getReadUsers($galleryId)
    {
        $stmt = $this->db->prepare("SELECT user_userId FROM imagedb.gallery_user_rolle WHERE gallery_galleryId = ? AND isOwner = 0");
        echo $this->db->error;
        $stmt->bind_param('i', $galleryId);
        $results = array();
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $results[] = $this->userModel->readById($row["user_userId"]);
            }
            return $results;
        } else echo $stmt->error;
        return null;
    }

    public function getReadGalleries($userId)
    {
        return $this->getRelatedGalleries($userId, 0);
    }

    public function grantReadAccess($userId, $galleryId)
    {
        return $this->grantAccess($userId, $galleryId, 0);
    }

    private function grantAccess($userId, $galleryId, $isOwner)
    {
        $stmt = $this->db->prepare("INSERT INTO imagedb.gallery_user_rolle (isOwner, user_userId, gallery_galleryId) VALUES (?, ?,?)");
        $stmt->bind_param('iii', $isOwner, $userId, $galleryId);
        return $stmt->execute();
    }

    public function setOwner($userId, $galleryId)
    {
        return $this->grantAccess($userId, $galleryId, true);

    }
}