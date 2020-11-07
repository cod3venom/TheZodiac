<?php
    require_once 'Kernel/Includes/BootLoader.php';

    use Kernel\Classes\Auth\Account\InitAccount;
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
    if(isset($_POST["SignUp"]) && isset($_POST["Email"]) && isset($_POST["Password"])){
        $antiHacker->PostSecurityFilter();
    }
    if(isset($_POST['Update'])){
        $initAccount->Update();
    }
    if(isset($_POST['PurchasePlan'])){
        $initAccount->SaveUserPlan();
    }



