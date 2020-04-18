<?php

require_once("vendor/autoload.php");
$Auth = new \App\models\Auth();
$Path = new \App\models\Path();

$Path->parse();

if ($Auth->check_auth()) {
    $Badge = new \App\models\Badge();
    $Badges = $Badge->getAll();

}

if($_GET["c"] && file_exists("App/controllers/".$_GET["c"].".php"))
{
    include("App/controllers/".$_GET["c"].".php");
}
else
{
    include("App/controllers/main.php");
}




