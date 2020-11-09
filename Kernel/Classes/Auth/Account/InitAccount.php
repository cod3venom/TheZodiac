<?php

namespace Kernel\Classes\Auth\Account;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Data\DataActionsimp;
use Kernel\Classes\Data\Objects\UserPlanToObject;
use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Security\ImportIO;
use Kernel\Classes\Data\Objects\UsersToObject;
use Kernel\Classes\Security\Route;
use Kernel\Classes\Security\Session;

class InitAccount extends MySql implements DataActionsimp
{
    private $restriction;
    private $UserProfile;
    private $UserSecurity;
    private $UserPlan;
    private $UserToObject;
    private $session;
    public function  __construct()
    {
        parent::__construct();
        $this->restriction = new restrictions();
        $this->UserToObject = new UsersToObject();
        $this->Route = new Route();
        $this->UserProfile = new UsersProfileToObject();
        $this->UserSecurity = new UserSecurityToObject();
        $this->UserPlan = new UserPlanToObject();
        $this->session = new Session();
    }

    public function Exists($param)
    {
        $this->CreateStatement(1);
        $this->stmt->bind_param('s',$param);
        $Result = $this->Count();
        if($Result === restrictions::NOT_EXISTS){
            return false;
        }else{
            return true;
        }
    }

    public function Add(){
        if(isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Firstname']) && isset($_POST['Lastname']) && isset($_POST['Gender']) && isset($_POST['Birthday']) && isset($_FILES['Import'])){
            $this->UserToObject->setUserEmail($_POST['Email']);
            $this->UserToObject->setUserPassword($_POST['Password']);
            $this->UserToObject->generateUserId();
            $this->UserToObject->setUserLevel($this->restriction::USER);
            $this->UserToObject->setUserIP('127.0.0.1');
            if($this->Exists($this->UserToObject->getUserId()) === false){
                $this->UserToObject->Save();
                $this->SaveUsersProfile();
                $this->SaveProfileSecuritySettings();
            }else{
                echo $this->restriction::USER_ALREADY_EXISTS;
            }
        }
    }
    public function SaveUsersProfile(){

        $import = new ImportIO($_FILES);
        $import->randomizeFileName();
        $path = $import->Upload();
        $this->UserProfile->setUserId($this->UserToObject->getUserId());
        $this->UserProfile->setUserFirstname($_POST["Firstname"]);
        $this->UserProfile->setUserLastname($_POST["Lastname"]);
        $this->UserProfile->setUserAvatar($path);
        $this->UserProfile->setUserGender($_POST["Gender"]);
        $this->UserProfile->setUserBirthday($_POST["Birthday"]);
        $this->UserProfile->Save();
    }

    public function SaveProfileSecuritySettings(){
        $this->UserSecurity->setUserId($this->UserToObject->getUserId());
        $this->UserSecurity->setEmail($this->UserToObject->getUserEmail());
        $this->UserSecurity->setStatus($this->restriction::USER_NOT_BLOCKED);
        $this->UserSecurity->setActivationStatus($this->restriction::USER_NOT_ACTIVE);
        $this->UserSecurity->generateRecovery();
        $this->UserSecurity->setUserIP($this->UserToObject->getUserIP());
        $this->UserSecurity->setUserCountry();
        $status = $this->UserSecurity->Save();
        if($status === Restrictions::TRUE){
           if($this->UserSecurity->getMailStatus() === Restrictions::TRUE){
               $this->CreateSession();
               $this->Route->Navigate(Restrictions::ACTIVATION_PAGE);
           }
        }
    }


    public function CompareActivationKey(){
        if(isset($_POST['ActivationCode'])){
            $this->UserSecurity->Initialize($_SESSION['USER_ID']);
            $Code =  $_POST['ActivationCode'];
            $Actual = $this->UserSecurity->getUserRecovery();
            if($Code === $Actual){
                echo "Activated";
            }else{
                echo "wrong key";
            }
        }
    }
    public function SaveUserPlan(){
        if(isset($_POST['PlanType'])){
            $PlanType = (int)$_POST['PlanType'];
            if($PlanType == $this->restriction::USER_FREE || $PlanType == $this->restriction::USER_MID || $PlanType == $this->restriction::USER_PREMIUM){
                $USER_ID = '7dbce54cdfbf6433b8f57130fdee8b89'; //$_SESSION["USER_ID"];
                $this->UserPlan->setUserId($USER_ID);
                $this->UserPlan->setUserPacketPrice('20');
                $this->UserPlan->setUserPacketOption($PlanType);
                $this->UserPlan->setUserPacketStartDate(date("d/m/Y"));
                $this->UserPlan->setUserPacketEndDate('30');
                $this->UserPlan->Save();
            }
        }
    }

    public function Update(){
        $UID = 'e10581aaecd24e4a9e51bbe66a01a84f';
        $this->UserToObject->Initialize($UID);
        $this->UserProfile->Initialize($UID);
        $this->UserSecurity->Initialize($UID);

        if(isset($_POST['Email']) && isset($_POST['Password']))
        {

        }

        $this->UserToObject->setUserEmail('updated2@gmail.com');
        $this->UserToObject->setUserPassword('testpwd1234');
        $this->UserSecurity->setEmail($this->UserToObject->getUserEmail());

        $this->CreateStatement(10);
        $userUserId = $this->UserToObject->getUserId();
        $userUserEmail  = $this->UserToObject->getUserEmail();
        $userUserpassword = $this->UserToObject->getUserPassword();
        $userUserLevel  = $this->UserToObject->getUserLevel();
        $profileUserId = $this->UserProfile->getUserId();
        $profileUserAvatar = $this->UserProfile->getUserAvatar();
        $profileUserName = $this->UserProfile->getUsername();
        $securityUserId = $this->UserSecurity->getUserId();
        $securityUserEmail = $this->UserSecurity->getEmail();
        $securityUserStatus = $this->UserSecurity->getStatus();
        $securityRecovery = $this->UserSecurity->getUserRecovery();
        $securityUserIp = $this->UserSecurity->getUserIP();
        $securityCountry = $this->UserSecurity->getUserCountry();

        $this->stmt->bind_param('ssssssssssssss',
        $userUserId, $userUserEmail, $userUserpassword, $userUserLevel,
        $profileUserId, $profileUserAvatar,$profileUserName,
        $securityUserId,$securityUserEmail, $securityUserStatus, $securityRecovery,
        $securityUserIp, $securityCountry,$UID);
        $this->Insert();
    }
    public function Load()
    {

    }

    private function CreateSession(){
        $this->session->session_add('USER_ID', $this->UserToObject->getUserId());
    }


}