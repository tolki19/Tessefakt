var cMdfEntityAction=class{
	_oMdf;
	_oParent;
	_oConfig;
	_oWater;
	_dLi;
	constructor({mdf,parent,config}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._display();
	}
	_display(){
		this._dLi=new Element('li',{'data-tessefakt-role':this._oConfig.type}).inject(this._oParent.inject);
	}
	presentLoading(){}
	presentUpdate(){}
	destructor(){
		this._dLi.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
	}
	refresh(){
		this._oParent.refresh();
	}
	get inject(){
		return this._dLi;
	}
	get water(){
		return this._oParent.water;
	}
};