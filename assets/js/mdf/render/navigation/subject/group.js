var cTessefaktRenderNavigationSubjectGroup=class{
	_oMdf;
	_oParent;
	_oConfig;
	_oSubjectMenu;
	_sDescriptor;
	_dLi;
	_dInput;
	_dLabel;
	_dDiv;
	_dI;
	_dSpan;
	constructor({mdf,parent,config,descriptor}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._sDescriptor=descriptor;
		this._dLi=new Element('li').inject(this._oParent.inject);
		this._dInput=new Element('input#'+this._sDescriptor,{type:'checkbox'}).inject(this._dLi);
		this._dLabel=new Element('label',{
			for:this._sDescriptor,
			tabindex:'0'
		}).inject(this._dLi);
		if(this._oConfig.icon){
			this._dI=new Element('i').inject(this._dLabel);
			this._dI.style.webkitMaskImage='url("'+this._oConfig.icon+'")';
			this._dI.style.maskImage='url("'+this._oConfig.icon+'")';
		}
		if(this._oConfig.caption){
			this._dSpan=new Element('span',{html:this._oConfig.caption}).inject(this._dLabel);
		}
		this._dDiv=new Element('div').inject(this._dLi);
		this._oSubjectMenu=new cTessefaktRenderNavigationDepartment({mdf:this._oMdf,parent:this,config:this._oConfig,descriptor:this._sDescriptor});
	}
	destructor(){
		if(this._dI) this._dI.dispose();
		if(this._dSpan) this._dSpan.dispose();
		this._dLi.dispose();
		this._dInput.dispose();
		this._dLabel.dispose();
		this._dDiv.dispose();
		this._oSubjectMenu.destructor();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._oSubjectMenu;
		delete this._sDescriptor;
		delete this._dLi;
		delete this._dInput;
		delete this._dLabel;
		delete this._dDiv;
		delete this._dI;
		delete this._dSpan;
	}
	flag(sKey){
		if(this._oSubjectMenu.flag(sKey)){
			this._dInput.checked=true;
			return true;
		}
		return false;
	}
	unflag(sKey){
		if(this._oSubjectMenu.unflag(sKey)){
			return false;
		}
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dDiv;
	}
};
