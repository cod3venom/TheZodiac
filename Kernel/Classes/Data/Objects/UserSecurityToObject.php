<?php


namespace Kernel\Classes\Data\Objects;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Data\Objects\UserToObjectimpl;

use Kernel\Classes\PHPMailer\PHPMailer;
use Kernel\Classes\PHPMailer\SMTP;
use Kernel\Classes\PHPMailer\Exception;


//@Table=Customers.USER_SECURITY
class UserSecurityToObject extends MySql implements UserToObjectimpl
{

    private $USER_ID = 'USER_ID';
    private $USER_EMAIL = 'USER_EMAIL';
    private $USER_STATUS = 'USER_STATUS';
    private $ACTIVATION_STATUS = 'ACTIVATION_STATUS';
    private $USER_RECOVERY = 'USER_RECOVERY';
    private $USER_IP = 'USER_IP';
    private $USER_COUNTRY = 'USER_COUNTRY';
    private $MAIL_STATUS = 0;
    public function __construct()
    {
        parent::__construct();
        $this->Restriction = new Restrictions();
    }

    public function Initialize($USER_ID)
    {
        $this->USER_ID = $USER_ID;
        $this->CreateStatement(14);
        $this->stmt->bind_param('s',$USER_ID);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->setEmail($this->USER_EMAIL);
            $this->setStatus($object['USER_STATUS']);
            $this->setUserRecovery($object['USER_RECOVERY']);
            $this->setUserIP($object['USER_IP']);
            $this->setUserCountry($object['USER_COUNTRY']);
        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID = $userid;}

    public function getEmail(){return $this->USER_EMAIL;}
    public function setEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->USER_EMAIL = $email;
        }else{
            $this->Restriction->NOT_VALID_EMAIL = 1;
            return;
        }
    }

    public function getStatus(){return $this->USER_STATUS;}
    public function setStatus($status){$this->USER_STATUS = $status;}

    public function getActivationStatus(){return $this->ACTIVATION_STATUS;}
    public function setActivationStatus($status){$this->ACTIVATION_STATUS = $status;}

    public function getUserRecovery(){return $this->USER_RECOVERY;}
    public function setUserRecovery($recovery){$this->USER_RECOVERY = $recovery;}
    public function generateRecovery(){$this->USER_RECOVERY = md5(microtime());}

    public function getUserIP(){return $this->USER_IP;}
    public function setUserIP($ip){$this->USER_IP = $ip;}

    public function getUserCountry(){return $this->USER_COUNTRY;}
    public function setUserCountry(){$this->setCountryByIp();}

    private function setCountryByIp(){
        if(!empty($this->USER_IP)){
            $this->USER_COUNTRY = 'PL';
        }
    }

    public function getMailStatus(){return $this->MAIL_STATUS;}
    private function setMailStatus($status){$this->MAIL_STATUS = (int)$status;}

    public function Save(){
         $this->CreateStatement(7);
         $this->stmt->bind_param('sssssss', $this->USER_ID, $this->USER_EMAIL, $this->USER_STATUS, $this->ACTIVATION_STATUS, $this->USER_RECOVERY,$this->USER_IP, $this->USER_COUNTRY);
         $this->Insert();
         if($this->INSERT_STATUS === 1){
             $this->SendActivationKey();
         }
         return $this->INSERT_STATUS;
    }

    private  function SendActivationKey(){
        $mail = new PHPMailer(true);
        try
        {
            //$mail->SMTPDebug = 4;
            $mail->isSMTP(true); // telling the class to use SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'serwer2077094.home.pl ';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "dev@rootsconnector.com";
            $mail->Password = "dev112it.pl";


            $mail->setFrom('dev@rootsconnector.com', 'Sender Name');
            $mail->addAddress($this->getEmail(), 'Receiver Name');
            $mail->addReplyTo('dev@rootsconnector.com', 'Sender Name');
            $mail->Subject = 'TheZodiac Activation';
            $mail->Body = 'YOUR Activation KEY IS '.$this->getUserRecovery();
            $mail->send();
            $this->setMailStatus(Restrictions::TRUE);
            echo "mail was  successfully sent to the" .$this->getEmail();
        }
        catch (Exception $ex)
        {
            echo "error ".PHP_EOL.$ex;
        } finally {
            return $this->getMailStatus();
        }
    }
}