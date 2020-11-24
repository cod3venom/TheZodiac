<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 24/11/2020 - 09:59
 */

namespace Kernel\Classes\Auth\Account;


use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Security\Mailer;
use Kernel\Classes\Security\Restrictions;

class InitAccessTokenizer
{
    private $initAuth;
    private $initAccount;
    private $UserSecurity;
    private $token;
    public function __construct(){
        $this->initAuth = new InitAuth();
        $this->initAccount = new InitAccount();
        $this->UserSecurity = new UserSecurityToObject();
    }

    private function verifyToken($token){
        if(!empty($token)){
            if(strpos($token,Restrictions::ACCESS_TOKEN_PREFIX) !== false){
                if(strlen($token) === Restrictions::TOKEN_MAXLEN){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }
    public function setToken(){
        $int = mt_rand(Restrictions::$TOKEN_FROM,Restrictions::$TOKEN_TO);
        $this->token =  Restrictions::ACCESS_TOKEN_PREFIX.$int;
    }
    public function getToken(){return $this->token;}

    public function addToken(){
        if(isset($_POST['Email'])){
            $this->initAuth->setEmail($_POST['Email']);
            $this->initAuth->GetData();
            if(!empty($this->initAuth->getDbPasswordHash())){
                $this->setToken();
                if($this->verifyToken($this->getToken())) {
                    $this->initAccount->Update($this->getToken());
                    $this->SendRecoveryKey();
                }
            }
            else{
                echo Restrictions::USER_DOESNT_EXISTS;
            }
        }
    }

    private  function SendRecoveryKey(){
        $mail = new Mailer();
        $mail->setMailTo($_POST['Email']);
        $mail->setMailSubject('DEVELOPMENT');
        $mail->setMailBody('YOUR RECOVERY KEY IS '.$this->getToken());
        $mail->Send();
    }

    public function CheckToken(){
        if(isset($_POST['Token']) && isset($_POST['Email'])){
            $this->initAuth->setEmail($_POST['Email']);
            $this->initAuth->GetData();
            $this->UserSecurity->InitializeByEmail($_POST['Email']);
            if($_POST['Token'] === $this->UserSecurity->getUserRecovery()){
                $this->initAccount->Update();
            }


        }
    }

    public function showError(){

    }

}