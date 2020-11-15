
var WindowBuilder = class  Builder{

    setIdentifier(target,classname,id){
        if(classname != StringEnum.EMPTY){
            target.className = classname;
        }

        if(id != StringEnum.EMPTY){
            target.id = id;
        }
        return target;
    }

    createDiv(classname,id, text){
        var Div = document.createElement(Elements.DIV);
        if(text !== StringEnum.EMPTY){
            var Text = document.createTextNode(text);
            Div.appendChild(Text);
        }
        return this.setIdentifier(Div,classname,id);
    }
    createLink(href,text,classname,id){
        var Link = document.createElement(Elements.A);
        var Text = document.createTextNode(text);
        Link.appendChild(Text);
        Link.href = href;
        return this.setIdentifier(Link,classname,id);
    }
    createButton(type,classname,id,text,listener){
        var Button = document.createElement(Elements.BUTTON);
        if(type === StringEnum.BUTTON || type === StringEnum.SUBMIT){
            Button.type = type;
            Button.textContent = text;
        }
        if(listener!== StringEnum.EMPTY){
            Button.setAttribute('onClick',listener);
        }
        return this.setIdentifier(Button,classname,id)
    }
    createImage(src,classname,id){
        var Image = document.createElement(Elements.IMAGE);
        Image.src = src;
        return this.setIdentifier(Image,classname,id);
    }
    createPARAGRAPH(text,classname,id){
        var PARAGRAPH = document.createElement(Elements.PARAGRAPH);
        PARAGRAPH.textContent = text;
        return this.setIdentifier(PARAGRAPH,classname,id);
    }
    createSpan(text,classname,id){
        var SPAN = document.createElement(Elements.SPAN);
        SPAN.textContent = text;
        return this.setIdentifier(SPAN,classname,id);
    }
}

var select = class Select{

    getFirstClass(className){
        var Target =  document.getElementsByClassName(className);
        if(Target.length > 0){
            return  Target[0];
        }
    }
    getAllClasses(className){
        return  document.getElementsByClassName(className);
    }
    getClassByIndex(classname, index){
        var Target =  document.getElementsByClassName(className);
        if(Target.length >= index){
            return  Target[index];
        }
    }
}

var carousel = class Carousel{
    #BUILDER;
    #TOTAL_PAGES;
    #SliderMain;
    #SliderCenter;
    #SliderFooter;
    #CreatedDotsMaps = [];
    #ActivePage;
    #NextBUTTON;
    #NextClickCounter=1;
    #CreatedPageMaps = [];

    constructor() {
        this.#BUILDER = new WindowBuilder();
    }
    setTotalPages(total){this.#TOTAL_PAGES = total;}
    getTotalPages(){return this.#TOTAL_PAGES;}

    getSliderMain(){return this.#SliderMain;}
    setSliderMain(main){this.#SliderMain = main;}

    getSliderCenter(){return this.#SliderCenter;}
    setSliderCenter(center){this.#SliderCenter = center;}

    getSliderFooter(){return this.#SliderFooter;}
    setSliderFooter(footer){this.#SliderFooter = footer;}

    getCreatedDotsMap(){return this.#CreatedDotsMaps;}
    setCreatedDotsMap(dot){this.#CreatedDotsMaps.push(dot);}

    getActivePage(){return this.#ActivePage;}
    setActivePage(page){this.#ActivePage = page;}

    getNextButton(){return this.#NextBUTTON;}
    setNextButton(button){this.#NextBUTTON = button;}

    getNextClickCounter(){return this.#NextClickCounter;}
    setNextclickCounter(counter){this.#NextClickCounter = counter;}

    getCreatedPageMap(){return this.#CreatedPageMaps;}
    setCreatedPageMap(page){this.#CreatedPageMaps.push(page);}


    CreateSlider(){
        this.setSliderMain(this.#BUILDER.createDiv('SliderMain Centered',StringEnum.EMPTY,StringEnum.EMPTY));
        this.setSliderCenter(this.#BUILDER.createDiv('SliderCenter',StringEnum.EMPTY,StringEnum.EMPTY));
        this.setSliderFooter(this.#BUILDER.createDiv('SliderFooter',StringEnum.EMPTY,StringEnum.EMPTY));

        this.getSliderMain().appendChild(this.getSliderCenter());
        this.getSliderMain().appendChild(this.getSliderFooter());
        return this.getSliderMain();
    }
    creatDots(){
        var total = this.getTotalPages();
        var dot = StringEnum.EMPTY;
        if(total !== undefined){
            for(var i=0; i < total; i++){
                 dot = this.#BUILDER.createSpan(StringEnum.EMPTY,StringEnum.DOT,i.toString());
                 this.getSliderFooter().appendChild(dot);
                 this.setCreatedDotsMap(dot);
            }
            this.setNextButton(this.#BUILDER.createButton(StringEnum.BUTTON, 'SliderNextBTN',StringEnum.EMPTY,StringEnum.NEXT, 'Slider.SwitchByNextButton(this)'));
            this.getNextButton().setAttribute(StringEnum.NEXT,StringEnum.ZERO);
            console.log(this.getCreatedDotsMap());
        }
    }

    removeDOt(index){
        var Dot = this.getCreatedDotsMap();
        if(Dot[index] !== undefined){
            this.getCreatedDotsMap().splice(index,1);
        }
    }
    hideDot(index){
        var Dots = this.getCreatedDotsMap();
        if(Dots[index] !== undefined){
            Dots[index].style.display = StringEnum.NONE
        }
    }
    createPages()
    {
        if(this.getNextClickCounter() <= this.getCreatedDotsMap().length)
        {
            for(var i =0; i < this.getCreatedDotsMap().length; i++)
            {
                var Page = this.#BUILDER.createDiv('SliderPage', StringEnum.EMPTY,'test ' +i);
                Page.setAttribute(StringEnum.IDENTIFIER,i);
                Page.style.display = StringEnum.NONE;
                this.getSliderMain().appendChild(Page);
                this.setCreatedPageMap(Page);
            }
            this.getCreatedPageMap()[0].style.display = StringEnum.BLOCK;
            console.log(this.getCreatedPageMap());
        }
    }

    ShowPage(){
        var TotalDots = this.getCreatedDotsMap();
        var ActivePage = this.getActivePage();
        if(TotalDots!=undefined){
            for(var i=0; i < TotalDots.length; i++){
                if(ActivePage.id == TotalDots[i].id){
                    TotalDots[i].style.opacity = '100';
                }else{
                    TotalDots[i].style.opacity = '0.22';
                }
            }
        }
    }
    RemovePageFromMap(index){
        var Pages = this.getCreatedPageMap();
        if(Pages[index] !== undefined){
            this.getCreatedPageMap().splice(index,1);
        }
    }
    RemovePageRenderer(identifier){
        var target = document.querySelectorAll('[identifier="'+identifier+'"]');
        if(target.length > 0){
            target[0].remove();
        }
    }

    ShowPageById(id){
        var TotalDots = this.getCreatedDotsMap();
        for(var i=0; i < TotalDots.length; i++){
            console.log(TotalDots[i].id);
            if(TotalDots[i].id == id){
                TotalDots[i].style.opacity = '100';
            }else{
                TotalDots[i].style.opacity = '0.22';
            }
        }
    }

    SwitchByNextButton(Event){
        var Target = parseInt(Event.getAttribute(StringEnum.NEXT));
        var Dots = this.getCreatedDotsMap().length;

        if(Target < Dots){
            Target = Target+1;
            this.getNextButton().setAttribute(StringEnum.NEXT, Target)
            if(this.getCreatedPageMap()[Target-1] !== undefined){
                this.getCreatedPageMap()[Target-1].style.display = StringEnum.NONE;
            }
            if(this.getCreatedPageMap()[Target] !== undefined){
                this.getCreatedPageMap()[Target].style.display = StringEnum.BLOCK;
            }
        }
    }
     
}


