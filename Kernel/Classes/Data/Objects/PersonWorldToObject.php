<?php
/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 * @created 11/11/2020 - 11:34
 */

namespace Kernel\Classes\Data\Objects;


use Kernel\Classes\Data\MySql;

class PersonWorldToObject extends MySql implements UserToObjectimpl
{
    private $USER_ID;
    private $PERSON_ID;
    private $PERSON_ACTION;
    private $PERSON_FUN;
    private $PERSON_SEEK;
    private $PERSON_MATTER;
    private $PERSON_USABILITY;
    private $PERSON_CAREER;
    private $PERSON_INFORMATION;
    private $PERSON_RELATIONS;
    private $PERSON_FUTURE;
    private $PERSON_FEELINGS;
    private $PERSON_DESIRE;
    private $PERSON_SPIRITUAL;
    private $PERSON_WALLPAPER;
    private $DATE;

    public function Initialize($PERSON_ID)
    {
        $this->CreateStatement(21);
        $this->stmt->bind_param('ss',$PERSON_ID,$_SESSION['USER_ID']);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->ID = $object['ID'];
            $this->setUserId($object['USER_ID']);
            $this->setPersonId($object['PERSON_ID']);
            $this->setPersonAction($object['PERSON_ACTION']);
            $this->setPersonFun($object['PERSON_FUN']);
            $this->setPersonSeek($object['PERSON_SEEK']);
            $this->setPersonMatter($object['PERSON_MATTER']);
            $this->setPersonUsability($object['PERSON_USABILITY']);
            $this->setPersonCareer($object['PERSON_CAREER']);
            $this->setPersonInformation($object['PERSON_INFORMATION']);
            $this->setPersonRelation($object['PERSON_RELATIONS']);
            $this->setPersonFuture($object['PERSON_FUTURE']);
            $this->setPersonFeeling($object['PERSON_FEELING']);
            $this->setPersonDesire($object['PERSON_DESIRE']);
            $this->setPersonSpiritual($object['PERSON_SPIRITUAL']);
            $this->setDate($object['DATE']);
        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID=$userid;}

    public function getPersonId(){return $this->PERSON_ID;}
    public function setPersonId($personid){$this->PERSON_ID = $personid;}

    public function getPersonAction(){return $this->PERSON_ACTION;}
    public function setPersonAction($action){$this->PERSON_ACTION = $action;}

    public function getPersonFun(){return $this->PERSON_FUN;}
    public function setPersonFun($fun){$this->PERSON_FUN = $fun;}

    public function getPersonSeek(){return $this->PERSON_SEEK;}
    public function setPersonSeek($seek){$this->PERSON_SEEK = $seek;}

    public function getPersonMatter(){return $this->PERSON_MATTER;}
    public function setPersonMatter($matter){$this->PERSON_MATTER = $matter;}

    public function getPersonUsability(){return $this->PERSON_USABILITY;}
    public function setPersonUsability($usability){$this->PERSON_USABILITY = $usability;}

    public function getPersonCareer(){return $this->PERSON_CAREER;}
    public function setPersonCareer($career){$this->PERSON_CAREER = $career;}

    public function getPersonInformation(){return $this->PERSON_INFORMATION;}
    public function setPersonInformation($information){$this->PERSON_INFORMATION = $information;}

    public function getPersonRelation(){return $this->PERSON_RELATIONS;}
    public function setPersonRelation($relation){$this->PERSON_RELATIONS = $relation;}

    public function getPersonFuture(){return $this->PERSON_FUTURE;}
    public function setPersonFuture($future){$this->PERSON_FUTURE = $future;}

    public function getPersonFeeling(){return $this->PERSON_FEELINGS;}
    public function setPersonFeeling($feelings){$this->PERSON_FEELINGS = $feelings;}

    public function getPersonDesire(){return $this->PERSON_DESIRE;}
    public function setPersonDesire($desire){$this->PERSON_DESIRE = $desire;}

    public function getPersonSpiritual(){return $this->PERSON_SPIRITUAL;}
    public function setPersonSpiritual($spiritual){$this->PERSON_SPIRITUAL = $spiritual;}

    public function getPersonWallpaper(){return $this->PERSON_WALLPAPER;}
    public function setPersonWallpaper($wallpaper){$this->PERSON_WALLPAPER = $wallpaper;}

    public function getDate(){return $this->DATE;}
    private function setDate($date){$this->DATE = $date;}

    public function getAllByOwner(){
        $USER_ID = $this->getUserId();
        if(!empty($USER_ID)){
            $this->CreateStatement(25);
            $this->stmt->bind_param('s',$USER_ID);
            return $this->Select();
        }
    }

    public function PrepareFilter($queryIndex){
        $queryIndex = (int)$queryIndex;
        $USER_ID = $this->getUserId();
        if(!empty($USER_ID)){
            $this->CreateStatement($queryIndex);
            $this->stmt->bind_param('s',$USER_ID);
            return $this->Select();

        }
    }

    public  function Filter($world){
            switch ((string)$world){
                case 'Action':
                   return $this->PrepareFilter(27);
                break;
                case 'Fun':
                    return $this->PrepareFilter(28);
                    break;
                case 'Seek':
                    return $this->PrepareFilter(29);
                    break;
                case 'Matter':
                    return $this->PrepareFilter(30);
                    break;
                case 'Usability':
                    return $this->PrepareFilter(31);
                    break;
                case 'Career':
                    return $this->PrepareFilter(32);
                    break;
                case 'Information':
                    return $this->PrepareFilter(33);
                    break;
                case 'Relation':
                    return $this->PrepareFilter(34);
                    break;
                case 'Future':
                    return $this->PrepareFilter(35);
                    break;
                case 'Feeling':
                    return $this->PrepareFilter(36);
                break;
                case 'Desire':
                    return $this->PrepareFilter(37);
                    break;
                case 'Spiritual':
                    return $this->PrepareFilter(38);
                    break;
                default:
                    return array();
            }
        }
    public function Save()
    {

    }
}