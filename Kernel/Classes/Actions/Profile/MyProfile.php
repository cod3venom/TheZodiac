<?php


/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */

namespace Kernel\Classes\Actions\Profile;


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
        $this->template->setHtml($this->html->Load('UserProfile'));
        echo $this->template->MyProfilePage();

    }

}