<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\DataOperations;

class JSON
{

    public function PrettyConverter($json){
        return json_encode($json,JSON_PRETTY_PRINT);
    }
    public static function setJsonHeader(){
        header('Content-Type: application/json');
    }
}