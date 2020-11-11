<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Markup;


use Kernel\Classes\Texts\Bundle;

class TemplateManager extends Bundle
{
    private $HTML;




    public function getHtml(){return $this->HTML;}
    public function setHtml($html){$this->HTML = $html;}

    public function RegisterPage(){
        $html = $this->getHtml();
        if(!empty($html)){
            $html = str_replace("EMAIL[0];",$this->getString(3),$html);
            $html = str_replace("PASSWORD[0];",$this->getString(4),$html);
            $html = str_replace("BTN[0];",$this->getString(1),$html);
            $html = str_replace("ALREADY_REGISTERED[0];",$this->getString(11),$html);
            $html = str_replace("LOGIN[0];",$this->getString(2),$html);

            $html = str_replace("TERMS[0];",$this->getString(6),$html);
            $html = str_replace("TERMS[1];",$this->getString(7),$html);
            $html = str_replace("TERMS[2];",$this->getString(8),$html);
            $html = str_replace("TERMS[3];",$this->getString(9),$html);
            $html = str_replace("TERMS[4];",$this->getString(10),$html);

            $html = str_replace("FIRSTNAME[0];",$this->getString(12),$html);
            $html = str_replace("LASTNAME[0];",$this->getString(13),$html);
            $html = str_replace("GENDER[0];",$this->getString(14),$html);
            $html = str_replace("NEXT[0];",$this->getString(15),$html);
            $html = str_replace("ADD_AVATAR[0[0];",$this->getString(16),$html);
            echo $html;
        }
    }
    public function LoginPage(){
        $html = $this->getHtml();
        if(!empty($html)){
            $html = str_replace("EMAIL[0];",$this->getString(3),$html);
            $html = str_replace("PASSWORD[0];",$this->getString(4),$html);
            $html = str_replace("BTN[0];",$this->getString(2),$html);
            $html = str_replace("NOT_REGISTERED[0];",$this->getString(5),$html);
            $html = str_replace("REGISTRATION[0];",$this->getString(1),$html);

            $html = str_replace("TERMS[0];",$this->getString(6),$html);
            $html = str_replace("TERMS[1];",$this->getString(7),$html);
            $html = str_replace("TERMS[2];",$this->getString(8),$html);
            $html = str_replace("TERMS[3];",$this->getString(9),$html);
            $html = str_replace("TERMS[4];",$this->getString(10),$html);

            echo $html;
        }
    }
    public function ProfileActivationPage(){
        $html = $this->getHtml();
        if(!empty($html)){
            echo $html;
        }
    }
    public function MyProfilePage(){
        $html = $this->getHtml();
        if(!empty($html)){
            $html = str_replace("DIGNITY[0];",$_SESSION['USER_FIRSTNAME'] .' '.$_SESSION['USER_LASTNAME'],$html);
            $html = str_replace("AGE[0];",$_SESSION['USER_BIRTHDATE'],$html);
            $html = str_replace("GENDER[0];",$_SESSION['USER_GENDER'],$html);
            echo $html;
        }
    }
}