<?php
    /*
     * TheZodiac
     * @author Levan Ostrowski
     * @project TheZodiac
     * @created -/-/-
     */

    require_once 'Kernel/Includes/BootLoader.php';

use Kernel\Classes\Actions\SubUsers\InitFilter;
use Kernel\Classes\Auth\Account\InitAccount;
    use Kernel\Classes\Auth\Account\InitAuth;
    use Kernel\Classes\Data\Objects\PlansToObject;
use Kernel\Classes\Security\Mailer;
use Kernel\Classes\Texts\Bundle;
    use Kernel\Classes\Security\ImportIO;
    use Kernel\Classes\Security\Antihacker;
    use Kernel\Classes\Security\Restrictions;
    use Kernel\Classes\Security\Session;
    use Kernel\Classes\Actions\SubUsers\InitPersonWorlds;
    use Kernel\Classes\Actions\SubUsers\InitSubPersons;
    use Kernel\Classes\Actions\Plans\InitPlans;
    use Kernel\Classes\Payment\Payu\OAuth;
    use Kernel\Classes\Auth\Account\InitAccessTokenizer;

    $session = new Session();
    $initAccount = new InitAccount();
    $antiHacker = new Antihacker();
    $initsubUsers = new InitSubPersons();
    $initWorlds = new InitPersonWorlds();
    $plans = new InitPlans();
    $filter = new InitFilter();
    $accesToken = new InitAccessTokenizer();

    $session->StartUp();
    if(isset($_POST['Register_user'])){
        $antiHacker->PostSecurityFilter();
        $initAccount->Add();
    }

    if(isset($_POST['SignIn'])){
        $auth = new InitAuth();
        $auth->Auth();
    }

    if(isset($_POST['GetPlans'])){
        $plans->getPlans();
    }
    if(isset($_POST['PurchasePlan'])){
        $initAccount->SaveUserPlan();
    }

    if(isset($_GET['payu'])){
        $auth = new OAuth();
        $auth->doAuth();
    }
    if(isset($_GET['doOrder'])){
        $auth = new OAuth();
        $auth->doOrder();
    }

    if(isset($_POST['ResetPassword'])){
        $antiHacker->PostSecurityFilter();
        $accesToken->addToken();
    }
    if(isset($_POST['Verify'])){
        $antiHacker->PostSecurityFilter();
        $accesToken->CheckToken();
    }
    if($session->LoggedIN()){

        if(isset($_POST['UpdateAccount'])){
            $initAccount->Update();
        }

        if(isset($_POST['CheckActivationKey'])){
            $antiHacker->PostSecurityFilter();
            $initAccount->CompareActivationKey();
        }

        /*BEGIN
         * @table=ZODIAC.SUB_PERSONS
         * @class=SubPersonsToObject;
         * @init=InitSubPersons
         */
        if(isset($_POST['AddSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $initsubUsers->Add();
        }
        if(isset($_POST['GetSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $initsubUsers->getByPersonId();
        }
        if(isset($_POST['UpdateSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $initsubUsers->Update();
        }
        if(isset($_POST['DeleteSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $initsubUsers->Delete();
        }
                                                            //GetAllSubPersons
        if(isset($_POST['GetAllSubPersons']) || isset($_POST['0f9b1b0a37872ae3f6428160d6470e27'])){//
            $antiHacker->PostSecurityFilter();
            $initsubUsers->getAllByOwner();
        }
                        //LazyLoading
        if(isset($_POST['cc0c572dfb9a07e867edb7312b533a71']) && isset($_POST['Start'])&& isset($_POST['Limit']) ){
            $antiHacker->PostSecurityFilter();
            $initsubUsers->LazyLoading((int)$_POST['Start'], (int)$_POST['Limit']);
        }
        /*END
         * @table=ZODIAC.SUB_PERSONS
         * @class=SubPersonsToObject;
         * @init=InitSubPersons
         */

        /*BEGIN
         * @table=ZODIAC.PERSON)WORLDS
         * @class=PersonWOrldToObject;
         * @init=InitPersonWorlds
         */
        if(isset($_POST['Worlds']) && isset($_POST['ByOwner']) && isset($_POST['OnlyWorlds'])){
            $initWorlds->getAllByOwner();
        }
        if(isset($_POST['Worlds']) && isset($_POST['ByOwner']) && isset($_POST['StackedAnalysis'])){
            $initWorlds->getAllSubUserStack();
        }
        /*
         * @init=InitFilter
         */
        if(isset($_POST['Filter'])){
            $antiHacker->PostSecurityFilter();
            $filter->Search($_POST['Filter']);
        }

    }




