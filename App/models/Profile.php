<?php


namespace App\models;



use App\models\DB;
use App\models\TextSecurity;
use App\models\Path;
use App\models\SimpleImage;
use App\models\ProfileGet;

class Profile
{
    private $DB;
    private $avatarPath;

    public function __construct()
    {
        $this->DB = new DB();
        $this->Path = new Path();
        $this->avatarPath = $this->Path->clear_path()."/resources/FILES";
    }

    public function get($array)
    {
        $O = new ProfileGet();
        return $O->get($array);
    }

    public function edit($array)
    {
        $nickname = TextSecurity::shield_hard($array["nickname"]);
        $text = TextSecurity::shield_medium($array["text"]);
        $inputName = (!$array["input_name"])? "avatar" : $array["input_name"];
        $me = $_COOKIE["user_id"];

        // сбор информации про пользователя
        $sql = "SELECT * FROM users WHERE id = ".$me;
        $resItem = $this->DB->get_row($sql);

        // Если есть файл
        if($_FILES[$inputName]["tmp_name"])
        {
            $this->checkDir();
            $avatarName = md5(time().rand()).".jpg";

            $img = new SimpleImage($_FILES[$inputName]["tmp_name"]);
            $img->best_fit(600, 600)->save($this->avatarPath."/big/".$avatarName);
            $img->best_fit(200, 200)->save($this->avatarPath."/small/".$avatarName);

            //Удалим старую фотографию
            if($resItem["avatar"])
            {
                if (file_exists($this->avatarPath."/big/".$resItem["avatar"])){ unlink($this->avatarPath."/big/".$resItem["avatar"]);}
                if (file_exists($this->avatarPath."/small/".$resItem["avatar"])){ unlink($this->avatarPath."/small/".$resItem["avatar"]);}
            }

        } else
        {
            $avatarName = $resItem["avatar"];
        }
        // запись в БД
        $arr = [
            "nickname" => $nickname,
            "text" => $text,
            "avatar" => $avatarName,
        ];
        $res = $this->DB->update("users", $arr, "id = ".$me, true);

        //response
        return $arr;


    }

    public function delete($user_id = null)
    {
        $user_id = (!is_numeric($user_id)) ? $_COOKIE["user_id"] : $user_id;
        $resItem = $this->DB->get_row("SELECT avatar FROM users WHERE id =" . $user_id);

        //delete avatar

        if ($resItem["avatar"]) {
            if (file_exists($this->avatarPath . "/big/" . $resItem["avatar"])) {
                unlink($this->avatarPath . "/big/" . $resItem["avatar"]);
            }
            if (file_exists($this->avatarPath . "/small/" . $resItem["avatar"])) {
                unlink($this->avatarPath . "/small/" . $resItem["avatar"]);
            }
        }

        //delete user
        $this->DB->delete("users", "id =" . $user_id, true);
        return true;

    }

    private function checkDir()
    {
        if(!is_dir($this->avatarPath."/big")){ mkdir($this->avatarPath."/big", null, true);}
        if(!is_dir($this->avatarPath."/small")){ mkdir($this->avatarPath."/small", null, true);}
    }
    
}