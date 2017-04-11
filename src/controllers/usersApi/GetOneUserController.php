<?php
include_once(dirname(__FILE__)."/../../classes/Controller.php");
include_once(dirname(__FILE__)."/../../classes/JsonError.php");
include_once(dirname(__FILE__)."/../../models/UserModel.php");

class GetOneUserController implements Controller
{
    public function exec($regexMatch, $url)
    {
        $user = UserModel::findOne($regexMatch[0]);
        if($user != null) {
            header('Content-Type: application/json');
            echo json_encode($user);
        } else {
            (new JsonError(404,"User $regexMatch[0] not found"))
                ->send();
        }
    }

}