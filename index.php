<?php

require_once("vendor/autoload.php");

if($_GET["c"])
{
    include("App/controllers/".$_GET["c"].".php");
}
else
{
    include("App/views/template.php");
}


   //$DB = new \App\models\DB();
   //$DB->connect();
   //$resInsert = $DB->get_rows("SELECT * FROM forTest WHERE ID = 1");

