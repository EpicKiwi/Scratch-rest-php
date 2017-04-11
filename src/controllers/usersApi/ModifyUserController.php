<?php
include_once(dirname(__FILE__)."/../../classes/Controller.php");
include_once(dirname(__FILE__)."/../../classes/JsonError.php");
include_once(dirname(__FILE__)."/../../models/UserModel.php");

class ModifyUserController implements Controller
{
    public function exec($regexMatch, $url)
    {
        $user = UserModel::findOne($regexMatch[0]);
        if($user != null) {
            $BODY = $GLOBALS["body"];
            if(isset($BODY["username"])){
                $user->setUsername($BODY["username"]);
            }
            if(isset($BODY["email"])){
                $user->setEmail($BODY["email"]);
            }
            if(isset($BODY["role"])){
                $user->setRole($BODY["role"]);
            }
            if(isset($BODY["status"])){
                $user->setStatus((int) $BODY["status"]);
            }
            $user->save();
            header('Content-Type: application/json');
            echo json_encode(["ok"=>true,"user"=>$user]);
        } else {
            (new JsonError(404,"User $regexMatch[0] not found"))
                ->send();
        }
    }

}