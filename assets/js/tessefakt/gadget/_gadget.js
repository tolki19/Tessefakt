var cTessefaktGadget=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dElement;
	constructor({tessefakt,parent,config,element}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dElement=element;
	}
	destructor(){
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dElement;
	}
	get water(){
		return this._oParent.water;
	}
};