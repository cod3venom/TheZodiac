<?php

namespace Kernel\Classes\Actions;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Data\Objects\SubUsersToObject;
use Kernel\Classes\Data\Objects\UserPlanToObject;
use Kernel\Classes\Data\Objects\UserSecurityToObject;
use Kernel\Classes\Data\Objects\UsersProfileToObject;
use Kernel\Classes\Data\Objects\UsersToObject;
use Kernel\Classes\Security\ImportIO;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Security\Route;
use Kernel\Classes\Security\Session;
use Kernel\Classes\DataOperations\JSON;
class InitSubPersons extends MySql
{
    private $restriction;
    private $UserProfile;
    private $UserSecurity;
    private $UserPlan;
    private $UserToObject;
    private $session;
    private $Route;
    private $SubUser;


    public function  __construct()
    {

        parent::__construct();
        $this->UserToObject = new UsersToObject();
        $this->Route = new Route();
        $this->UserProfile = new UsersProfileToObject();
        $this->UserSecurity = new UserSecurityToObject();
        $this->UserPlan = new UserPlanToObject();
        $this->session = new Session();
        $this->SubUser = new SubUsersToObject();
    }

    public function Exists($param)
    {
        $this->CreateStatement(18);
        $this->stmt->bind_param('s',$param);
        $Result = $this->Count();
        if($Result === restrictions::NOT_EXISTS){
            return false;
        }else{
            return true;
        }
    }

    public function Add(){
        if(isset($_POST['Firstname']) && isset($_POST['Lastname']) && isset($_POST['Gender']) && isset($_FILES['Import'])){
            if(isset($_POST['Day']) && isset($_POST['Month']) && isset($_POST['Year']))
            {
                $this->SubUser->setUserId($_SESSION['USER_ID']);
                $this->SubUser->setPersonFirstName($_POST['Firstname']);
                $this->SubUser->setPersonLastName($_POST['Lastname']);
                $this->SubUser->setPersonGender($_POST['Gender']);
                $this->SubUser->setPersonBirthDay($_POST['Day']);
                $this->SubUser->setPersonBirthMonth($_POST['Month']);
                $this->SubUser->setPersonBirthYear($_POST['Year']);

                if(isset($_POST['BirthHour'])){
                    $this->SubUser->setPersonBirthHour($_POST['BirthHour']);
                }if(isset($_POST['BirthPlace'])){
                    $this->SubUser->setPersonBirthPlace($_POST['BirthPlace']);
                }
                $import = new ImportIO($_FILES);
                $import->randomizeFileName();
                $path = $import->Upload();

                $this->SubUser->setPersonAvatar($path);
                $this->SubUser->generatePersonId();
                if(!$this->Exists($this->SubUser->getPersonId())){
                    $this->SubUser->Save();
                }else{
                    echo Restrictions::USER_ALREADY_EXISTS;
                }
                echo $this->SubUser->toJson();
            }
        }
    }
    public function Update(){
        if(isset($_POST['PersonID'])){

            $this->SubUser->Initialize($_POST['PersonID']);

            if(isset($_POST['Firstname'])){$this->SubUser->setPersonFirstName($_POST['Firstname']);}
            if(isset($_POST['Lastname'])){$this->SubUser->setPersonLastName($_POST['Lastname']);}
            if(isset($_POST['Gender'])){$this->SubUser->setPersonGender($_POST['Gender']);}
            if(isset($_POST['Day'])){$this->SubUser->setPersonBirthDay($_POST['Day']);}
            if(isset($_POST['Month'])){$this->SubUser->setPersonBirthMonth($_POST['Month']);}
            if(isset($_POST['Year'])){$this->SubUser->setPersonBirthYear($_POST['Year']);}
            if(isset($_POST['BirthHour'])){$this->SubUser->setPersonBirthHour($_POST['BirthHour']);}
            if(isset($_POST['BirthPlace'])){$this->SubUser->setPersonBirthPlace($_POST['BirthPlace']);}
            if(isset($_FILES['Import'])){
                $import = new ImportIO($_FILES);
                $import->randomizeFileName();
                $path = $import->Upload();
                $this->SubUser->setPersonAvatar($path);
            }
            if($this->Exists($this->SubUser->getPersonId())){
                $this->SubUser->Update();
                echo $this->SubUser->toJson();
            }


        }
    }
    public function Delete(){
        if(isset($_POST['PersonID'])){
            $this->SubUser->setPersonId($_POST['PersonID']);
            $this->SubUser->setUserId($_SESSION['USER_ID']);
            $this->SubUser->Remove();
            echo $this->SubUser->toJson();
        }
    }
    public function getByPersonId(){
        if(isset($_POST['PersonID'])){
            $this->SubUser->Initialize($_POST['PersonID']);
            echo $this->SubUser->toJson();
        }
    }
    public function getAllByOwner(){
        $json = new JSON();
        $this->SubUser->setUserId($_SESSION['USER_ID']);
        $Result = $this->SubUser->getAllByOwner();
        foreach ($Result as $data){
             echo $json->PrettyConverter($data);
        }
    }
}