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

    public function create($username, $mail,$pw,$isAdmin)
    {
        $stmt = $this->db->prepare('INSERT INTO user (username, mail, password, isAdmin) VALUES (?,?,?,?)');
        $stmt->bindParam('sssb', $username,$mail,$pw,$isAdmin);   
        $stmt->execute();
        $id = $this->db->insert_id();

        return new User($id, $username, $mail, $pw,$isAdmin);
    }

    /**
     * @param $object User
     * @return User
     */

    public function save($object)
    {
        return $this->create($object->getUsername(),$object->getMail(),$object->getPw(),$object->getIsAdmin());
    }

    public function readById($id)
    {
        $stmt = $this->db->prepare('SELECT * from USER WHERE userId = :id');
        $stmt->bind_param(":id", $id);
        if($stmt->execute()){
            $result = $stmt->get_result()->fetch_assoc();
            return new User($id, $result["username"], $result["mail"], $result["password"],$result['isAdmin']);
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
            $output[] = new User($row["userId"],$row["username"], $row["mail"], $row["password"],$row['isAdmin']);
        }
        return $output;
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('Delee From User where userId = :id');
        $stmt->bind_param(":id",$id);
        return $stmt->execute();
    }
}