<?php
include_once(dirname(__FILE__)."/../classes/Controller.php");
include_once(dirname(__FILE__)."/../classes/JsonError.php");

class ApiNotFoundController implements Controller
{
    public function exec($regexMatch, $url)
    {
        (new JsonError(404,"Api endpoint not found"))->send();
    }

}