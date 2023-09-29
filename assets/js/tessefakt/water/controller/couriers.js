var cTessefaktControllerCouriers=class extends cTessefaktController{
	_oController;
	_oCouriers={};
	_oFormer;
	constructor({tessefakt,controller}){
		super();
		this._oTessefakt=tessefakt;
		this._oController=controller;
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this),
			deleteProperty:this._del.bind(this),
			has:this._has.bind(this)
		});
	}
	destructor(){
		delete this._oFormer;
		for(var sKey in this._oCouriers) this._oCouriers[sKey].destructor();
		delete this._oCouriers;
		super.destructor();
	}
	dispatchEvent(e){
		super.dispatchEvent(e);
		this._oController.dispatchEvent(e);
	}
	_get(target,key){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
		switch(key){
			case 'destructor':
			case 'addEventListener':
			case 'dispatchEvent': 
			case 'removeEventListener':
			case 'parse':
			case 'import':
				return target[key].bind(target);
			case 'value':
			case 'formerValue':
			case 'export':
			case 'formerExport':
			case 'clone':
				return target[key]();
			case 'controller': return target._oController;
		}
		return target._oCouriers[key];
	}
	_set(target,key,value){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
		switch(key){
			case 'destructor':
			case 'addEventListener':
			case 'dispatchEvent': 
			case 'removeEventListener':
			case 'parse':
			case 'value':
			case 'formerValue':
			case 'import':
			case 'export':
			case 'formerExport':
			case 'clone':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		if(value instanceof cTessefaktCourier){
			target._oCouriers[key]=value;
			return true;
		}
 		throw new Error('Wrong type');
	}
	_has(target,key){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
		switch(key){
			case 'destructor':
			case 'addEventListener':
			case 'dispatchEvent': 
			case 'removeEventListener':
			case 'parse':
			case 'value':
			case 'formerValue':
			case 'import':
			case 'export':
			case 'formerExport':
			case 'clone':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._oCouriers;
	}
	_del(target,key){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
		switch(key){
			case 'destructor':
			case 'addEventListener':
			case 'dispatchEvent': 
			case 'removeEventListener':
			case 'parse':
			case 'value':
			case 'formerValue':
			case 'import':
			case 'export':
			case 'formerExport':
			case 'clone':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		this._oFormer={...target._oCollections};
		target._oCollections[key].destructor();
		delete target._oBuckets[key];
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
	}
	_toValue(){
		var oCourier={};
		for(var sKey in this._oCouriers) oCourier[sKey]=this._oCouriers[sKey].value;
		return oCourier;
	}
	_toFormerValue(){
		var oCourier={};
		for(var sKey in this._oFormer) oCourier[sKey]=this._oFormer[sKey].value;
		return oCourier;
	}
	_fromObject(objects){
		for(var sKey in objects){
			if(sKey.match(/^_.*$/)) throw new Error('Key "'+sKey+'" not allowed');
			switch(sKey){
				case 'destructor':
				case 'addEventListener':
				case 'dispatchEvent': 
				case 'removeEventListener':
				case 'parse':
				case 'value':
				case 'formerValue':
				case 'import':
				case 'export':
				case 'formerExport':
				case 'clone':
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in objects){
			this._oCouriers[sKey]=objects[sKey];
		}
	}
	_toObject(){
		return {...this._oCouriers};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerCouriers({
			tessefakt:this._oTessefakt,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};