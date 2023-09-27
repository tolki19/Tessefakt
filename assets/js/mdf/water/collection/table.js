var cTessefaktCollectionTable=class extends cTessefaktCollection{
	_oController;
	_oSets={};
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
		for(var sKey in this._oSets) this._oSets[sKey].destructor();
		delete this._oSets;
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
		if(target._oSets[key]==undefined){
			target._oFormer={...this._oSets};
			target._oSets[key]=new cTessefaktCollectionSet({
				mdf:target._oMdf,
				table:target
			});
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return target._oSets[key];
		}else{
			return target._oSets[key];
		}
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
		if(target._oSets[key]==undefined){
			target._oFormer={...this._oSets};
			target._oSets[key]=new cTessefaktCollectionSet({
				mdf:target._oMdf,
				table:target
			});
			target._oSets[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else{
			target._oFormer={...this._oSets};
			target._oSets[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
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
			case 'clone':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._oSets;
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
		target._oFormer={...this._oSets};
		target._oSets[key].destructor();
		delete target._oSets[key];
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
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in values){
			this._oSets[sKey]=new cTessefaktCollectionSet({
				mdf:this._oMdf,
				table:this
			});
			this._oSets[sKey].parse(values[sKey]);
		}
		return true;
	}
	_toValue(){
		var oSets={};
		for(var sKey in this._oSets) oSets[sKey]=this._oSets[sKey].value;
		return oSets;
	}
	_toFormerValue(){
		var oSets={};
		for(var sKey in this._oFormer) oSets[sKey]=this._oFormer[sKey].value;
		return oSets;
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
		for(var sKey in objects) this._oSets[sKey]=objects[sKey];
		return true;
	}
	_toObject(){
		return {...this._oSets};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktCollectionTable({
			mdf:this._oMdf,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};