<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:30
 */
class TagModel extends Model implements DatabaseInterface

{
    public function create($imageId,$tagName)
    {
        $stmt = $this->db->prepare("INSERT INTO imagedb.tag (name) VALUES (?)");
        $stmt->bind_param('s',$tagName);
        if($stmt->execute()){
            $tagId = $this->db->insert_id();
            $statement = $this->db->prepare("INSERT INTO imagedb.image_tag (image_imageId, tag_tagId) VALUES (?,?)");
            $statement->bind_param('ii',$imageId,$tagId);
            if($statement->execute()){
                return new Tag($tagId,$tagName);
            }
        }
    }

    public function readByImage($imageId)
    {
        $stmt = $this->db->prepare("SELECT image_imageId FROM imagedb.image_tag WHERE image_imageId = :id");
        $stmt->bind_param(":id", $imageId);
        $result = array();
        if ($stmt->execute()) {
            while ($row = $stmt->get_result()->fetch_assoc()) {
                $result[] = $this->readById($row['image_imageId']);

            }
        }
    }

    /**
     * @param $object Tag
     * @return Tag
     */
    public function save($object)
    {
        return $this->create($object->getId(), $object->getName());

    }

    /**
     * @param $id
     * @return Tag
     */
    public function readById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM imagedb.tag where tagId = :id');
        $stmt->bind_param(":id",$id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            return new Tag($result['tagId'],$result['name']);
        }
        return null;

    }

    public function readAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM imagedb.tag');
        $result = array();
        if ($stmt->execute()) {
            while($row = $stmt->get_result()->fetch_assoc())
            $result[] =  new Tag($row['tagId'],$row['name']);
        }
        return $result;

    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM imagedb.tag WHERE tagId = :id");
        $stmt->bind_param(":id",$id);
        return $stmt->execute();
    }
}