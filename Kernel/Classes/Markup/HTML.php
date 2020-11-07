<?php


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
        $path = $this::HTML_FOLDER.$name.'.html';
        if(file_exists($path)){
            return $this->fSys->readFile($path);
        }
    }
}