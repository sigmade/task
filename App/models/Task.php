<?php


namespace App\models;
use App\models\TextSecurity;
use App\models\DB;
use App\models\TaskGet;


class Task
{

    public function get($array)
    {
        $O = new TaskGet();
        return $O->get($array);
    }
    
    public function create($array)
    {
        $title = $array["title"];
        $from_user_id = $_COOKIE["user_id"];
        $for_user_id = $array["for_user_id"];
        $date_deadline = (!$array["date_deadline"]) ? 0 : strtotime($array["date_deadline"]);
        $text = TextSecurity::shield_medium($array["text"]);

        // проверки

        if(!$title){ throw new \Exception(" Заголовок не может быть пустым");}
        if (!is_numeric($for_user_id)){ $for_user_id = $from_user_id;}

        // Деламем запись в БД

        $arr = [
            "from_user_id"   => $from_user_id,
            "for_user_id"    =>$for_user_id,
            "date_created"   => time(),
            "date_deadline"  => $date_deadline,
            "title"          => $title,
            "text"           => $text,
        ];

        $DB = new DB();

        return $DB->insert("task", $arr, true);

    }
}