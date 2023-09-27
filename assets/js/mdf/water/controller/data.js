var cMdfControllerData=class extends cMdfController{
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
					target._oSubjects[key]=new cMdfControllerSequences({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'sequence':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cMdfSequenceTable({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'collections':
				if(!target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cMdfControllerCollections({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'collection':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cMdfCollectionTable({
						mdf:target._oMdf,
						controller:target
					});
				}
				return target._oSubjects[key];
			case 'set':
				if(target._oSubjects[key]==undefined){
					target._oSubjects[key]=new cMdfCollectionSet({
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
				if(value instanceof cMdfControllerSequences){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cMdfControllerSequences({
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
				if(value instanceof cMdfSequenceTable){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cMdfSequenceTable({
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
				if(value instanceof cMdfControllerCollections){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cMdfControllerCollections({
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
				if(value instanceof cMdfCollectionTable){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cMdfCollectionTable({
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
				if(value instanceof cMdfCollectionSet){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=value;
					var e=new Event('change');
					Object.defineProperty(e,'target',{value:target,writable:false});
					target.dispatchEvent(e);
					return true;
				}else if(target._oSubjects[key]==undefined){
					target._oFormer={...target._oSubjects};
					target._oSubjects[key]=new cMdfCollectionTable({
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
						target._oSubjects[sKey]=new cMdfControllerSequences({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'sequence':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cMdfSequenceTable({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'collections':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cMdfControllerCollections({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'collection':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cMdfCollectionTable({
							mdf:target._oMdf,
							controller:target
						});
					}
					target._oSubjects[sKey].parse(values[sKey]);
					return true;
				case 'set':
					if(target._oSubjects[sKey]==undefined){
						target._oSubjects[sKey]=new cMdfCollectionSet({
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
					if(!objects[sKey] instanceof cMdfControllerSequences){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'sequence':
					if(!objects[sKey] instanceof cMdfSequenceTable){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'collections':
					if(!objects[sKey] instanceof cMdfControllerCollections){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'collection':
					if(!objects[sKey] instanceof cMdfCollectionTable){
						throw new Error('Key "'+sKey+'" wrong type');
					}
					break;
				case 'set':
					if(!objects[sKey] instanceof cMdfCollectionSet){
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
		var oClone=new cMdfControllerData({
			mdf:this._oMdf,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};