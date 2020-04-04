<?php

require_once("vendor/autoload.php");

$DB = new \App\models\DB();



try{

   //$resInsert = $DB->insert("forTest", ["title" => "Description3", "date" => time()]);
   //$DB->connect();
     $resInsert = $DB->get_rows("SELECT * FROM forTest WHERE ID = 1");
     $c;
}
catch (Exception $e)
{
    echo $e->getMessage();
}



$c;