<?php

namespace Kernel\Classes\Data;

use Kernel\Classes\Security\FileSystem;
use Kernel\Classes\Security\Restrictions;

class QueryFactory extends FileSystem
{
    private $restriction;
    public function __construct(){
        $this->restriction = new Restrictions();
    }


    public function QueryFactory($num)
    {
        $Content = $this->readFile($this->restriction::QUERIES);
        if(strpos($Content, $this->restriction::NEWLINE)!==false && strpos($Content, $this->restriction::DOLLAR)){
            $Lines = explode($this->restriction::NEWLINE,$Content);
            for ((int)$i=0; $i < count($Lines);$i++){
                $stack = explode($this->restriction::DOLLAR,$Lines[$i]);
                if((int)$stack[0] === (int)$num){
                    return $stack[1];
                }
            }
        }

    }

}