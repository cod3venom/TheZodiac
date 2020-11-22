<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 20/11/2020 - 16:31
 */

namespace Kernel\Classes\Actions\SubUsers;


use Kernel\Classes\Data\MySql;
use Kernel\Classes\Data\Objects\PersonWorldToObject;
use Kernel\Classes\DataOperations\JSON;

class InitPersonWorlds extends MySql
{
    private $World;

    public function __construct()
    {
        parent::__construct();
        $this->World = new PersonWorldToObject();
    }
    public function Exists($param){

    }
    public function Add(){

    }
    public function Update(){

    }
    public function Delete(){

    }
    public function getByPersonid(){

    }
    public function getAllByOwner(){
        $json = new JSON();
        $this->World->setUserId($_SESSION['USER_ID']);
        $Result = $this->World->getAllByOwner();
        $json::setJsonHeader();
        foreach ($Result as $data){
            echo $json->PrettyConverter($data);
        }
    }
    public function getAllSubUserStack(){
        $json = new JSON();
        $this->CreateStatement(26);
        $this->stmt->bind_param('s',$_SESSION['USER_ID']);
        $Result = $this->Select();
        $json::setJsonHeader();
        foreach ($Result as $Persons){
            echo $json->PrettyConverter($Persons);
        }
    }
}