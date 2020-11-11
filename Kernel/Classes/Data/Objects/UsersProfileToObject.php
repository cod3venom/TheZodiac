<?php



/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Data\Objects;

use Kernel\Classes\Data\MySql;
use Kernel\Classes\Security\Restrictions;
use Kernel\Classes\Data\Objects\UserToObjectimpl;
//@Table=Customers.USER_PROFILE
class UsersProfileToObject extends MySql implements  UserToObjectimpl
{

    private $USER_ID = 'USER_ID';
    private $USER_FIRSTNAME = 'USER_FIRSTNAME';
    private $USER_LASTNAME = 'USER_LASTNAME';
    private $USER_AVATAR = 'USER_AVATAR';
    private $USER_GENDER = 'USER_GENDER';
    private $USER_BIRTHDATE;

    public function __construct(){
        parent::__construct();
        $this->Restriction = new Restrictions();
    }

    public function Initialize($USER_ID){
        $this->USER_ID = $USER_ID;
        $this->CreateStatement(5);
        $this->stmt->bind_param('s',$USER_ID);
        $Result = $this->Select();
        foreach ($Result as $object){
            $this->USER_FIRSTNAME = $object['USER_FIRSTNAME'];
            $this->USER_LASTNAME = $object['USER_LASTNAME'];
            $this->USER_AVATAR = $object['USER_AVATAR'];
            $this->USER_GENDER = $object['USER_GENDER'];
            $this->USER_BIRTHDATE = $object['USER_BIRTHDATE'];

        }
    }

    public function getUserId(){return $this->USER_ID;}
    public function setUserId($userid){$this->USER_ID = $userid;}

    public function getUserFirstname(){return $this->USER_FIRSTNAME;}
    public function setUserFirstname($name){$this->USER_FIRSTNAME = $name;}

    public function getUserLastname(){return $this->USER_LASTNAME;}
    public function setUserLastname($name){$this->USER_LASTNAME = $name;}

    public function getUserAvatar(){return $this->USER_AVATAR;}
    public function setUserAvatar($avatar){$this->USER_AVATAR = $avatar;}

    public function getUserGender(){return $this->USER_GENDER;}
    public function setUserGender($gender){$this->USER_GENDER = $gender;}

    public function getUserBirthday(){return $this->USER_BIRTHDATE;}
    public function setUserBirthday($birthday){$this->USER_BIRTHDATE = $birthday;}

    function Save(){
        $this->CreateStatement(4);
        $this->stmt->bind_param("ssssss",$this->USER_ID, $this->USER_FIRSTNAME, $this->USER_LASTNAME, $this->USER_AVATAR, $this->USER_GENDER, $this->USER_BIRTHDATE);
        $this->Insert();
        return $this->INSERT_STATUS;

    }
}