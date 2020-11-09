<?php


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
}