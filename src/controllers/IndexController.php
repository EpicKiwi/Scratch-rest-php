<?php
include_once(dirname(__FILE__)."/../classes/Controller.php");

class IndexController implements Controller
{
    public function exec($regexMatch, $url)
    {
        include dirname(__FILE__)."/../views/index.php";
    }

}