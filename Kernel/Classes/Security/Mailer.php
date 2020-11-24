<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 24/11/2020 - 12:12
 */

namespace Kernel\Classes\Security;

use Kernel\Classes\PHPMailer\PHPMailer;
use Kernel\Classes\PHPMailer\SMTP;
use Kernel\Classes\PHPMailer\Exception;

use Kernel\Classes\Security\FileSystem;

class Mailer extends FileSystem
{
    protected const MailConfiguration = 'Kernel/Classes/Data/.mailAccess.c';

    private $MAIL_STATUS = 0;
    private $MAIL;
    private $OPTIONS;
    private $SMTP = true;
    private $HOST = 'HOST';
    private $PORT = 'PORT';
    private $USERNAME = 'USERNAME';
    private $PASSWORD = 'PASSWORD';
    private $ENCRYPTION = 'ENCRYPTION';
    private $MAIL_FROM = 'MAIL_FROM';
    private $MAIL_NAME = 'MAIL_NAME';
    private $MAIL_TO = 'MAIL_TO';
    private $MAIL_SUBJECT;
    private $MAIL_BODY;

    private function getMail(){return $this->MAIL;}
    private function setMail($MAIL){$this->MAIL = $MAIL;}

    private function getOptions(){return $this->OPTIONS;}
    private function setOptions($OPTIONS){$this->OPTIONS = $OPTIONS;}

    private function getSMTP(){return $this->SMTP;}
    private function setSMTP($SMTP){$this->SMTP = $SMTP;}

    private function getHOST(){return $this->HOST;}
    private function setHOST($HOST){$this->HOST = $HOST;}

    private function getPORT(){return $this->PORT;}
    private function setPORT($PORT){$this->PORT = $PORT;}

    private function getUSERNAME(){return $this->USERNAME;}
    private function setUSERNAME($USERNAME){$this->USERNAME = $USERNAME;}

    private function getPASSWORD(){return $this->PASSWORD;}
    private function setPSASWORD($PASSWORD){$this->PASSWORD = $PASSWORD;}

    private function getENCRYPTION(){return $this->ENCRYPTION;}
    private function setENCRYPTION($ENCRYPTION){$this->ENCRYPTION = $ENCRYPTION;}

    private function getMailFrom(){return $this->MAIL_FROM;}
    private function setMailFrom($MAIL_FROM){$this->MAIL_FROM = $MAIL_FROM;}

    public function getMailTo(){return $this->MAIL_TO;}
    public function setMailTo($MailTo){$this->MAIL_TO = $MailTo;}

    private function getMailName(){return $this->MAIL_NAME;}
    private function setMailName($MAIL_NAME){$this->MAIL_NAME = $MAIL_NAME;}

    public function getMailSubject(){return $this->MAIL_SUBJECT;}
    public function setMailSubject($MAIL_SUBJECT){$this->MAIL_SUBJECT = $MAIL_SUBJECT;}

    public function getMailBody(){return $this->MAIL_BODY;}
    public function setMailBody($MAIL_BODY){return $this->MAIL_BODY = $MAIL_BODY;}


    private function MailUtill(){
        $Config = $this::readFile(self::MailConfiguration);
        $unJson = json_decode($Config, true);
        foreach ($unJson as $json){
            foreach ($json as $jsn){
                $this->setHOST($jsn[$this->HOST]);
                $this->setPORT($jsn[$this->PORT]);
                $this->setUSERNAME($jsn[$this->USERNAME]);
                $this->setPSASWORD($jsn[$this->PASSWORD]);
                $this->setENCRYPTION($jsn[$this->ENCRYPTION]);
                $this->setMailFrom($jsn[$this->MAIL_FROM]);
                $this->setMailName($jsn[$this->MAIL_NAME]);
                return true;
            }
        }
    }


    private function InitializeMessage(){
        $this->MailUtill();
        $this->setOptions(array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        ));
        $this->MAIL = new PHPMailer();
        $this->MAIL->SMTPDebug = 0;//4;
        $this->MAIL->isSMTP($this->getSMTP());
        $this->MAIL->SMTPOptions = $this->getOptions();
        $this->MAIL->SMTPSecure = $this->getENCRYPTION();
        $this->MAIL->SMTPAuth = true;
        $this->MAIL->Host = $this->getHOST();
        $this->MAIL->Port = $this->getPORT();
        $this->MAIL->Username = $this->getUSERNAME();
        $this->MAIL->Password = $this->getPASSWORD();
        $this->MAIL->setFrom($this->getMailFrom(), $this->getMailName());
        $this->MAIL->addAddress($this->getMailTo(), '');
        $this->MAIL->addReplyTo($this->getMailFrom(), $this->getMailName());
        $this->MAIL->Subject = $this->getMailSubject();
        $this->MAIL->Body = $this->getMailBody();
    }
    public function Send(){
        $this->InitializeMessage();
        try
        {
            $this->MAIL->send();
            $this->MAIL_STATUS = Restrictions::TRUE;
        }catch (Exception $exception){
            echo $exception;
            $this->MAIL_STATUS = Restrictions::FALSE;
        }
    }

}