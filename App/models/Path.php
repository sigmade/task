<?php
namespace App\models;


class Path{

    /**
     * Вывод чистого uri пути
     * @return string
     */
    public function clear_path(){
        //Правильнее будет сделать так:

        $DS         = DIRECTORY_SEPARATOR;
        $nameSpace  = (__NAMESPACE__)? str_replace("\\",$DS,__NAMESPACE__) : null;
        $path       = strstr(__DIR__, $DS.$nameSpace, true);
        $res        = ($path)? $path : __DIR__;
        return $res;



        //return strstr(__DIR__, "\\".__NAMESPACE__, true); - старый вариант, могут возникать проблемы, на системах unix
    }

    /**
     * Вывод читого URL
     * @return string
     */
    public function clear_url($dir = null){
        return "http://". $_SERVER["HTTP_HOST"].$dir;
    }

    /**
     * Вывод адреса страницы без GET
     * @return string
     */
    public function withoutGet(){

        if($res = strstr($this->clear_url().$_SERVER["REQUEST_URI"], "?", true))
        {
            return $res;
        }
        else
        {
            return  $this->clear_url().$_SERVER["REQUEST_URI"];
        }

//        return  strstr($this->path_clear_url().$_SERVER["REQUEST_URI"], "?", true);
    }

    public function fullUrl()
    {
        return  $this->clear_url().$_SERVER["REQUEST_URI"];
    }

    public function parse()
    {
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_parts = explode("/", trim($url_path, ' /'));
        $uri_parts = array_filter($uri_parts);

        if(count($uri_parts)){ $_GET["c"] = array_shift($uri_parts); }
        if(count($uri_parts)){ $_GET["method"] = array_shift($uri_parts); }
        if(count($uri_parts))
        {
            for ($i = 0; $i < count($uri_parts); $i++):
                $key = $uri_parts[$i];
                if ($val = $uri_parts[++$i])
                {
                    $_GET[$key] = $val;
                }
            endfor;
        }
    }




}