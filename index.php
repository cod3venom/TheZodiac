<?php

    require_once 'Kernel/Includes/BootLoader.php';

    use Kernel\Classes\Security\Antihacker;
    use Kernel\Classes\Security\FileSystem;
    use Kernel\Classes\Markup\HTML;
    use Kernel\Classes\Security\Route;
    use Kernel\Classes\Markup\TemplateManager;

    $hacker = new Antihacker();
    $html = new HTML();
    $template = new TemplateManager();

    if(Route::isDefault()){
        $template->setHtml($html->Load('Registration'));
        $template->RegisterPage();
    }
    if(Route::LoginPage()){
        $template->setHtml($html->Load('Login'));
        $template->LoginPage();
    }


