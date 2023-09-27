var cMdfElementText=class extends cMdfElement{
	_oMdf;
	_oParent;
	_oConfig;
	_oWater;
	_aSubjects=[];
	constructor({mdf,parent,config,water}){
		super();
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._oWater=water;
		this._display();
	}
	_display(){
		var aStack=this._oConfig.text.split(/(\r\n|\r|\n)/);
		for(var i=0;i<aStack.length;++i){
			if(aStack[i].match(/(?:\r\n|\r|\n)/)) this._aSubjects.push(this._oParent.inject.appendChild(document.createElement('br')));
			else this._aSubjects.push(this._oParent.inject.appendChild(document.createTextNode(aStack[i])));
		}
	}
	presentLoading(){}
	presentUpdate(){}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].parentNode.removeChild(this._aSubjects[i]);
		}
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._oWater;
		delete this._aSubjects;
	}
	get water(){
		return this._oWater;
	}
};