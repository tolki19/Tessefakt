var cTessefaktControllerData=class extends cTessefaktController{
	_oController;
	_oSubjects={};
	_oFormer;
	constructor({mdf,controller}){
		super();
		this._oMdf=mdf;
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
		for(var sKey in this._oSubjects) this._oSubjects[sKey].destructor();
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
			case 'sequences':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktControllerSequences({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'sequence':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktSequenceTable({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'collections':
				if(!target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktControllerCollections({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'collection':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktCollectionTable({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'set':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cTessefaktCollectionSet({
						mdf:target._oMdf,
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
			case 'clone':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
			case 'sequences':
				if(value instanceof cTessefaktControllerSequences){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktControllerSequences({
						mdf:target._oMdf,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					return true;
				}
			case 'sequence':
				if(value instanceof cTessefaktSequenceTable){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktSequenceTable({
						mdf:target._oMdf,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					return true;
				}
			case 'collections':
				if(value instanceof cTessefaktControllerCollections){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktControllerCollections({
						mdf:target._oMdf,
						controlle:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					return true;
				}
			case 'collection':
				if(value instanceof cTessefaktCollectionTable){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktCollectionTable({
						mdf:target._oMdf,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
					return true;
				}
			case 'set':
				if(value instanceof cTessefaktCollectionSet){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cTessefaktCollectionTable({
						mdf:target._oMdf,
						controller:target
					});
					target._oSubjects[key].parse(value);
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else{
					target._oSubjects[key].parse(value);
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
			case 'sequences':
			case 'sequence':
			case 'collections':
			case 'collection':
			case 'set':
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
			case 'sequences':
			case 'sequence':
			case 'collections':
			case 'collection':
			case 'set':
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
				case 'sequences':
				case 'sequence':
				case 'collections':
				case 'collection':
				case 'set':
					break;
			}
		}
		for(var sKey in values){
			switch(sKey){
				case 'sequences':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cTessefaktControllerSequences({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'sequence':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cTessefaktSequenceTable({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'collections':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cTessefaktControllerCollections({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'collection':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cTessefaktCollectionTable({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'set':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cTessefaktCollectionSet({
							mdf:target._oMdf,
							collection:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
			}
		}
	}
	_toValue(){
		var oSubjects={};
		for(var sKey in this._oSubjects) oSubjects[sKey]=this._oSubjects[sKey].value;
		return oSubjects;
	}
	_toFormerValue(){
		var oSubjects={};
		for(var sKey in this._oFormer) oSubjects[sKey]=this._oFormer[sKey].value;
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
				case 'sequences':
					if(!objects[sKey] instanceof cTessefaktControllerSequences){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'sequence':
					if(!objects[sKey] instanceof cTessefaktSequenceTable){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'collections':
					if(!objects[sKey] instanceof cTessefaktControllerCollections){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'collection':
					if(!objects[sKey] instanceof cTessefaktCollectionTable){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'set':
					if(!objects[sKey] instanceof cTessefaktCollectionSet){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
			}
		}
		this._oSubjects[sKey]=objects[sKey];
	}
	_toObject(){
		return {...this._oSubjects};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerData({
			mdf:this._oMdf,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};