<?php
include_once "classes/Route.php";
include_once "controllers/IndexController.php";
include_once "controllers/NotFoundController.php";
include_once "controllers/usersApi/GetUsersController.php";
include_once "controllers/usersApi/GetOneUserController.php";
include_once "controllers/usersApi/CreateUserController.php";
include_once "controllers/usersApi/ModifyUserController.php";
include_once "controllers/usersApi/DeleteUserController.php";
include_once "controllers/ApiNotFoundController.php";

include_once "classes/config.php";
include_once "classes/singleton.php";

$routes = [
    new Route("#^/$#",new IndexController(),"GET",0),
    new Route("#^/api/users$#",new GetUsersController(),"GET",0),
    new Route("#^/api/users$#",new CreateUserController(),"POST",0),
    new Route("#^/api/users/(\\d+)$#",new GetOneUserController(),"GET",1),
    new Route("#^/api/users/(\\d+)$#",new ModifyUserController(),"PUT",1),
    new Route("#^/api/users/(\\d+)$#",new DeleteUserController(),"DELETE",1),
    new Route("#^/api.*#",new ApiNotFoundController(),"ALL",0),
    new Route("#.*#",new NotFoundController(),"ALL",0),
];

parse_str(file_get_contents("php://input"),$tmp_body);
$GLOBALS["body"] = $tmp_body;
$page = $_GET['$p'];
if($page != "/"){
    preg_replace("#/$#","",$_GET['$p']);
}

foreach ($routes as $route){
    $res = $route->match($page);
    if($res){
        if($route->getExpectedParameters() > 0) {
            $route->getController()->exec($res[1], $page);
        } else {
            $route->getController()->exec([], $page);
        }
        break;
    }
}