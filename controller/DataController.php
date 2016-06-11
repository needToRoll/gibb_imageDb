<?php
require_once "/model/AccessModel.php";

/**
 * Created by PhpStorm.
 * User: bbuerf
 * Date: 11.06.2016
 * Time: 18:05
 */
class DataController
{
    private $accessModel;

    /**
     * DataController constructor.
     */
    public function __construct()
    {
        $this->accessModel = new AccessModel();
    }

    public function __call($name, $arguments)
    {
        print_r($arguments);
        if (!isset($_SESSION["userId"]) or $_SESSION["userId"] == -1) {
            header("Location: /");
        } else {
            $requestString = join("/", $arguments[0]);
            $requestString = "data/uploaded/$requestString";
            if ($this->accessModel->getAccessByRequestedFile("/" . $requestString, $_SESSION["userId"])) {
                header("Content-Type: " . mime_content_type($requestString));
                header("Content-Length: " . filesize($requestString));
                ob_clean();
                flush();
                readfile($requestString);
                exit;
            }
        }
    }

}