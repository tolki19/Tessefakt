var cTessefaktControllerCollections=class extends cTessefaktController{
	_oController;
	_oCollections={};
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
		for(var sKey in this._oCollections) this._oCollections[sKey].destructor();
		delete this._oCollections;
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
		}
		if(target._oCollections[key]==undefined){
			return new cTessefaktCollectionTable({
				mdf:target._oMdf,
				controller:target
			});
		}
		return target._oCollections[key];
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
		this._oFormer={...target._oCollections};
		if(target._oCollections[key]==undefined){
			target._oCollections[key]=new cTessefaktCollectionTable({
				mdf:target._oMdf,
				controller:target
			});
		}
		target._oCollections[key].parse(value);
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
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
		return key in target._oCollections;
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
				case 'export':
				case 'import':
				case 'formerExport':
				case 'clone':
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in values){
			if(this._oCollections[sKey]==undefined){
				this._oCollections[sKey]=new cTessefaktCollectionTable({
					mdf:this._oMdf,
					controller:this
				});
			}
			this._oCollections[sKey].parse(values[sKey]);
		}
		return true;
	}
	_toValue(){
		var oCollections={};
		for(var sKey in this._oCollections) oCollections[sKey]=this._oCollections[sKey].value;
		return oCollections;
	}
	_toFormerValue(){
		var oCollections={};
		for(var sKey in this._oFormer) oCollections[sKey]=this._oFormer[sKey].value;
		return oCollections;
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
				case 'export':
				case 'import':
				case 'formerExport':
				case 'clone':
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in objects){
			this._oCollections[sKey]=objects[sKey];
		}
		return true;
	}
	_toObject(){
		return {...this._oCollections};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerCollections({
			mdf:this._oMdf,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};