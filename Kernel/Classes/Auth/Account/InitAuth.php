<?php


namespace Kernel\Classes\Auth\Account;


use Kernel\Classes\Data\MySql;
use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Data\Objects\UsersToObject;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Security\Session;

class initAuth extends MySql
{

    private $UserSecurity;
    private $UserProfile;
    private $Email;
    private $EnteredPassword;
    private $DBPASSWORDHASH;
    private $USER_ACTIVATION_CODE;
    private $USER_ID;
    private $session;


    public function getEmail(){return $this->Email;}
    public function setEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->Email = $email;
        }
    }

    public function getEnteredPassword(){return $this->EnteredPassword;}
    public function setEnteredPassword($enteredPassword){$this->EnteredPassword = $enteredPassword;}

    public function getDbPasswordHash(){return $this->DBPASSWORDHASH;}
    public function setDbPasswordHash($dbpasswordhash){$this->DBPASSWORDHASH = $dbpasswordhash;}

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($USER_ID){$this->USER_ID = $USER_ID;}

    public function getUserActivationCode(){return $this->USER_ACTIVATION_CODE;}
    public function setUserActivationCode($USER_ACTIVATION_CODE){$this->USER_ACTIVATION_CODE = $USER_ACTIVATION_CODE;}



    public function __construct()
    {
        parent::__construct();
        $this->UserSecurity = new UserSecurityToObject();
        $this->session = new Session();
    }


    private function GetData(){
        $this->CreateStatement(15);
        $this->stmt->bind_param('s',$this->Email);
        $Result = $this->Select();
        foreach ($Result as $Account){
            $this->setUserId($Account['USER_ID']);
            $this->setDbPasswordHash($Account['USER_PASSWORD']);
        }
    }
    private function GetSecurityAssets(){
        $USER_ID = $this->getUserId();
        if(!empty($USER_ID)){
            $this->UserSecurity->Initialize($USER_ID);
        }
    }
    private function CheckAuth(){
        $this->GetData();

        if(password_verify($this->getEnteredPassword(), $this->getDbPasswordHash())){
            $this->GetSecurityAssets();
            if($this->UserSecurity->getStatus() !== Restrictions::USER_IS_BLOCKED){
                echo Restrictions::LOGGED_IN_SUCCESSFULLY_TXT.PHP_EOL;
                $this->CreateSession();
            }else{
                echo Restrictions::USER_IS_BLOCKED_TXT;
            }
        }else{
            echo "cant login";
        }
    }

    public function Auth(){
        if(isset($_POST['Email']) && isset($_POST['Password'])){
            $this->setEmail($_POST['Email']);
            $this->setEnteredPassword($_POST['Password']);
            $this->CheckAuth();
        }
    }
    public function CreateSession(){
        $this->UserProfile = new UsersProfileToObject();
        $this->UserProfile->Initialize($this->getUserId());
        $this->session->session_add('USER_ID', $this->getUserId());
        $this->session->session_add('USER_FIRSTNAME', $this->UserProfile->getUserFirstname());
        $this->session->session_add('USER_LASTNAME', $this->UserProfile->getUserLastname());
        $this->session->session_add('USER_GENDER', $this->UserProfile->getUserGender());
        $this->session->session_add('USER_BIRTHDATE', $this->UserProfile->getUserBirthday());
        $this->Load();
    }

    public function  Load(){
        header('Content-Type: application/json');
        echo json_encode($_SESSION,JSON_PRETTY_PRINT);
    }

}