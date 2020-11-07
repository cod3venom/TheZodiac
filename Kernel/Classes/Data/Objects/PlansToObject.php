<?php


namespace Kernel\Classes\Data\Objects;


use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Data\Objects\UserPlanToObject;
use Kernel\Classes\Data\Objects\UserToObjectimpl;

class PlansToObject extends MySql implements UserToObjectimpl
{
    private $USER_ID;
    private $PLAN_TITLE;
    private $PLAN_DESCRIPTION;
    private $PLAN_PRICE;
    private $PLAN_TYPE;

    public function Initialize($USER_ID)
    {
        $this->CreateStatement(13);
        $this->stmt->bind_param('s',$USER_ID);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->USER_ID = $object['USER_ID'];
            $this->setPlanTitle($object['PLAN_TITLE']);
            $this->setPlanDescription($object['PLAN_DESCRIPTION']);
            $this->setPlanPrice($object['PLAN_PRICE']);
            $this->setPlanType($object['PLAN_TYPE']);
        }
    }
    public function Initalize(){
        $this->CreateStatement(12);
        return $this->Select();
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID = $userid;}

    public function getPlanTitle(){return $this->PLAN_TITLE;}
    public function setPlanTitle($title){$this->PLAN_TITLE = $title;}

    public function getPlanDescription(){return $this->PLAN_DESCRIPTION;}
    public function setPlanDescription($description){$this->PLAN_DESCRIPTION = $description;}

    public function getPlanPrice(){return $this->PLAN_PRICE;}
    public function setPlanPrice($price){$this->PLAN_PRICE = $price;}

    public function getPlanType(){return $this->PLAN_TYPE;}
    public function setPlanType($type){$this->PLAN_TYPE = $type;}
    public function Save()
    {
        $this->CreateStatement(11);
        $this->stmt->bind_param('sssss', $this->getUserId(), $this->getPlanTitle(), $this->getPlanDescription(), $this->getPlanPrice(), $this->getPlanType());
        $this->Insert();
        return $this->INSERT_STATUS;
    }
}