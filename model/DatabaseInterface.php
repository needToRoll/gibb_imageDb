<?php

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 04.06.2016
 * Time: 22:56
 */
interface DatabaseInterface
{


    public function save($object);

    public function readById($id);

    public function readAll();

    public function update($object);

    public function delete($id);


}