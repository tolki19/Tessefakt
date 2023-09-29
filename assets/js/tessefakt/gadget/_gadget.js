var cTessefaktGadget=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dElement;
	constructor({tessefakt,parent,config,element}){
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dElement=element;
	}
	destructor(){
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._dElement;
	}
	get water(){
		return this._oParent.water;
	}
};