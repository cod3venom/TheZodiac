<?php


namespace Kernel\Classes\Security;
use Kernel\Classes\Security\Antihacker;


class Route
{
    private static $GET;
    private static $POST;
    private static $STACK = array();

    public static function isDefault(){
        if(empty($_GET)){
            return true;
        }
    }
    public static function LoginPage(){
        if(isset($_GET["SignIn"])){
            return true;
        }
    }
    public static function GET($key){
        if(isset($_GET[$key])){
            self::$STACK[$key] = $_GET[$key];
            return true;
        }
        return false;
    }

    public static function POST($key){
        if(isset($_POST[$key])){
            self::$STACK[$key] = $_POST[$key];
            return true;
        }
        return false;
    }

    public static function ReadGet($key){
        return self::$STACK[$key];
    }

    public static function ReadPost($key){
        return self::$STACK[$key];
    }



}