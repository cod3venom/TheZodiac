<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Markup;

use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Security\FileSystem;


class HTML extends Restrictions
{
    private $fSys;
    public function __construct(){
        $this->fSys = new FileSystem();
    }

    public function Load($name){
        @ob_clean();
        @ob_flush();
        $path = $this::HTML_MAIN.$name.'.html';
        if(file_exists($path)){
            return $this->fSys->readFile($path);
        }else{
            $path = $this::HTML_AUTH.$name.'.html';
            if(file_exists($path)){
                return $this->fSys->readFile($path);
            }else{
                $path = $this::HTMLPROFILE.$name.'.html';
                if(file_exists($path)){
                    return $this->fSys->readFile($path);
                }else{
                    $path = $this::HTML_CUSTOM.$name.'.html';
                    if(file_exists($path)){
                        return $this->fSys->readFile($path);
                    }
                }
            }
        }
    }
}