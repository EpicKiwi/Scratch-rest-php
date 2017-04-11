<?php
include_once(dirname(__FILE__)."/../classes/Controller.php");

class NotFoundController implements Controller
{
    public function exec($regexMatch, $url)
    {
        http_response_code(404);
        echo "Aucune adresse pour $url";
    }

}