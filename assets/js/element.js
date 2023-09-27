'use strict';

var Element=class extends HTMLElement{
	constructor(descriptor,options){
		var classnames=[];
		var id;
		var name=descriptor;
		var boo;
		if(boo=name.match(/^\w+(\.|#)/)){
			while(boo){
				var match;
				if(match=name.match(/^\w+(\.(.*?))(\.|#|$)/)){
					name=name.replace(match[1],'');
					if(match[2]) classnames.push(match[2]);
				}else if(match=name.match(/^\w+(#(.*?))(\.|#|$)/)){
					name=name.replace(match[1],'');
					if(match[2]) id=match[2];
				}
				boo=name.match(/^\w+(\.|#)/);
			}
		}
		var element=document.createElement(name);
		if(classnames.length) for(var i=0;i<classnames.length;++i) element.addClass(classnames[i]); 
		if(id) element.id=id;
		for(var i in options??{}) switch(i){
			case 'html': element.innerHTML=options[i]; break;
			case 'events': element.addEvents(options[i]); break;
			case 'styles': element.setStyles(options[i]); break;
			case 'value': if('value' in element){ element.value=options[i]; break; }
			default: element.set(i,options[i]); break;
		}
		return element;
	}
};

HTMLElement.prototype.inject=function(obj){
	obj.appendChild(this);
	return this;
};

HTMLElement.prototype.dispose=function(){
	this.remove();
	return this;
};

HTMLElement.prototype.addClass=function(classname){
	this.classList.add(classname);
	return this;
};

HTMLElement.prototype.removeClass=function(classname){
	this.classList.remove(classname);
	return this;
};

HTMLElement.prototype.hasClass=function(classname){
	return this.classList.contains(classname);
};

HTMLElement.prototype.getStyle=function(name){
	return window.getComputedStyle(this).getPropertyValue(name);
};

HTMLElement.prototype.setStyle=function(name,value){
	name=name.camelize();
	this.style[name]=value;	return this;
};

HTMLElement.prototype.setStyles=function(o){
	for(var i in o) this.setStyle(i,o[i]);
	return this;
};

HTMLElement.prototype.addEvents=function(o){
	for(var i in o) this.addEvent(i,o[i]);
	return this;
};

HTMLElement.prototype.removeEvents=function(o){
	for(var i in o) this.removeEvent(i,o[i]);
	return this;
};

HTMLElement.prototype.addEvent=function(type,f){
	this.addEventListener(type,f,true);
	return this;
};

HTMLElement.prototype.removeEvent=function(type,f){
	this.removeEventListener(type,f,true);
	return this;
};

HTMLElement.prototype.fireEvent=function(type){
	this.dispatchEvent(new CustomEvent('change'));
	return this;
};

HTMLElement.prototype.set=function(name,value){
	switch(name){
		case 'html':
			this.innerHTML=value;
			break;
		default:
			this.setAttribute(name,value!=undefined?value:'');
			break;
	}
};

HTMLElement.prototype.get=function(name){
	switch(name){
		case 'html':
			return this.innerHTML;
			break;
		default:
			return this.getAttribute(name);
			break;
	}
};

HTMLElement.prototype.erase=function(name){
	switch(name){
		case 'html':
			this.innerHTML='';
			break;
		default:
			this.removeAttribute(name);
			break;
	}
};

String.prototype.camelize=function(){
	return this.charAt(0).toUpperCase()+this.slice(1);
}