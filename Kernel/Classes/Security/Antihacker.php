<?php


namespace Kernel\Classes\Security;

use Kernel\Classes\Security\Restrictions;


class Antihacker extends Restrictions
{
    public function noPHP($value){
        if(!empty($value)){
            foreach ($this::NOT_ALLOWED_PHP as $php){
                if(strpos($value,$php) !== false){
                    $value = str_replace($php,'',$value);
                }
            }
        }
        return $value;
    }
    public function noInjection($value){
        if(!empty($value)){
            foreach ($this::NOT_ALLOWED_CHARS as $chars){
                if(strpos($value, $chars) !== false){
                    $value = str_replace($chars,'',$value);
                }
            }
        }
        return $value;
    }



    public function PostSecurityFilter(){
        foreach ($_POST as $key => $value){
            foreach ($this::HTML_ELEMENTS as $element){
                $start = '<'.$element.'>';
                $end = '</'.$element.'>';
                $except = '/>';
                if(strpos($_POST[$key], $start) !== false){
                    $_POST[$key] = str_replace($start,'',$_POST[$key]);
                }
                else if(strpos($_POST[$key], $end) !== false){
                    $_POST[$key] = str_replace($end,'',$_POST[$key]);
                }
                else if(strpos($_POST[$key], $except) !== false){
                    $_POST[$key] = str_replace($except,'',$_POST[$key]);
                }
             }
            $_POST[$key] = $this->noPHP($_POST[$key]);
            $_POST[$key] = $this->noInjection($_POST[$key]);
        }
    }

    public function GetSecurityFilter(){
        foreach ($_GET as $key => $value){
            foreach ($this::HTML_ELEMENTS as $element){
                $start = '<'.$element.'>';
                $end = '</'.$element.'>';
                $except = '/>';
                if(strpos($_GET[$key], $start) !== false){
                    $_GET[$key] = str_replace($start,'',$_GET[$key]);
                }
                else if(strpos($_GET[$key], $end) !== false){
                    $_GET[$key] = str_replace($end,'',$_GET[$key]);
                }
                else if(strpos($_GET[$key], $except) !== false){
                    $_GET[$key] = str_replace($except,'',$_GET[$key]);
                }
            }
            $_GET[$key] = $this->noPHP($_GET[$key]);
            $_GET[$key] = $this->noInjection($_GET[$key]);
        }

    }
}