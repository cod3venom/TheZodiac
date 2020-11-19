<?php
    require_once 'Kernel/Includes/BootLoader.php';


    use Kernel\Classes\Auth\Account\InitAccount;
    use Kernel\Classes\Auth\Account\InitAuth;

    use Kernel\Classes\Data\Objects\PlansToObject;
    use Kernel\Classes\Texts\Bundle;

    use Kernel\Classes\Security\ImportIO;
    use Kernel\Classes\Security\Antihacker;
    use Kernel\Classes\Security\Restrictions;
    use Kernel\Classes\Security\Session;

    use Kernel\Classes\Actions\InitSubPersons;

    $session = new Session();
    $initAccount = new InitAccount();
    $antiHacker = new Antihacker();
    $subUsers = new InitSubPersons();

    $session->StartUp();
    if(isset($_POST['Register_user'])){
        $antiHacker->PostSecurityFilter();
        $initAccount->Add();
    }

    if(isset($_POST['SignIn'])){
        $auth = new InitAuth();
        $auth->Auth();
    }

    if(isset($_POST['PurchasePlan'])){
        $initAccount->SaveUserPlan();
    }

    if($session->LoggedIN()){

        if(isset($_POST['UpdateAccount'])){
            $initAccount->Update();
        }

        if(isset($_POST['CheckActivationKey'])){
            $antiHacker->PostSecurityFilter();
            $initAccount->CompareActivationKey();
        }

        if(isset($_POST['AddSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $subUsers->Add();
        }
        if(isset($_POST['GetSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $subUsers->getByPersonId();
        }
        if(isset($_POST['UpdateSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $subUsers->Update();
        }
        if(isset($_POST['DeleteSubPerson'])){
            $antiHacker->PostSecurityFilter();
            $subUsers->Delete();
        }
                                                            //GetAllSubPersons
        if(isset($_POST['GetAllSubPersons']) || isset($_POST['0f9b1b0a37872ae3f6428160d6470e27'])){//
            $antiHacker->PostSecurityFilter();
            $subUsers->getAllByOwner();
        }
                                                            //LazyLoading
        if(isset($_POST['LazyLoading']) || isset($_POST['cc0c572dfb9a07e867edb7312b533a71']) && isset($_POST['Start']) && isset($_POST['Limit'])){
            $antiHacker->PostSecurityFilter();
            $subUsers->LazyLoading((int)$_POST['Start'], (int)$_POST['Limit']);
        }


    }


