var cTessefaktCourier=class{
	_oMdf;
	_oController;
	_oCourier;
	_oConfig;
	_oEvents={};
	constructor({tessefakt,controller,courier,config}){
		this._oMdf=tessefakt;
		this._oController=controller;
		this._oCourier=courier;
		this._oConfig=config;
	}
	destructor(){
		delete this._oEvents;
		delete this._oConfig;
		delete this._oCourier;
		delete this._oController;
		delete this._oMdf;
	}
	addEventListener(event,callback){
		if(this._oEvents[event]==undefined) this._oEvents[event]=[];
		this._oEvents[event].push(callback);
		return true;
	}
	removeEventListener(event,callback){
		if(this._oEvents[event]==undefined) return false;
		this._oEvents[event].splice(this._oEvents[event].indexOf(callback),1);
		return true;
	}
	dispatchEvent(e){
		for(var i=0;i<(this._oEvents[e.type]??[]).length;++i) this._oEvents[e.type][i](e);
		this._oCourier?.dispatchEvent(e);
		this._oController?.dispatchEvent(e);
	}
	parse(values){
		return this._fromValue(values);
	}
	value(){
		return this._toValue();
	}
	formerValue(){
		return this._toFormerValue();
	}
	parse(objects){
		return this._fromObject(objects);
	}
	value(){
		return this._toObject();
	}
	formerValue(){
		return this._toFormerObject();
	}
	clone(){
		return this._clone();
	}
	_get(target,key){
		throw new Error('Not implemented');
	}
	_set(target,key,value){
		throw new Error('Not implemented');
	}
	_has(target,key){
		throw new Error('Not implemented');
	}
	_del(target,key){
		throw new Error('Not implemented');
	}
	_fromValue(values){
		throw new Error('Not implemented');
	}
	_toValue(){
		throw new Error('Not implemented');
	}
	_toFormerValue(){
		throw new Error('Not implemented');
	}
	_fromObject(objects){
		throw new Error('Not implemented');
	}
	_toObject(){
		throw new Error('Not implemented');
	}
	_toFormerObject(){
		throw new Error('Not implemented');
	}
	_clone(){
		throw new Error('Not implemented');
	}
};
