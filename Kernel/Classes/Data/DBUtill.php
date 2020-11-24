<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Data;

use Kernel\Classes\Security\FileSystem;

class DBUtill extends FileSystem
{
    protected const Configuration = 'Kernel/Classes/Data/.dbAccess.c';

    public $HOSTNAME = 'HOSTNAME';
    public  $USERNAME = 'USERNAME';
    public  $PASSWORD = 'PASSWORD';
    public  $DATABASE = 'DATABASE';

    public function __construct()
    {

        $Config = $this::readFile(self::Configuration);
        $unJson = json_decode($Config, true);
        foreach ($unJson as $json){
            foreach ($json as $jsn){
                $this->HOSTNAME = $jsn[$this->HOSTNAME];
                $this->USERNAME = $jsn[$this->USERNAME];
                $this->PASSWORD = $jsn[$this->PASSWORD];
                $this->DATABASE = $jsn[$this->DATABASE];
                return true;
            }
        }
        return false;
    }




}
