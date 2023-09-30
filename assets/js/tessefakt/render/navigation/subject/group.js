var cTessefaktRenderNavigationSubjectGroup=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_sDescriptor;
	_dLi;
	_oMenu;
	constructor({tessefakt,parent,config,descriptor}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._sDescriptor=descriptor;
		this._dLi=new Element('li').inject(this._oParent.inject);
		this._oLabel=new cTessefaktRenderNavigationDisplayLabel({
			tessefakt:this._oTessefakt,
			parent:this
		});
		this._oMenu=new cTessefaktRenderNavigationDisplayMenu({
			tessefakt:this._oTessefakt,
			parent:this
		});
	}
	destructor(){
		this._oMenu.destructor();
		delete this._oMenu;
		this._oLabel.destructor();
		delete this._oLabel;
		this._dLi.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._sDescriptor;
		delete this._dLi;
	}
	flag(key){
		return this._oLabel.check(this._oMenu.flag(key));
	}
	unflag(key){
		return this._oLabel.check(this._oMenu.unflag(key));
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dLi;
	}
	get config(){
		return this._oConfig;
	}
	get descriptor(){
		return this._sDescriptor;
	}
};
