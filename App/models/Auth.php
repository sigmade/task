<?php
namespace App\models;
use App\models;
use App\models\mail\libmail;

class Auth
{
    private $timeToDestroy = "1 month";

    /** Авторизован ли пользователь */
    public function check_auth()
    {
        if(!is_numeric($_COOKIE["user_id"]) || !$_COOKIE["token"]){ return false; }

        $token = TextSecurity::shield_hard($_COOKIE["token"]);

        $DB = new DB();
        $resDb = $DB->get_row("SELECT * FROM users WHERE ID = ".$_COOKIE["user_id"]." AND token ='".$token."'");

        if(!$resDb){ return false; }

        return $resDb["id"];
    }

    /** Деавторизация  */
    public function logout()
    {
        setcookie("user_id", '', strtotime("-1 day"), "/");
        setcookie("token", '', strtotime("-1 day"), "/");
    }

    /** Общий метод регистрации и авторизации */
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
        if(!$resUser["confirm_email"]){ throw new \Exception("Ожидается подтверждение регистрации");}

        //2. Авторизуем, если пароль верен
        if(!password_verify($pass, $resUser["pass"])){ throw new \Exception("Не верный пароль");}

        //авторизуем
        return $this->setAuth($resUser["id"], $resUser["token"]);

    }

    /** Создаем куки для авторизованного пользователя */
    public function setAuth($user_id, $token)
    {
        if(!$token){ $token = $this->newToken(); }

        setcookie("user_id", $user_id, strtotime($this->timeToDestroy), "/");
        setcookie("token", $token, strtotime($this->timeToDestroy), "/");


        $res = ["type" => "auth", "status" => true, "data" => ["user_id" => $user_id]];

        return $res;

    }

    /** Метод регистрации */
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

        if(!$M->status_mail["status"])
        {
           throw new \Exception($M->status_mail["message"]);
        }

        $res = ["type" => "register", "status" => true];
        return $res;
    }

    /** Подтвердить email  */
    public function confirm_email($token)
    {
        if(!$token){
            throw new \Exception("Не верный параметр - token"); }

        $token = TextSecurity::shield_hard($token);

        $DB = new DB();
        $resDb = $DB->get_row("SELECT * FROM users WHERE token = '".$token."'");
        if(!$resDb){
            throw new \Exception("Такой token не найден");}

        //2
        if($resDb["confirm_email"] == 1){
            throw new \Exception("Этот token уже был использован");}

        //3
        $arr = [
            "token" => $this->newToken(),
            "confirm_email" => 1
        ];

        $resUpd = $DB->update("users", $arr, "id = ".$resDb["id"]);

        //4
        return $this->setAuth($resDb["id"], $arr["token"]);



    }

    public function change_password($array)
    {
        if(!$array["new_pass1"] and $array["new_pass1"] != $array["new_pass2"])
        {
            throw new \Exception("Не верные параметры для нового пользователя");
        }

        $me = $_COOKIE["user_id"];

        $DB = new DB();
        $email= $DB->get_row("SELECT email FROM users WHERE id =".$me)["email"];
        $newPass = password_hash($array["new_pass1"], PASSWORD_DEFAULT);

        //обновим пароль
        $DB->update("users", ["pass" => $newPass], "id = ".$me, true);

        // Отправка письма
        $PATH = new Path();
        $body = file_get_contents("App/views/mail/change_password.php");
        $body = str_replace(["{{new_pass}}"], [$array["new_pass1"]], $body);

        $M = new libmail("utf-8");
        //$M->From( "**mail" );
        //$M->smtp_on("smtp.yandex.ru","**mail","**pass");
        $M->To($email);
        $M->Subject("Смена пароля");
        $M->log_on(true);
        $M->Body($body, "html");
        $M->Send();

        if(!$M->status_mail["status"])
        {
            throw new \Exception($M->status_mail["message"]);
        }

        return true;

    }

    public function changeToken()
    {
        $me = $_COOKIE["user_id"];
        $token = $this->newToken();

        $DB = new DB();
        $DB->update("users", ["token" => $token], "id= " . $me, true);

        return $this->setAuth($me, $token);

    }

    private function newToken()
    {
        return md5(time().rand());
    }
}