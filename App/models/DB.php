<?php


namespace App\models;


class DB
{
    private $connect_settings = [
        "host" => "127.0.0.1",
        "user" => "root",
        "pass" => null,
        "db_name" => "taskManager"
    ];

    private $db_connect;

    public function __construct($connect_settings = null)
    {
        if (!is_null($connect_settings)) {
            $this->connect_settings = $connect_settings;
        }
    }

    public function connect()
    {
        if ($this->db_connect instanceof \mysqli && $this->db_connect->ping()) {
            return true;
        }

        $resConnect = new \mysqli($this->connect_settings["host"], $this->connect_settings["user"], $this->connect_settings["pass"], $this->connect_settings["db_name"]);
        if ($resConnect->connect_error) {
            throw new \Exception($resConnect->connect_error);
        }

        $this->db_connect = $resConnect;
    }

    private function disconnect()
    {
        if ($this->db_connect instanceof \mysqli && $this->db_connect->ping()) {
            $this->db_connect->close();
        }
    }

    /**
     * @param $tableName - название таблицы
     * @param $arrValues
     * @param bool $close
     * @return $this
     * @throws \Exception
     */


    public function insert($tableName, $arrValues, $close = false)
    {
        $this->connect();

        $cols = array_keys($arrValues);
        $sql = "INSERT INTO ".$tableName." (".implode(",", $cols).") VALUES ('".implode("','", $arrValues)."')";

        $resQuery = $this->db_connect->query($sql);
        if(!$resQuery){
            throw new \Exception($this->db_connect->error);
        }
        if($close){
            $this->disconnect();
        }

        return $this;

    }

    public function delete ($table, $where, $close = false)
    {
        $this->connect();
        $sql = "DELETE FROM ".$table." WHERE ".$where;
        $resQuery = $this->db_connect->query($sql);
        if(!$resQuery){
            throw new \Exception($this->db_connect->error);
        }

        if($close){
            $this->disconnect();
        }

        return $this;

    }

    public function update($tableName, $arrValues, $where, $close = false)
    {
        $this->connect();

        $forSql = [];
        foreach ($arrValues as $key => $value){
            $forSql[] = $key."='".$value."'";
        }

        $sql = "UPDATE ".$tableName." SET ".implode(",", $forSql)." WHERE ".$where;

        $resQuery = $this->db_connect->query($sql);
        if(!$resQuery){
            throw new \Exception($this->db_connect->error);
        }
        if($close){
            $this->disconnect();
        }

        return $this;

    }

    public function get_row($sql, $close = false)
    {
        $this->connect();

        $resQuery = $this->db_connect->query($sql);
        if(!$resQuery){
            throw new \Exception($this->db_connect->error);
        }

        if($resQuery->num_rows > 0)
        {
            $result = $resQuery->fetch_assoc();
            if($close){$this->disconnect();}
            return $result;
        }
        else{
            if($close){ $this->disconnect(); }
            return false;
        }
    }

    public function get_rows($sql, $close = false)
    {
        $this->connect();

        $resQuery = $this->db_connect->query($sql);
        if(!$resQuery){
            throw new \Exception($this->db_connect->error);
        }

        if($resQuery->num_rows > 0)
        {
            $result = $resQuery->fetch_all(MYSQLI_ASSOC);
            if($close){$this->disconnect();}
            return $result;
        }
        else{
            if($close){$this->disconnect();}
            return false;
        }






    }
}