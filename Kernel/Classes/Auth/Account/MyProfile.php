<?php


/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */

namespace Kernel\Classes\Auth\Account;


use Kernel\Classes\Data\MySql;
use Kernel\Classes\Markup\HTML;
use Kernel\Classes\Markup\TemplateManager;

class MyProfile extends MySql
{
    private $template;
    private $html;
    public function __construct()
    {
        $this->template = new TemplateManager();
        $this->html = new HTML();
    }

    public function Load()
    {
        $this->template->setHtml($this->html->Load('UserProfileTop'));
        echo $this->template->MyProfilePage();
//        header('Content-Type: application/json');
//        echo json_encode($_SESSION,JSON_PRETTY_PRINT);
    }

}