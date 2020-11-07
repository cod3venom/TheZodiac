<?php

    CONST STATUS_PREFIX = '[STATRTUP] ====> ';
    CONST BACKSLASH = '\\';
    CONST SLASH = '//';
    CONST PHP = '.php';
    spl_autoload_register(function ($component) {
        JSDebug(1,STATUS_PREFIX.$component);
        BootLoader($component);
    });


    function BootLoader($component)
    {
        if(!empty($component))
        {
            $component = $component.PHP;
            $component = str_replace(BACKSLASH,SLASH,$component);
            include_once $component;
        }
    }


    function JSDebug($status,$data)
    {
        //$code = '<script>console.log("*");</script>';
        //$code = str_replace("*",$data,$code);
        #echo $code;
    }