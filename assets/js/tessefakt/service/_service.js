var cTessefaktService=class{
	_oMdf;
	_oParent;
	_oConfig;
	constructor({tessefakt,parent,config}){
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
	}
	destructor(){
		delete this._oMdf;
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