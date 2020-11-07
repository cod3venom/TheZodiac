const EMPTY = '';
function Debug(status,data){
    if(data!=undefined){
        if(parseInt(status) > 0){
            console.log('[+] '+data.toString());
        }else{
            console.log('[-] '+data.toString());
        }
    }else{
        console.log('[X] UNDEFINED => '+data);
    }
}

var flag = class Flags{
    static OPERATOR = 'Operator.php';
    static TOO_BIG_FILE = 'TOO_BIG_FILE';
    static TOO_SHORT_PASSWORD = 'TOO_SHORT_PASSWORD';
    static SUCCESS = 1;
    static EMPTY = "";
    static ERROR_COLOR = "red";

    static EMAIL_INPUT = $("input[type='email']");
    static PASS_INPUT = $("input[type='password']");
    static DATE_INPUT = $("input[type='date']");
    static TEXT_INPUT = $("input[type='text']");
    static FILE_INPUT = $("input[type='file']");
    static SUBMIT_BTN = $("button[type='submit']");
    static NEXT_BTN = $('#NavigationNext');

    static AVATAR_PLACEHOLDER = $("#whitePlaceHolderTitle");
}
var net = class Network{
    Post(addr,param)
    {
        var content =  $.ajax({
            url:addr, type:"POST", data:param, cache:false, async:false,
            success:function(result) {
                console.log(result);
            },
        }).responseText;
        return content;
    }
    BuldQuery(param,value,next){
        var out = "";
        if(param != undefined && value != undefined && next!=undefined){
            if(next ===1){
                out = "&"+param + "="+value+"&";
            }else{
                out = param + "="+value+"&";
            }
            return  out;
        }
    }
}
var HTML = class HTML{
    #Dots_Pack;
    #TOTAL_ELEMENTS;


    getTotalElements(){return this.#TOTAL_ELEMENTS;}
    setTotalElements(total){
        this.#TOTAL_ELEMENTS = total;
    }
    CreateDots(){
        var output = EMPTY;
        Debug(1,this.#TOTAL_ELEMENTS);
        for(var i=0; i < this.#TOTAL_ELEMENTS; i++){
            output += '<span class="Dot" id="dot_'+i+'"></span>';
        }
        return output;
    }
    Appendclass(target,value){
        target.removeClass(value);
        target.toggleClass(value);
    }

    AddAttribute(target,attr,value){
        target.attr(attr,value);
    }
    RemoveElement(target){
        $(target).remove();
    }

    displayStatus(target){
        if(target!=undefined){
            return  $(target).css("display");
        }
    }
}
var RegistSlider = class RegistrationSlider extends HTML{
    #mainForm;
    #FirstStep;
    #Slider;
    #Body;
    #Footer;
    #ActualSlider;

    constructor() {
        super();
        this.#mainForm = $('#RegisterForm');
        this.#FirstStep = $('#RegisterForm > .step:nth-child(1)')
        this.#Slider = $('#step_slider');
        this.#Body = $('#step_slider>#slider>#body');
        this.#Footer = $('#dots');
    }
    getActualSlider(){return this.#ActualSlider;}
    setActualSlider(id){this.#ActualSlider = $('#slider_'+id);}
    getActualId(){return this.#ActualSlider.attr('id');}

    hideMainForm(){this.#mainForm.slideUp('slow');}
    showMainForm(){this.#mainForm.slideDown('slow');}

    hideStep(target){$(target).slideUp('slow');}
    showStep(target,flex){
        $(target).slideDown('slow');
        if(flex === 'flex'){
            $(target).css('display','flex');
        }
    }

    addFooter(total){
        this.setTotalElements(total)
        this.#Footer.append(this.CreateDots());
    }

    notActive(target){
        $(target).css("opacity", 0.22);
    }
    setActive(target){
        $(target).css("opacity",100);
    }



}
var AvatarManager = class Avatar{
    #Image;
    #ImageName;
    #IMAGEPATH;
    #Extensions;
    #Target;
    #Event;



    getEvent(){return this.#Event;}
    setevent(Event){
        this.#Event = Event;
    }

    getImage(){return this.#Image;}
    setImage(Image){this.#Image = Image;}

    setImageName(name){this.#ImageName = name;}
    getImageName(){return this.#ImageName;}

    getExtension(){return this.#Extensions;}
    setExtension(){
        if(this.getImageName() != undefined && this.getImageName().includes('.'))
        {
            var dotPtr = this.getImageName().match(/\./g).length;
            var ext = this.getImageName().split(".")[dotPtr];
            if(ext === 'jpg' || ext==='jpeg' || ext === 'png'){
                this.#Extensions = ext;
            }
        }
    }

    getTarget(){return this.#Target;}
    setTarget(Target){this.#Target = $(Target);}

    getImagePath(){return this.#IMAGEPATH;}
    setImagePath(path){this.#IMAGEPATH = path;}

    setBackground(){
        this.getTarget().css('background-image','url('+this.getImagePath()+')');
        this.getTarget().css('background-size','cover');
    }

}

var Plan = class Plans{
        #plan_key;

        getPlanKey(){return this.#plan_key;}
        setPlanKey(key){this.#plan_key = key;}

        checkKey(){
            var network = new net();
            var request = network.BuldQuery("payment","",0);
            request += network.BuldQuery("check_key",this.getPlanKey(),0);
            return "ok";
        }
}

var SignUp = class Registration{
    #Stack;

    getStack(){return this.#Stack;}
    setStack(stack){this.#Stack = stack;}

    Push(){
        var stack = this.getStack();
        if(stack != undefined){
            var Response = new net().Post(flag.OPERATOR,stack);
            if(Response === flag.TOO_BIG_FILE){
                alert("big file");
            }
            if(Response === flag.TOO_SHORT_PASSWORD){
                alert("short pass");
            }
            if(Response === flag.SUCCESS){
                alert("success");
            }
        }
    }
}



var Colors = class Colours{
    #Action             = '#F5202B';
    #Fun                = '#FFE119';
    #Seek               = '#2943F7';
    #Matter             = '#FF541C';
    #Usability          = '#92FF0C';
    #Career             = '#1A12B5';
    #Information        = '#FF8E2E';
    #Relations          = '#00E859';
    #Future             = '#9027C4';
    #Feeling            = '#FFAE30';
    #Desire             = '#0EB89E';
    #Spiritual          = '#B5A0FF';

    getAction()         {return this.#Action;}
    getFun()            {return this.#Fun;}
    getSeek()           {return this.#Seek;}
    getMatter()         {return this.#Matter;}
    getUsability()      {return this.#Usability;}
    getCareer()         {return this.#Career;}
    getInformation()    {return this.#Information;}
    getRelations()      {return this.#Relations;}
    getFuture()         {return this.#Future;}
    getFeeling()        {return this.#Feeling;}
    getDesire()         {return this.#Desire;}
    getSpiritual()      {return this.#Spiritual;}

    ReColor(){
        $("input[type='checkbox'][name='Action']").css("border","1px solid "+this.getAction());
        $("input[type='checkbox'][name='Fun']").css("border","1px solid "+this.getFun());
        $("input[type='checkbox'][name='Seek']").css("border","1px solid "+this.getSeek());
        $("input[type='checkbox'][name='Matter']").css("border","1px solid "+this.getMatter());
        $("input[type='checkbox'][name='Usability']").css("border","1px solid "+this.getUsability());
        $("input[type='checkbox'][name='Career']").css("border","1px solid "+this.getCareer());
        $("input[type='checkbox'][name='Information']").css("border","1px solid "+this.getInformation());
        $("input[type='checkbox'][name='Relations']").css("border","1px solid "+this.getRelations());
        $("input[type='checkbox'][name='Future']").css("border","1px solid "+this.getFuture());
        $("input[type='checkbox'][name='Feeling']").css("border","1px solid "+this.getFeeling());
        $("input[type='checkbox'][name='Desire']").css("border","1px solid "+this.getDesire());
        $("input[type='checkbox'][name='Spiritual']").css("border","1px solid "+this.getSpiritual());

    }
    setCheckBoxBackground(obj){
        if(obj!=undefined){
            var target = 'input[type="checkbox"][name="'+obj.getAttribute("name")+'"]:checked';
            var clean = 'input[type="checkbox"][name="'+obj.getAttribute("name")+'"]';
            $(clean).css("background-color","transparent");

            switch (obj.getAttribute("name")) {
                case "Action":
                    $(target).css("background-color",this.getAction());
                break;
                case "Matter":
                    $(target).css("background-color",this.getMatter());
                    break;
                case "Information":
                    $(target).css("background-color",this.getInformation());
                    break;
                case "Feeling":
                    $(target).css("background-color",this.getFeeling());
                    break;
                case "Fun":
                    $(target).css("background-color",this.getFun());
                    break;
                case "Usability":
                    $(target).css("background-color",this.getUsability());
                    break;
                case "Relations":
                    $(target).css("background-color",this.getRelations());
                    break;
                case "Desire":
                    $(target).css("background-color",this.getDesire());
                    break;
                case "Seek":
                    $(target).css("background-color",this.getSeek());
                    break;
                case "Career":
                    $(target).css("background-color",this.getCareer());
                    break;
                case "Future":
                    $(target).css("background-color",this.getFuture());
                    break;
                case "Spiritual":
                    $(target).css("background-color",this.getSpiritual());
                    break;

            }
        }
    }
}
var ModalsWindow = class Modal{
    #MODAL;
    #LOGO;
    #HEADER;
    #HEADERTITLE;
    #HEADERTITLECOLOR;
    #HEADERBACKGROUND;

    getModal(){return this.#MODAL;}
    setModal(modal){this.#MODAL = $(modal);}
    setModalBackground(color){this.getModal().css("background-color",color);}

    getLogo(){return this.#LOGO;}
    setLogo(logo){
        this.getModal().find("div[class='Modal-Logo']").html(logo);
        this.#LOGO = this.getModal().find("div[class='Modal-Logo']");
    }
    setLogoPosition(position){
        if(position === "left" || position === "center" || position === "right"){
            if(position === "left"){
                this.getLogo().children().css("float","left");
            }
            if(position === "center"){
                this.getLogo().toggleClass("Centered");
            }
            if(position === "right"){
                this.getLogo().children().css("float","right");
            }
        }
    }
    getHeader(){return this.#HEADER;}
    setHeader(target){this.#HEADER = $(target);}
    getHeaderTitle(){return this.#HEADERTITLE;}
    setHeaderTitle(title){
        this.getModal().find("span[class='Modal-Title']").text(title);
        this.#HEADERTITLE = this.getModal().find("span[class='Modal-Title']");
    }
    getHeaderTitleColor(){return this.#HEADERTITLECOLOR;}
    setHeaderTitleColor(color){this.#HEADERTITLECOLOR = color;}
    getHeaderBackground(){return this.#HEADERBACKGROUND;}
    setHeaderBackground(color){this.#HEADERTITLECOLOR = color;}


    showModal(){
        var modal = this.getModal();
        if(modal !=undefined){
            modal.css("display","block");
        }
    }
    closeModal(){
        var modal = this.getModal();
        if(modal!=undefined){
            modal.css("display","none");
        }
    }
}