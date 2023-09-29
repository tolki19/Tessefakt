var cTessefaktControllerBucket=class extends cTessefaktController{
	_oController;
	_oSubjects={};
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
		for(var sKey in this._oSubjects) this._oSubjects[sKey].destructor;
		delete this._oSubjects;
		delete this._oController;
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
			case 'couriers':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktControllerCouriers({
						tessefakt:target._oTessefakt,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'data': 
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktControllerData({
						tessefakt:target._oTessefakt,
						controller:target
					});
				}
				return target._oSubjects[key];
		}
		throw new Error('Key "'+key+'" not allowed');
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
			case 'couriers':
				if(value instanceof cTessefaktControllerCouriers){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktControllerCouriers({
						tessefakt:target._oTessefakt,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}
			case 'data':
				if(value instanceof cTessefaktControllerData){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktControllerData({
						tessefakt:target._oTessefakt,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}
		}
		throw new Error('Key "'+key+'" not allowed');
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
			case 'couriers':
			case 'data':
				return key in target._oSubjects;
		}
		throw new Error('Key "'+key+'" not allowed');
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
			case 'couriers':
			case 'data':
				target._oFormer={...this._oBuckets};
				target._oBuckets[key].destructor();
				delete target._oBuckets[key];
				var e=new Event('change');
				Object.defineProperty(e,'target',{value:target,writable:false});
				target.dispatchEvent(e);
				return true;
		}
		throw new Error('Key "'+key+'" not allowed');
	}
	_fromValue(values){
		for(var sKey in values){
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
				default:
					throw new Error('Key "'+sKey+'" not allowed');
				case 'couriers':
				case 'data':
					break;
			}
		}
		for(var sKey in values){
			switch(sKey){
				case 'couriers':
					if(this._oSubjects[sKey]==undefined){
						this._oSubjects[sKey]=new cTessefaktControllerCouriers({
							tessefakt:this._oTessefakt,
							controller:this
						});
					}
					this._oSubjects[sKey].parse(object[sKey]);
					return true;
				case 'data':
					if(this._oSubjects[sKey]==undefined){
						this._oSubjects[sKey]=new cTessefaktControllerData({
							tessefakt:this._oTessefakt,
							controller:this
						});
					}
					this._oSubjects[sKey].parse(object[sKey]);
					return true;
			}
			throw new Error('Key "'+sKey+'" not allowed');
		}
	}
	_toValue(){
		var oSubjects={};
		for(var sKey in this._oSubjects) oSubjects[sKey]=this._oSubjects[sKey].value;
		return oSubjects;
	}
	_toFormerValue(){
		var oSubjects={};
		for(var sKey in this._oFormer) oSubjects[sKey]=this._Former[sKey].value;
		return oSubjects;
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
				default:
					throw new Error('Key "'+sKey+'" not allowed');
				case 'couriers':
				case 'data':
					break;
			}
		}
		for(var sKey in objects){
			this._oSubjects[sKey]=objects[sKey];
		}
	}
	_toObject(){
		return {...this._oSubjects};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerBucket({
			tessefakt:this._oTessefakt,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};