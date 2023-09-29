var cTessefaktService=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
	}
	destructor(){
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
	}
	get water(){
		return this._oParent.water;
	}
	get bucket(){
		return this._oParent.bucket;
	}
};