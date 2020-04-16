<?php


namespace App\models;

use App\models\mail\libmail;
use mysql_xdevapi\Exception;


class Invite
{
    public function __construct()
    {
        $this->DB = new DB();
    }

    public function get($array)
    {
        $O = new InviteGet();
        return $O->get($array);
    }

    public function create($array)
    {
        $email = TextSecurity::is_email($array["email"]);
        if (!$email) {
            throw new \Exception("Не корректный параметр email");
        }

        $me = $_COOKIE["user_id"];

        //собитраем информация про owner

        $P = new Profile();
        $ownerInfo = $P->get(["m" => 1]);

        // собираем информацию про user with email
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $userInfo = $this->DB->get_row($sql);

        // была ли такая запись

        $sql = "SELECT * FROM invites WHERE (from_user_id = " . $me . " AND for_email = '" . $email . "')";
        if ($userInfo) {
            $sql .= " OR (from_user_id = " . $userInfo["id"] . " AND for_email = '" . $ownerInfo["email"] . "')";
        }

        $resItem = $this->DB->get_row($sql);
        if ($resItem) {
            throw new \Exception("Приглашение не требуется");
        }

        //создадим приглашение

        $arr = [
            "date" => time(),
            "for_email" => $email,
            "from_user_id" => $me,
        ];

        $this->DB->insert("invites", $arr);

        // Отправка письма
        $PATH = new Path();
        $viewUrl = ($userInfo) ? "App/views/mail/invite1.php" : "App/views/mail/invite2.php";
        $body = file_get_contents($viewUrl);
        $body = str_replace(["{{owner_nickname}}", "{{clear_url}}"], [$ownerInfo["nickname"], $PATH->clear_url()], $body);

        $M = new libmail("utf-8");
        //$M->From( "**mail" );
        //$M->smtp_on("smtp.yandex.ru","**mail","**pass");
        $M->To($email);
        $M->Subject("Приглашение");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if (!$M->status_mail["status"]) {
            throw new \Exception($M->status_mail["message"]);
        }

        return true;

    }

}