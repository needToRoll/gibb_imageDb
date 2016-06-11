<?php
require_once "DatabaseInterface.php";
require_once "entities/Tag.php";
require_once "Model.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:30
 */
class TagModel extends Model implements DatabaseInterface

{
    public function readByImage($imageId)
    {
        $stmt = $this->db->prepare("SELECT tag.tagId FROM tag JOIN image_tag ON tag.tagId = image_tag.tag_tagId WHERE image_imageId = ?");
        echo $this->db->error;
        $stmt->bind_param("i", $imageId);
        $result = array();
        if ($stmt->execute()) {
            $stmtResult = $stmt->get_result();

            while ($row = $stmtResult->fetch_assoc()) {
                $result[] = $this->readById($row['tagId']);
            }
        } else {
            echo $stmt->error;
        }
        return $result;
    }

    /**
     * @param $id
     * @return Tag
     */
    public function readById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM imagedb.tag WHERE tagId = ?');
        echo $this->db->error;
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            return new Tag($result['tagId'], $result['name']);
        } else {
            echo $stmt->error;
        }
        return null;

    }

    /**
     * @param $object Tag
     * @return Tag
     */
    public function save($object)
    {
        return $this->create($object->getId(), $object->getName());

    }

    public function create($imageId, $tagName)
    {
        $stmt = $this->db->prepare("INSERT INTO imagedb.tag (name) VALUES (?)");
        $stmt->bind_param('s', $tagName);
        if ($stmt->execute()) {
            $tagId = $this->db->insert_id;
            $statement = $this->db->prepare("INSERT INTO imagedb.image_tag (image_imageId, tag_tagId) VALUES (?,?)");
            $statement->bind_param('ii', $imageId, $tagId);
            if ($statement->execute()) {
                return new Tag($tagId, $tagName);
            }
        }
    }

    public function readAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM imagedb.tag');
        $result = array();
        if ($stmt->execute()) {
            while ($row = $stmt->get_result()->fetch_assoc())
                $result[] = new Tag($row['tagId'], $row['name']);
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
        $stmt->bind_param(":id", $id);
        return $stmt->execute();
    }
}