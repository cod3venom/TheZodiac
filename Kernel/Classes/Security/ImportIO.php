<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Security;

use Kernel\Classes\Security\Restrictions;

class ImportIO extends Restrictions
{
    CONST IMPORT   = 'Import';
    CONST NAME     = 'name';
    CONST TMP_NAME = 'tmp_name';
    CONST SIZE     = 'size';
    CONST TYPE     = 'type';

    private $FILE_UPLOAD_DIR;


    private $USER_ID;
    private $FILE;
    private $FILE_NAME;
    private $FILE_TMP_NAME;
    private $FILE_EXTENSION;
    private $FILE_SIZE;

    public function __construct($import){
        if(!empty($import)){
            $this->FILE_UPLOAD_DIR = $_SERVER['DOCUMENT_ROOT'] .'/Drive/';
            $this->setFile($import);
            $this->setFileName($import[self::IMPORT][self::NAME]);
            $this->setFileTmpName($import[self::IMPORT][self::TMP_NAME]);
            $this->setFileExtension();
            $this->setFileSize();
        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($USER_ID){$this->USER_ID = $USER_ID;}

    public function getFile(){return $this->FILE;}
    public function setFile($file){$this->FILE = $file;}

    public function getFileTmpName(){return $this->FILE_TMP_NAME;}
    public function setFileTmpName($tmp){$this->FILE_TMP_NAME = $tmp;}

    public function getFileName(){return $this->FILE_NAME;}
    public function setFileName($name){$this->FILE_NAME = $name;}

    public function getFileExtension(){return $this->FILE_EXTENSION;}
    public function setFileExtension(){
        if(!empty($this->getFileName())){
            if(strpos($this->getFileName(), '.') !== false){
                $lastDot = substr_count($this->getFileName(), '.');
                $this->FILE_EXTENSION = explode('.', $this->getFileName())[$lastDot];
            }
        }
    }

    public function getFileSize(){return $this->FILE_SIZE;}
    public function setFileSize(){
        if(!empty($this->FILE[self::IMPORT])){
            $this->FILE_SIZE = $this->FILE[self::IMPORT][self::SIZE];
        }
    }

    public function randomizeFileName(){
        $name = $this->getFileName();
        if(strpos($name, '.') !== false){
            $name  = explode('.', $name)[0];
            $name = $this->getFileName().'#'.microtime();
            $name = str_replace(' ', '',$name);
            $name = str_replace('.', '',$name);
        }
        return $name;
    }
    public function getFullRandomNameWithExtension(){
        return $this->randomizeFileName().'.'.$this->getFileExtension();
    }
    public function Upload(){
        $path = '';
        if(!empty($this->getFile())){
            foreach (self::EXTENSIONS as $ext){
                if($this->getFileExtension() === $ext){
                    if($this->getFileExtension() === "png" || $this->getFileExtension() === "jpg" || $this->getFileExtension() === "jpeg"){
                        if($this->getFileSize() <= Self::MAX_IMG_SIZE){
                            $path = $this->FILE_UPLOAD_DIR.'/Avatars/'.$this->getFullRandomNameWithExtension();
                            move_uploaded_file($this->getFileTmpName(), $path);
                        }else{
                            return  Self::TOO_BIG_FILE;
                        }
                    }else{
                        if($this->getFileSize() <= Self::MAX_DOC_SIZE){
                            $path = $this->FILE_UPLOAD_DIR.$this->getFullRandomNameWithExtension();
                            move_uploaded_file($this->getFileTmpName(), $path);
                        }else{
                            return  Self::TOO_BIG_FILE;
                        }

                    }
                }
            }
        }
        return $path;
    }
}