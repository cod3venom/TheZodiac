<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Data\Objects;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Data\Objects\UserToObjectimpl;

//@Table= Customers.USER_PLAN
class UserPlanToObject extends MySql implements UserToObjectimpl
{
    private $USER_ID;
    private $USER_PACKET_PRICE;
    private $USER_PACKET_OPTION;
    private $USER_PACKET_START_DATE;
    private $USER_PACKET_END_DATE;

    public function __construct()
    {
        parent::__construct();
        $this->Restriction = new Restrictions();
    }

    public function Initialize($USER_ID)
    {
        $this->CreateStatement(9);
        $this->stmt->bind_param("s",$USER_ID);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->USER_ID = $object['USER_ID'];
            $this->setUserPacketPrice($object['USER_PACKET_PRICE']);
            $this->setUserPacketOption($object['USER_PACKET_OPTION']);
            $this->setUserPacketStartDate($object['USER_PACKET_START_DATE']);
            $this->setUserPacketEndDate($object['USER_PAKCET_END_DATE']);
        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID = $userid;}

    public function getUserPacketPrice(){return $this->USER_PACKET_PRICE;}
    public function setUserPacketPrice($price){$this->USER_PACKET_PRICE = $price;}

    public function getUserPacketOption(){return $this->USER_PACKET_OPTION;}
    public function setUserPacketOption($option){$this->USER_PACKET_OPTION = (int) $option;}


    public function getUserPacketStartDate(){return $this->USER_PACKET_START_DATE;}
    public function setUserPacketStartDate($date){$this->USER_PACKET_START_DATE = $date;}

    public function getUserPacketEndDate(){return $this->USER_PACKET_END_DATE;}
    public function setUserPacketEndDate($days){
        if(!empty($days)){
            $days = '+'.$days.' days';
            $this->USER_PACKET_END_DATE = date('d/m/Y', strtotime($days));
        }
    }

    public function Save()
    {
        $this->CreateStatement(8);
        $this->stmt->bind_param("sssss", $this->USER_ID, $this->USER_PACKET_PRICE, $this->USER_PACKET_OPTION, $this->USER_PACKET_START_DATE, $this->USER_PACKET_END_DATE);
        $this->Insert();
        return $this->INSERT_STATUS;
    }
}