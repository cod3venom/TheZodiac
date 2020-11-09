<?php

    require_once 'Kernel/Includes/BootLoader.php';


    use Kernel\Classes\Markup\HTML;
    use Kernel\Classes\Markup\TemplateManager;
    use Kernel\Classes\Security\Route;
    use Kernel\Classes\Security\Antihacker;
    use Kernel\Classes\Security\FileSystem;
    use Kernel\Classes\Security\Session;


    $session = new Session();
    $hacker = new Antihacker();
    $html = new HTML();
    $template = new TemplateManager();

    $session->StartUp();

    if(Route::isDefault()){
        $template->setHtml($html->Load('Registration'));
        $template->RegisterPage();
    }
    if(Route::LoginPage()){
        $template->setHtml($html->Load('Login'));
        $template->LoginPage();
    }

    if(Route::ActivationPage()){
        $template->setHtml($html->Load('ProfileActivation'));
        $template->ProfileActivationPage();
    }


