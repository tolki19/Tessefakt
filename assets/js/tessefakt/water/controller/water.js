var cTessefaktControllerWater=class extends cTessefaktController{
	_oBuckets={};
	_oFormer;
	constructor({tessefakt}){
		super();
		this._oTessefakt=tessefakt;
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this),
			deleteProperty:this._del.bind(this),
			has:this._has.bind(this)
		});
	}
	destuctor(){
		delete this._oFormer;
		for(var sKey in this._oBuckets) this._oBuckets[sKey].destructor();
		delete this._oBuckets;
		super.destructor();
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
			case 'couriers':
				if(target._oBuckets[key]==undefined){
					target._oBuckets[key]=new cTessefaktControllerCouriers({
						tessefakt:target._oTessefakt,
						controller:target
					});
				}
				return target._oBuckets[key];	
			case 'data': 
				if(target._oBuckets[key]==undefined){
					target._oBuckets[key]=new cTessefaktControllerData({
						tessefakt:target._oTessefakt,
						controller:target
					});
				}
				return target._oBuckets[key];	
		}
		if(target._oBuckets[key]==undefined){
			target._oBuckets[key]=new cTessefaktControllerBucket({
				tessefakt:target._oTessefakt,
				controller:target
			});
		}
		return target._oBuckets[key];
	}
	_set(target,key,value){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
		switch(key){
			case 'destructor':
			case 'addEventListener':
			case 'dispatchEvent': 
			case 'removeEventListener':
			case 'import':
			case 'export':
			case 'formerExport':
			case 'clone':
				throw new Error('Key "'+key+'" not allowed');
			case 'couriers':
				if(value instanceof cTessefaktControllerCouriers){
					target._oFormer={...target._oBuckets};
					target._oBuckets[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oBuckets[key]==undefined){
					target._oFormer={...target._oBuckets};
					target._oBuckets[key]=new cTessefaktControllerCouriers({
						tessefakt:target._oTessefakt,
						controller:target
					});
					target._oBuckets[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oBuckets[key].parse(value);
					return true;
				}
			case 'data':
				if(value instanceof cTessefaktControllerData){
					target._oFormer={...target._oBuckets};
					target._oBuckets[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oBuckets[key]==undefined){
					target._oFormer={...target._oBuckets};
					target._oBuckets[key]=new cTessefaktControllerData({
						tessefakt:target._oTessefakt,
						controller:target
					});
					target._oBuckets[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oBuckets[key].parse(value);
					return true;
				}
		}
		if(value instanceof cTessefaktControllerBucket){
			target._oFormer={...target._oBuckets};
			target._oBuckets[key]=value;
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else if(target._oBuckets[key]==undefined){
			target._oFormer={...target._oBuckets};
			target._oBuckets[key]=new cTessefaktControllerBucket({
				tessefakt:target._oTessefakt,
				controller:target
			});
			target._oBuckets[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else{
			target._oBuckets[key].parse(value);
			return true;
		}
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
			case 'import':
			case 'export':
			case 'formerExport':
			case 'clone':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._oBuckets;
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
				throw new Error('Key "'+key+'" not allowed');
		}
		target._oFormer={...this._oBuckets};
		target._oBuckets[key].destructor();
		delete target._oBuckets[key];
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
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
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in values){
			switch(sKey){
				case 'couriers':
					if(!this._oBuckets[sKey]==undefined){
						this._oBuckets[sKey]=new cTessefaktControllerCouriers({
							tessefakt:this._oTessefakt,
							controller:this
						});
					}
					this._oBuckets[sKey].parse(values[sKey]);
					return true;
				case 'data':
					if(this._oBuckets[sKey]==undefined){
						this._oBuckets[sKey]=new cTessefaktControllerData({
							tessefakt:this._oTessefakt,
							controller:this
						});
					}
					this._oBuckets[sKey].parse(values[sKey]);
					return true;
				default:
					if(this._oBuckets[sKey]==undefined){
						this._oBuckets[sKey]=new cTessefaktControllerBucket({
							tessefakt:this._oTessefakt,
							controller:this
						});
					}
					this._oBuckets[sKey].parse(values[sKey]);
					return true;
			}
		}
	}
	_toValue(){
		var oBuckets={};
		for(var sKey in this._oBuckets) oBuckets[sKey]=this._oBuckets[sKey].value;
		return oBuckets;
	}
	_toFormerValue(){
		var oBuckets={};
		for(var sKey in this._oFormer) oFormer[sKey]=this._oFormer[sKey].value;
		return oBuckets;
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
				case 'clone':
					throw new Error('Key "'+sKey+'" not allowed');
				case 'couriers':
					if(!objects[sKey] instanceof cTessefaktControllerCouriers) throw new Error('Key "'+sKey+'" wrong type');
				case 'data':
					if(!objects[sKey] instanceof cTessefaktControllerData) throw new Error('Key "'+sKey+'" wrong type');
				default:
					if(!objects[sKey] instanceof cTessefaktControllerBucket) throw new Error('Key "'+sKey+'" wrong type');
			}
		}
		for(var sKey in objects){
			this._oBuckets[sKey]=objects[sKey];
		}
	}
	_toObject(){
		return {...this._oBuckets};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerWater({
			tessefakt:this._oTessefakt
		});
		oClone.import(this.export());
		return oClone;
	}
};