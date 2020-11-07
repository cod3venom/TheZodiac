<?php


namespace Kernel\Classes\Data\Objects;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Data\Objects\UserPlanToObject;
use Kernel\Classes\Data\Objects\UserToObjectimpl;

class UsersToObject extends MySql implements UserToObjectimpl
{


    private $ID;
    private $USER_ID;
    private $USER_EMAIL;
    private $USER_PASSWORD;
    private $USER_LEVEL;
    private $DATE;
    private $USER_IP;



    public function __construct(){
        parent::__construct();
        $this->Restriction = new Restrictions();
    }

    public function Initialize($UID){
        $this->CreateStatement(3);
        $this->stmt->bind_param('s',$UID);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->ID = $object['ID'];
            $this->setUserId($object['USER_ID']);
            $this->setUserEmail($object['USER_EMAIL']);
            $this->USER_PASSWORD = $object['USER_PASSWORD'];
            $this->setUserLevel($object['USER_LEVEL']);
            $this->DATE = $object['DATE'];

        }
    }


    public function getId(){return $this->ID;}

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID=$userid;}
    public function generateUserId(){
        if(!empty($this->USER_EMAIL)){
            $this->USER_ID = md5($this->USER_EMAIL);
        }else{
            //@todo=USE GLOBAL Debug() function with Bundler texts

        }
    }

    public function getUserEmail(){return $this->USER_EMAIL;}
    public function setUserEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->USER_EMAIL = $email;
        }
        else
        {
            return $this->Restriction::NOT_VALID_EMAIL;
        }
    }

    public function getUserPassword(){return $this->USER_PASSWORD;}
    public function setUserPassword($password)
    {
        if(strlen($password) > $this->Restriction::MAX_PASSWORD_LENGTH)
        {
            $this->USER_PASSWORD = password_hash($password, PASSWORD_DEFAULT);
        }
        else
        {
            echo  $this->Restriction::TOO_SHORT_PASSWORD;
        }
    }

    public function getUserIP(){return $this->USER_IP;}
    public function setUserIP($ip){$this->USER_IP = $ip;}

    public function getUserLevel(){return $this->USER_LEVEL;}
    public function setUserLevel($level){$this->USER_LEVEL = $level;}

    public function getUserDate(){return $this->DATE;}


    public function Save(){
        $this->CreateStatement(2);
        $this->stmt->bind_param("ssss",$this->USER_ID, $this->USER_EMAIL, $this->USER_PASSWORD, $this->USER_LEVEL);
        $this->Insert();
        return $this->INSERT_STATUS;
    }




}