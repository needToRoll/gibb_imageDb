<?php
require "\\model\\Model.php";
require "\\model\\ImageModel.php";
require "\\model\\entities\\Gallery.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:26
 */
class GalleryModel extends Model implements DatabaseInterface
{

    private $imageModel;

    /**
     * GalleryModel constructor.
     */
    public function __construct()
    {
        $this->imageModel = new ImageModel();
    }

    public function create($name, $images = array(),$readers = array())
    {
        $stmt = $this->db->prepare("INSERT INTO Gallery (NAME) VALUES (?)");
        $stmt->bind_param('s',$name);
        if ($stmt->execute()) {
            $galleryId = $this->db->insert_id();
            /**
             * @var images array Image
             */
            foreach($images as $image){
                $image->setId($galleryId);
                 $this->imageModel->save($image);
            }
            return new Gallery($galleryId,$name,$images,$readers); //TODO: Implement Readers
        }

    }

    /**
     * @param $object Gallery
     * @return Gallery
     */
    public function save($object)
    {
        return $this->create($object->getName(), $object->getImages(), $object->getReadUsers());
    }

    public function readById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM GALLERY where galleryId = :id");
        $stmt->bind_param($id);
        if ($stmt->execute()) {
            
        }
    }

    public function readByUser()
    {
        //TODO: Implement readByUser() method.
    }

    public function readAll()
    {
        // TODO: Implement readAll() method.
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}