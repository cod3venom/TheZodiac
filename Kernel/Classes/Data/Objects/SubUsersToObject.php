<?php

/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */

namespace Kernel\Classes\Data\Objects;


use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
//@Table=SUB_PERSONS

class SubUsersToObject extends MySql implements UserToObjectimpl
{

    private $USER_ID;
    private $PERSON_ID;
    private $PERSON_FIRSTNAME;
    private $PERSON_LASTNAME;
    private $PERSON_AVATAR;
    private $PERSON_GENDER;
    private $PERSON_BIRTH_DAY;
    private $PERSON_BIRTH_MONTH;
    private $PERSON_BIRTH_YEAR;
    private $PERSON_BIRTH_HOUR;
    private $PERSON_BIRTH_PLACE;

    public function Initialize($PERSON_ID)
    {
        $this->CreateStatement(16);
        $this->stmt->bind_param('ss',$PERSON_ID,$_SESSION['USER_ID']);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->ID = $object['ID'];
            $this->setUserId($object['USER_ID']);
            $this->setPersonId($object['PERSON_ID']);
            $this->setPersonFirstName($object['PERSON_FIRSTNAME']);
            $this->setPersonLastName($object['PERSON_LASTNAME']);
            $this->setPersonAvatar($object['PERSON_AVATAR']);
            $this->setPersonGender($object['PERSON_GENDER']);
            $this->setPersonBirthDay($object['PERSON_BIRTH_DAY']);
            $this->setPersonBirthMonth($object['PERSON_BIRTH_MONTH']);
            $this->setPersonBirthYear($object['PERSON_BIRTH_YEAR']);
            $this->setPersonBirthHour($object['PERSON_BIRTH_HOUR']);
            $this->setPersonBirthPlace($object['PERSON_BIRTH_PLACE']);

        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID=$userid;}

    public function getPersonId(){return $this->PERSON_ID;}
    public function setPersonId($personid){$this->PERSON_ID = $personid;}
    public function generatePersonId(){$this->PERSON_ID = md5(
        $this->getPersonFirstName().$this->getPersonLastName().$this->getPersonGender().$this->getPersonBirthDay().
            $this->getPersonBirthMonth().$this->getPersonBirthYear()
    );}

    public function getPersonFirstName(){return $this->PERSON_FIRSTNAME;}
    public function setPersonFirstName($firstname){
        if(strlen($firstname) >= Restrictions::MAX_NAME_SIZE){
            $this->PERSON_FIRSTNAME = $firstname;
        }else{
            echo Restrictions::TOO_LONG_NAME_TXT;
            $this->Die();
        }
    }

    public function getPersonLastName(){return $this->PERSON_LASTNAME;}
    public function setPersonLastName($lastname){
        if(strlen($lastname) >= Restrictions::MAX_NAME_SIZE){
            $this->PERSON_LASTNAME = $lastname;
        }else{
            echo Restrictions::TTOO_LONG_LASTNAME_TXT;
            $this->Die();
        }
    }

    public function getPersonAvatar(){return $this->PERSON_AVATAR;}
    public function setPersonAvatar($avatar){$this->PERSON_AVATAR = $avatar;}

    public function getPersonGender(){return $this->PERSON_GENDER;}
    public function setPersonGender($gender){
        if($gender === Restrictions::GENDER_MAN || $gender === Restrictions::GENDER_WOMAN){
            $this->PERSON_GENDER = $gender;
        }else{
            echo Restrictions::NO_GENDER_TXT;
            $this->Die();
        }
    }

    public function getPersonBirthDay(){return $this->PERSON_BIRTH_DAY;}
    public function setPersonBirthDay($birthday){
        if(strlen($birthday) <= Restrictions::MAX_DAY_SIZE){
            $this->PERSON_BIRTH_DAY = $birthday;
        }else{
            echo Restrictions::TOO_LONG_DAY_TXT;
            $this->Die();
        }
    }

    public function getPersonBirthMonth(){return $this->PERSON_BIRTH_MONTH;}
    public function setPersonBirthMonth($birthmonth){
        if(strlen($birthmonth) <= Restrictions::MAX_MONTH_SIZE){
            $this->PERSON_BIRTH_MONTH = $birthmonth;
        }else{
            echo Restrictions::TOO_LONG_MONTH_TXT;
            $this->Die();
        }
    }

    public function getPersonBirthYear(){return $this->PERSON_BIRTH_YEAR;}
    public function setPersonBirthYear($birthyear){
        if(strlen($birthyear) > Restrictions::MAX_YEAR_SIZE){
            echo Restrictions::TOO_LONG_YEAR_TXT;
            $this->Die();
        }
        if(strlen($birthyear) < Restrictions::MAX_YEAR_SIZE){
            echo Restrictions::TOO_SHORT_YEAR_TXT;
            $this->Die();
        }
        if(strlen($birthyear) === Restrictions::MAX_YEAR_SIZE){
            $this->PERSON_BIRTH_YEAR = $birthyear;
        }
    }

    public function getPersonBirthHour(){return $this->PERSON_BIRTH_HOUR;}
    public function setPersonBirthHour($birthour){$this->PERSON_BIRTH_HOUR = $birthour;}

    public function getPersonBirthPlace(){return $this->PERSON_BIRTH_PLACE;}
    public function setPersonBirthPlace($birthplace){$this->PERSON_BIRTH_PLACE = $birthplace;}

    public function toJson(){
        $Stack = array(
            'USER_ID'=>$this->getUserId(), 'PERSON_ID'=>$this->getPersonId(), 'PERSON_FIRSTNAME'=>$this->getPersonFirstName(), 'PERSON_LASTNAME'=>$this->getPersonLastName(),
            'PERSON_GENDER'=>$this->getPersonGender(), 'PERSON_BIRTH_DAY'=>$this->getPersonBirthDay(), 'PERSON_BIRTH_MONTH'=>$this->getPersonBirthMonth(),
            'PERSON_BIRTH_YEAR'=>$this->getPersonBirthYear(), 'PERSON_BIRTH_HOUR'=>$this->getPersonBirthHour(), 'PERSON_BIRTH_PLACE'=>$this->getPersonBirthPlace()
        );
        return json_encode($Stack,JSON_PRETTY_PRINT);
    }


    public function Save()
    {
        $this->CreateStatement(17);
        if(empty($this->getPersonBirthHour())){
            $this->setPersonBirthHour(Restrictions::EMPTY_SIGN);

        }
        if(!empty($this->getPersonBirthPlace())){
            $this->setPersonBirthPlace(Restrictions::EMPTY_SIGN);
        }
        $this->stmt->bind_param(
            "sssssssssss",
            $this->USER_ID,
            $this->PERSON_ID,
            $this->PERSON_FIRSTNAME,
            $this->PERSON_LASTNAME,
            $this->PERSON_AVATAR,
            $this->PERSON_GENDER,
            $this->PERSON_BIRTH_DAY,
            $this->PERSON_BIRTH_MONTH,
            $this->PERSON_BIRTH_YEAR,
            $this->PERSON_BIRTH_HOUR,
            $this->PERSON_BIRTH_PLACE
        );
        $this->Insert();
        return $this->INSERT_STATUS;
    }
    public function Update(){
        $this->CreateStatement(19);
        $this->stmt->bind_param(
            "sssssssssss",
            $this->PERSON_FIRSTNAME,
            $this->PERSON_LASTNAME,
            $this->PERSON_AVATAR,
            $this->PERSON_GENDER,
            $this->PERSON_BIRTH_DAY,
            $this->PERSON_BIRTH_MONTH,
            $this->PERSON_BIRTH_YEAR,
            $this->PERSON_BIRTH_HOUR,
            $this->PERSON_BIRTH_PLACE,
            $this->PERSON_ID,
            $this->USER_ID
        );
        $this->Insert();
        return $this->INSERT_STATUS;
    }
    public function Remove(){
        $this->CreateStatement(20);
        $this->stmt->bind_param("ss", $this->PERSON_ID, $this->USER_ID);
        $this->Delete();
        return $this->INSERT_STATUS;
    }

    public function getAllByOwner(){
        $USER_ID = $this->getUserId();
        if(!empty($USER_ID)){
            $this->CreateStatement(23);
            $this->stmt->bind_param('s',$USER_ID);
            return $this->Select();
        }
    }
    public function LazyLoading($start,$limit){
        $USER_ID = $this->getUserId();
        if(!empty($USER_ID)){
            $query = $this->QueryFactory->GetQuery(24);
            $query = str_replace("PARAM[0];",$start,$query);
            $query = str_replace("PARAM[1];",$limit,$query);
            echo $query;
            $this->CreateStatementWithQuery($query);
            $this->stmt->bind_param('s',$USER_ID);
            return $this->Select();
        }
    }


    private function Die(){
        exit(0);
    }
}