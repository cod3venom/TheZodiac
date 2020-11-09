var slider = new RegistSlider();
var html = new HTML();
var avatar = new AvatarManager();
var plan = new Plan();
var color = new Colors();
var modal = new ModalsWindow();

$("#RegisterNextBtn0").click(function (e){
    if(flag.EMAIL_INPUT.val() === flag.EMPTY){
        flag.EMAIL_INPUT.css("border","1px solid "+flag.ERROR_COLOR);
    }
    else if(flag.PASS_INPUT.val() === flag.EMPTY){
        flag.PASS_INPUT.css("border","1px solid "+flag.ERROR_COLOR);
    }
    else
    {

        html.AddAttribute($('#slideNavigation'), 'style', 'display:flex;');
        html.Appendclass($('#slideNavigation'), 'Centered');
        slider.hideStep('#MainStep');
        slider.showStep('#step_slider', '');
        slider.showStep('#slider_0', '');
        slider.setActualSlider('0');
        slider.addFooter(2)
        slider.notActive('#dot_1');

    }
});



$('#NavigationNext').click(function (){
    if(slider.getActualId() === 'slider_0'){
        if(flag.TEXT_INPUT.val() === flag.EMPTY){
            flag.TEXT_INPUT.css("border","1px solid "+flag.ERROR_COLOR);
        }
        else if(flag.DATE_INPUT.val() === flag.EMPTY){
            flag.DATE_INPUT.css("border","1px solid "+flag.ERROR_COLOR);
        }
        else
        {

            slider.hideStep(slider.getActualSlider());
            slider.showStep('#slider_1','');
            slider.setActualSlider('1');

            slider.setActive('#dot_1');
            slider.notActive('#dot_0');
            slider.notActive('#dot_2');
            //flag.NEXT_BTN.attr('type','submit');
        }

        return;
    }

    if(slider.getActualId() === 'slider_3'){
        html.AddAttribute($('#slider_4'),'style','display:flex;');
        html.Appendclass($('#slider_4'),'Centered');

        slider.hideStep(slider.getActualSlider());
        slider.showStep('#slider_4','');
        slider.setActualSlider('1');

        slider.setActive('#dot_1');
        slider.notActive('#dot_0');
        return;
    }

});

$('#whitePlaceHolder').click(function(e){
    $('#avatarBrowser').get(0).click();
});

function pushAvatar(input){
    avatar.setevent(input);
    avatar.setImage(avatar.getEvent().files[0]);
    avatar.setImageName(avatar.getEvent().files[0].name);
    avatar.setExtension();
    avatar.setTarget("#whitePlaceHolder");
    html.RemoveElement("#plusIcon");
    var url = URL.createObjectURL(avatar.getImage());
    avatar.setImagePath(url);
    avatar.setBackground();

}

function choosePlan(object){
    if(object!=undefined){
        plan.setPlanKey(object.getAttribute('key'));
        var status = plan.checkKey();
        slider.hideStep(".freeOption");
    }
}

$("#filterIcon").click(function (){
    var status = html.displayStatus("#FilterContainer");
    if(status==="none"){
        $("#UserFinderForm").css("border-top-left-radius","10px");
        $("#UserFinderForm").css("border-bottom-left-radius","10px");
        $("#FilterContainer").slideDown('slow');
        $("#FoundedOwnUsers").css("margin-top","50%");

    }else{
        $("#UserFinderForm").css("border-radius","10px");
        $("#FilterContainer").slideUp('slow');
        $("#FoundedOwnUsers").css("margin-top","5%");
    }
});

$(".Modal-Close").click(function (){
    modal.closeModal();
});


function addNewUserSliderLoader(){
    html.AddAttribute($('#slideNavigation'),'style','display:flex;');
    html.Appendclass($('#slideNavigation'),'Centered');

    slider.showStep('#slider_3','');
    slider.setActualSlider('3');
    slider.addFooter(2)
    slider.notActive('#dot_1');
}




