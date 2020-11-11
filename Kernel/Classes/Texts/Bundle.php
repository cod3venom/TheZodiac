<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Texts;

use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Security\FileSystem;
class Bundle extends Restrictions
{
    private $SelectedBundle;
    private $fSystem;




    public function __construct(){
        $this->fSystem = new FileSystem();
        $this->getCurrentlanguage();
    }

    public function getCurrentlanguage(){
        $Language  = '';
        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $Language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }else{
            $Language = 'en';
        }
        foreach (self::ACCEPTED_LANGUAGES as $ActualLanguage){
            if($ActualLanguage === $Language){
                $this->setSelectedBundle($Language);
            }
        }
    }
    public function getSelectedBundle(){return $this->SelectedBundle;}
    public function setSelectedBundle($bundle){
        $bundle = str_replace($this::STAR, $bundle, $this::BUNDLER_FILE);
        $this->SelectedBundle = $bundle;
    }

    public function getString($num){
        $num = (int)$num;
        $BundleData = $this->fSystem->readFile($this->getSelectedBundle());
        if(strpos($BundleData, self::NEWLINE)!==false && strpos($BundleData, self::DOLLAR)){
            $Lines = explode(self::NEWLINE,$BundleData);
            for ((int)$i=0; $i < count($Lines);$i++){
                $stack = explode(self::DOLLAR,$Lines[$i]);
                if((int)$stack[0] === (int)$num){
                    return $stack[1];
                }
            }
        }
    }
}