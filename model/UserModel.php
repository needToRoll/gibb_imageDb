<?php
require_once "entities/User.php";
require_once "Model.php";
require_once "DatabaseInterface.php";


/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:23
 */
class UserModel extends Model implements DatabaseInterface
{

    /**
     * @param $object User
     * @return User
     */

    public function save($object)
    {
        return $this->create($object->getUsername(), $object->getMail(), $object->getPw(), $object->getIsAdmin());
    }

    public function create($username, $mail, $pw, $isAdmin)
    {
        $stmt = $this->db->prepare('INSERT INTO user (username, mail, password, isAdmin) VALUES (?,?,?,?)');
        $stmt->bind_param('sssi', $username, $mail, $pw, $isAdmin);
        if ($stmt->execute()) {
            $id = $this->db->insert_id;
            return new User($id, $username, $mail, $pw, $isAdmin);
        }
        print $stmt->error;
        return null;
    }

    public function readById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM USER WHERE userId = ?');
        $stmt->bind_param("s", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            return new User($id, $result["username"], $result["mail"], $result["password"], $result['isAdmin']);
        } else {
            return null;
        }


    }

    public function readAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM USER');
        $stmt->execute();
        $output = array();
        while ($row = $stmt->get_result()->fetch_assoc()) {
            $output[] = new User($row["userId"], $row["username"], $row["mail"], $row["password"], $row['isAdmin']);
        }
        return $output;
    }

    public function update($id,$column,$newValue)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM User WHERE userId = :id');
        $stmt->bind_param(":id", $id);
        return $stmt->execute();
    }

    public function checkLogin($username, $pw)
    {
        $stmt = $this->db->prepare('SELECT userId, password FROM imagedb.user WHERE mail = ? OR username = ?');
        $stmt->bind_param("ss", $username, $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            if (password_verify($pw, $result["password"])) {
                return $result["userId"];
            }
        }
        echo $stmt->error;
        return -1;
    }
}