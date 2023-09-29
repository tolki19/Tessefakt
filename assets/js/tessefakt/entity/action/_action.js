var cTessefaktEntityAction=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_oWater;
	_dLi;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
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
		delete this._oTessefakt;
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