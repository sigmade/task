<?php


namespace App\models;


class Badge
{
    public function __construct()
    {
        $this->DB = new DB();
    }

    public function getAll()
    {
        return [
            "new_invites" => $this->new_invites(),
            "new_tasks" => $this->new_tasks(),
        ];
    }

    public function new_invites()
    {
        $me = $_COOKIE["user_id"];

        // информация про пользователя
        $sql = "SELECT * FROM users WHERE ID =" . $me;
        $resUser = $this->DB->get_row($sql);

        $sql = "SELECT COUNT(*) AS n FROM invites WHERE status = 0 AND for_email = '" . $resUser["email"] . "'";
        return $this->DB->get_row($sql)["n"];


    }

    public function new_tasks()
    {
        $me = $_COOKIE["user_id"];

        $sql = "SELECT COUNT(*) AS n FROM task WHERE status = 0 AND for_user_id = " . $me;
        return $this->DB->get_row($sql)["n"];


    }
}