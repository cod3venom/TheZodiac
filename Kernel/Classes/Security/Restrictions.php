<?php


namespace Kernel\Classes\Security;


class Restrictions
{


    /*
    * USER LEVELS
    */
    CONST GOD = 0;
    CONST ADMINISTRATOR = 1;
    CONST REDACTOR = 2;
    CONST USER = 3;


    /*
    * USER ACCOUNT PLANS
    */
    CONST USER_FREE = 0;
    CONST USER_MID = 1;
    CONST USER_PREMIUM = 2;

    /*
    * USER ACCOUNT STATUS
    */
    CONST USER_NOT_BLOCKED=0;
    CONST USER_IS_BLOCKED=1;
    CONST NOT_EXISTS = 0;
    CONST EXISTS = 1;

    /*
    * USER REGISTRATION CONSTANTS
    */
    CONST USER_ALREADY_EXISTS = 'USER_ALREADY_EXISTS';
    CONST MAX_PASSWORD_LENGTH = 8;
    CONST NOT_VALID_EMAIL = 'NOT_VALID_EMAIL';
    CONST TOO_SHORT_PASSWORD = 'TOO_SHORT_PASSWORD';
    CONST DEFAULT_AVATAR = 'https://as2.ftcdn.net/jpg/00/60/49/77/1000_F_60497703_dibqLWSM9hsHYpmCcXnTlGttVwiwcVX6.jpg';

    /*
    * FILE UPLOAD SETTINGS
    */
    CONST MAX_DOC_SIZE = 50000;
    CONST MAX_IMG_SIZE = 25000;
    CONST TOO_BIG_FILE = 'TOO_BIG_FILE';
    CONST EXTENSIONS = array('xls','csv','png','jpg','jpeg');

    /*
    * LANGUAGE SETTINGS
    */
    CONST ACCEPTED_LANGUAGES = ['pl','en','de'];
    CONST BUNDLER_FILE = 'Kernel/Classes/Texts/*.Texts';



    /*
     * SOME CONSTATNS
     */

    CONST STAR = '*';
    CONST NEWLINE = '\n';
    CONST DOLLAR = '$';

    /*
     * QUERY FACTORY BUNDLER
     */
    CONST QUERIES = "Kernel/Classes/Data/Queries/.Queries";

    /*
     * HTML Settings
     */
    CONST HTML_ELEMENTS = array("!–- -–", "!DOCTYPE html","a","abbr","address","area","article","aside","audio","b","base", "bdi",
            "bdo","blockquote", "body","br","button","canvas","caption","cite","code","col","colgroup","data","datalist",
            "dd","del","details","dfn", "dialog","div","dl","dt","em","embed","fieldset","figure", "footer", "form",
            "h1", "h2","h3","h4","h5","h6","head","header","hgroup","hr","html","i","iframe","img","input","ins",
            "kbd","keygen","label","legend","li","link","main","map","mark","menu","menuitem","meta","meter", "nav","noscript",
            "object","ol","optgroup","option","output","p","param","pre","progress","q","rb","rp","rt", "rtc","ruby", "s",
            "samp","script","section","select","small","source","span", "strong","style", "sub","summary","sup","table", "tbody",
            "td","template","textarea","tfoot", "th", "thead","time","title","tr","track", "u","ul", "var", "video","wbr");

    CONST NOT_ALLOWED_CHARS = array('!','#','$','%','^','&','*','(',')','-','_','=','+',';',"'",'"');
    CONST NOT_ALLOWED_PHP   = array('<?','?>', 'php','<?php','<?php', 'system(','shell_exec','ls','dir', 'ls -l', 'chmod', 'chown');
    CONST HTML_FOLDER = 'Static/Assets/HTML/';
    CONST CSS_FOLDER = 'Static/Assets/CSS/';
    CONST JS_FOLDER  = 'Static/Assets/JS/';
    CONST IMG_FOLDER = 'Static/Assets/IMG/';
}