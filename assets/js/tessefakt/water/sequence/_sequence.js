var cTessefaktSequence=class{
	_oMdf;
	_oEvents={};
	destructor(){
		delete this._oEvents;
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
	import(objects){
		return this._fromObject(objects);
	}
	export(){
		return this._toObject();
	}
	formerExport(){
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