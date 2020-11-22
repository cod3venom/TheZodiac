<?php


/*
 * TheZodiac
 * @author Levan Ostrowski
 * @project TheZodiac
 */


namespace Kernel\Classes\Security;


class Restrictions
{

    CONST TRUE = 1;
    CONST FALSE = 0;
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
    CONST LOGGED_IN_SUCCESSFULLY_TXT = 'LOGGED_IN_SUCCESSFULLY';
    CONST USER_NOT_ACTIVE = 0;
    CONST USER_IS_ACTIVATED = 1;
    CONST USER_NOT_BLOCKED=0;
    CONST USER_IS_BLOCKED=1;
    CONST USER_IS_BLOCKED_TXT = 'USER_IS_BLOCKED';

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
    CONST MAX_IMG_SIZE = 125000;
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
    CONST EMPTY_SIGN = '~';

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
    CONST HTML_MAIN = 'Static/Assets/HTML/';
    CONST HTML_AUTH = 'Static/Assets/HTML/Auth/';
    CONST HTMLPROFILE = 'Static/Assets/HTML/Profile/';
    CONST HTML_CUSTOM = 'Static/Assets/HTML/Custom/';
    CONST CSS_FOLDER = 'Static/Assets/CSS/';
    CONST JS_FOLDER  = 'Static/Assets/JS/';
    CONST IMG_FOLDER = 'Static/Assets/IMG/';


    /*
     * PHP PAGES
     */
    CONST ACTIVATION_PAGE = 'index.php?ActivateWithKey';
    CONST MYPROFILE = 'index.php';


    /*
     *HUMAN DIGNITY CONSTANTS
     */

    CONST MAX_NAME_SIZE = 3;
    CONST MAX_DAY_SIZE = 2;
    CONST MAX_MONTH_SIZE = 2;
    CONST MAX_YEAR_SIZE = 4;

    CONST TOO_LONG_NAME_TXT = 'TOO_LONG_FIRSTNAME';
    CONST TOO_LONG_LASTNAME_TXT = 'TOO_LONG_LASTNAME';

    CONST TOO_LONG_DAY_TXT = 'TOO_LONG_DAY';
    CONST TOO_LONG_MONTH_TXT = 'TOO_LONG_MONTH';

    CONST TOO_LONG_YEAR_TXT = 'TOO_LONG_YEAR';
    CONST TOO_SHORT_YEAR_TXT = 'TOO_SHORT_YEAR';

    CONST TOO_LONG_HOUR_TXT  = 'TOO_LONG_HOUR';

    CONST GENDER_MAN = 'Male';
    CONST GENDER_WOMAN = 'Female';
    CONST NO_GENDER_TXT = 'CHOOSE_CORECT_GENDER';


    /*
     * WORLDS
     */

    CONST ACTION = 'Action';
    CONST MATTER = 'Matter';
    CONST INFORMATION = 'Information';
    CONST FEELING = 'Feeling';
    CONST FUN = 'Fun';
    CONST USABILITY = 'Usability';
    CONST RELATIONS = 'Relations';
    CONST DESIRE = 'Desire';
    CONST SEEK = 'Seek';
    CONST CAREER = 'Career';
    CONST FUTURE = 'Future';
    CONST SPIRITUAL = 'Spiritual';

        /*
         * WORLD COLORS
         */
                CONST HEXACTION = '#F5202B';
                CONST HEXMATTER = '#FF541C';
                CONST HEXINFORMATION = '#FF8E2E';
                CONST HEXFEELING = '#FFAE30';
                CONST HEXFUN = '#FFE119';
                CONST HEXUSABILITY = '#92FF0C';
                CONST HEXRELATIONS = '#00E859';
                CONST HEXDESIRE = '#0EB89E';
                CONST HEXSEEK = '#2943F7';
                CONST HEXCAREER = '#1A12B5';
                CONST HEXFUTURE = '#9027C4';
                CONST HEXSPIRITUAL = '#B5A0FF';


    /*
     * LAZY LOADING
     */


    /*
     * PAYMENTS
     */
            /*
             * PAYPAL
             */
                    CONST PAYPAL_ID = '';
                    CONST PAYPAL_SANDBOX = TRUE;
                    CONST PAYPAL_SUCCESS_URL = '';
                    CONST PAYPAL_CANCEL_URL = '';
                    CONST PAYPAL_NOTIFY_URL = '';
                    CONST PAYPAL_CURRENCY = '';

}