<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Security;

use Kernel\Classes\Security\Restrictions;

class FileSystem extends Restrictions
{

    public function readFile($path)
    {
        if(file_exists($path)){
            return file_get_contents($path);
        }else{
            echo $path;
        }
        return false;
    }



}