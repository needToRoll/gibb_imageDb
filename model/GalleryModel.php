<?php
require_once "/model/Model.php";
require_once "/model/ImageModel.php";
require_once "/model/entities/Gallery.php";
require_once "DatabaseInterface.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:26
 */
class GalleryModel extends Model implements DatabaseInterface
{

    private $imageModel;
    private $accessModel;


    /**
     * GalleryModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->imageModel = new ImageModel();
        $this->accessModel = new AccessModel();
    }

    /**
     * @param $object Gallery
     * @return Gallery
     */
    public function save($object)
    {
        return $this->create($object->getName(), $object->getOwner(), $object->getImages(), $object->getReadUsers());
    }

    /**
     * @param $name
     * @param $owner User
     * @param array $images Image
     * @param array $readers Users
     * @return Gallery
     */
    public function create($name, $owner, $images = array(), $readers = array())
    {
        $stmt = $this->db->prepare("INSERT INTO imagedb.gallery (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        if ($stmt->execute()) {
            $galleryId = $this->db->insert_id;
            $this->accessModel->setOwner($owner->getId(), $galleryId);

            foreach ($readers as $reader) {
                $userId = $reader->getId();
                $this->accessModel->grantReadAccess($userId, $galleryId);
            }

            foreach ($images as $image) {
                $image->setId($galleryId);
                $this->imageModel->save($image);
            }
            return new Gallery($galleryId, $name, $images, $owner, $readers);
        } else {
            echo $stmt->error;
        }

    }

    public function readById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM imagedb.gallery WHERE galleryId = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            if ($row = $stmt->get_result()->fetch_assoc()) {
                $id = $row["galleryId"];
                $name = $row["name"];
                $readers = $this->accessModel->getReadUsers($id);
                $owner = $this->accessModel->getOwner($id);
                $images = $this->imageModel->readByGallery($id);
                return new Gallery($id, $name, $images, $owner, $readers);
            }

        }
    }

    public function readByUser($userId)
    {
        return $this->accessModel->getOwnGalleries($userId);
    }

    public function readAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM imagedb.gallery");
        $results = array();
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $id = $row["galleryId"];
                $name = $row["name"];
                $readers = $this->accessModel->getReadUsers($id);
                $owner = $this->accessModel->getOwner($id);
                $images = $this->imageModel->readByGallery($id);
                $results[] = new Gallery($id, $name, $images, $owner, $readers);
            }
        }
    }

    public function update($id,$column,$newValue)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM imagedb.gallery WHERE galleryId = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        }
    }

}