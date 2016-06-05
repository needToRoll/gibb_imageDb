<?php
require "entities\\User.php";
require "Model.php";
/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 26.05.2016
 * Time: 13:23
 */
class UserModel extends Model implements DatabaseInterface
{

    public function create($username, $mail,$pw)
    {
        $stmt = $this->db->prepare('INSERT INTO user (username, email, password) VALUES (?,?,?)');
        $stmt->bindParam('sss', $username,$mail,$pw);
        $stmt->execute();
        $id = $this->db->insert_id();

        return new User($id, $username, $mail, $pw);
    }

    /**
     * @param $object User
     * @return User
     */

    public function save($object)
    {
        return $this->create($object->getUsername(),$object->getMail(),$object->getPw());
    }

    public function readById($id)
    {
        $stmt = $this->db->prepare('SELECT * from USER WHERE userId = :id');
        $stmt->bind_param(":id", $id);
        if($stmt->execute()){
            $result = $stmt->get_result()->fetch_assoc();
            return new User($this->db->insert_id(), $result["username"], $result["mail"], $result["password"],False);
        } else {
            return null;
        }


    }

    public function readAll()
    {
        $stmt= $this->db->prepare('select * from USER');
        $stmt->execute();
        $output = array();
        while($row = $stmt->get_result()->fetch_assoc()){
            $output[] = new User($row["userId"],$row["username"], $row["mail"], $row["password"],false);
        }
        return $output;
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('Delete From User where userId = :id');
        $stmt->bind_param(":id",$id);
        return $stmt->execute();
    }
}