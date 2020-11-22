<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 20/11/2020 - 23:37
 */
namespace Kernel\Classes\Actions\Plans;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Data\Objects\PlansToObject;
use Kernel\Classes\DataOperations\JSON;

class InitPlans extends Mysql
{

    private $planToObject;

    public function __construct()
    {
        parent::__construct();
        $this->planToObject = new PlansToObject();
    }
    public function getPlans(){
        $json = new JSON();
        $json::setJsonHeader();
        $Result = $this->planToObject->getAll();
        foreach ($Result as $Plans){
            echo $json->PrettyConverter($Plans);
        }
    }
}