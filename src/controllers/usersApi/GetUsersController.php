<?php
include_once(dirname(__FILE__)."/../../classes/Controller.php");
include_once(dirname(__FILE__)."/../../models/UserModel.php");

class GetUsersController implements Controller
{
    public function exec($regexMatch, $url)
    {
        $users = UserModel::findAll();
        header('Content-Type: application/json');
        echo json_encode($users);
    }
}