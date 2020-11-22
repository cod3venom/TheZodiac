<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 22/11/2020 - 11:10
 */

namespace Kernel\Classes\Actions\SubUsers;


use Kernel\Classes\Data\Objects\PersonWorldToObject;
use Kernel\Classes\DataOperations\JSON;
use Kernel\Classes\Security\Restrictions;

class InitFilter
{
    private $World;
    private $json;
    public function __construct(){
        $this->World = new PersonWorldToObject();
        $this->json = new JSON();
    }
    public function Search($FilterBy){
        JSON::setJsonHeader();
        $this->World->setUserId($_SESSION['USER_ID']);
        $Result = $this->World->Filter($FilterBy);
        foreach ($Result as $Data){
            echo $this->json->PrettyConverter($Data);
        }
    }


}