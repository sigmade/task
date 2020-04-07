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

        return $user_id;

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


        // 2. Отправляем письмо

        $M = new libmail("utf-8");
        //$M->From( "sychyov1991@yandex.ru" );
       //$M->smtp_on("smtp.yandex.ru","sychyov1991@yandex.ru","huxnpzqswrbsscus");
        $M->To($email);
        $M->Subject("Подтверждение регистрации");
        $M->log_on(true);
        $M->Body("Test<b>Жирный текст</b>", "html");
        $M->Send();

        if($M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }

        $res = ["type" => "register", "status" => true];
        return $res;
    }
}