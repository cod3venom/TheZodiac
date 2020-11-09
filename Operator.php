<?php
    require_once 'Kernel/Includes/BootLoader.php';

    use Kernel\Classes\Auth\Account\InitAccount;
    use Kernel\Classes\Auth\Account\InitAuth;
    use Kernel\Classes\Data\Objects\PlansToObject;
    use Kernel\Classes\Security\ImportIO;
    use Kernel\Classes\Security\Antihacker;
    use Kernel\Classes\Texts\Bundle;
    use Kernel\Classes\Security\Restrictions;


    $initAccount = new InitAccount();
    $antiHacker = new Antihacker();


    if(isset($_POST['Register_user'])){
        $antiHacker->PostSecurityFilter();
        $initAccount->Add();
    }
    if(isset($_POST['SignIn'])){
        $auth = new InitAuth();
        $auth->Auth();
    }

    if(isset($_POST['Update'])){
        $initAccount->Update();
    }
    if(isset($_POST['PurchasePlan'])){
        $initAccount->SaveUserPlan();
    }



