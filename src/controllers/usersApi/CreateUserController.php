<?php
include_once(dirname(__FILE__)."/../../classes/Controller.php");
include_once(dirname(__FILE__)."/../../classes/JsonError.php");
include_once(dirname(__FILE__)."/../../models/UserModel.php");

class CreateUserController implements Controller
{
    public function exec($regexMatch, $url)
    {
        header('Content-Type: application/json');

        if(!isset($_POST["username"]) ||
            !isset($_POST["email"]) ||
            !isset($_POST["role"]) ||
            !isset($_POST["status"])){
            (new JsonError(400,"A user needs a username, an email, a role and a status"))
                ->send();
            die();
        }

        $newUser = new UserModel($_POST["username"],$_POST["email"],$_POST["role"],(int) $_POST["status"]);
        $newUser->save();

        echo json_encode(["ok"=>true]);
    }

}