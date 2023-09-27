var cTessefaktService=class{
	_oMdf;
	_oParent;
	_oConfig;
	constructor({mdf,parent,config}){
		this._oMdf=mdf;
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