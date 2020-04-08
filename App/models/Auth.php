<?php
namespace App\models;
use App\models;
use App\models\mail\libmail;

class Auth
{
    private $timeToDestroy = "1 month";

    public function enter($array)
    {
        $email = strtolower(trim($_POST["email"]));
        $pass = $_POST["pass"];

        if(!$email || !$pass){ throw new \Exception("E-mail и пароль должны быть заполнены!");}
        if(!TextSecurity::is_email($email)){ throw new \Exception("Не корректный E-mail!");}

        //проверка на существование пользователя в БД

        $DB = new DB();
        $resUser = $DB->get_row("SELECT * FROM users WHERE email = '".$email."'", true);
        if(!$resUser)
        {
            return $this->register($email, $pass);
        }

        //Сверим данные
        //1. Подтвердил ли пользователь свой email?
        if(!$resUser["confirm_email"]){ throw new \Exception("Ожидается подтверждения email");}

        //2. Авторизуем, если пароль верен
        if(!password_verify($pass, $resUser["pass"])){ throw new \Exception("Не верный пароль");}

        //авторизуем
        return $this->setAuth($resUser["ID"], $resUser["token"]);

    }

    public function setAuth($user_id, $token)
    {
        if(!$token){ $token = md5(time().rand());}
        setcookie("user_id", $user_id, strtotime($this->timeToDestroy), "/");
        setcookie("token", $token, strtotime($this->timeToDestroy), "/");

        $res = ["type" => "auth", "status" => true, "data" > ["user_id" => $user_id]];
        return $res;


    }

    public  function register($email, $pass)
    {
        // 1. Записываем в БД

        $arr = [
            "date" => time(),
            "email" => $email,
            "pass" => password_hash($pass, PASSWORD_DEFAULT),
            "token" => md5(time().rand())
        ];

        $DB = new DB();
        $resInsert = $DB->insert("users", $arr, true);

        // 2. Подготавливаем информацию
        $PATH = new Path();
        $body = file_get_contents("App/views/mail/confirm_email.php");
        $body = str_replace(["{{clear_url}}", "{{token}}"], [$PATH->clear_url()."/", $arr["token"]], $body);

        // 3. Отправляем письмо

        $M = new libmail("utf-8");
        //$M->From( "**mail" );
       //$M->smtp_on("smtp.yandex.ru","**mail","**pass");
        $M->To($email);
        $M->Subject("Подтверждение регистрации");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if($M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }

        $res = ["type" => "register", "status" => true];
        return $res;
    }
}