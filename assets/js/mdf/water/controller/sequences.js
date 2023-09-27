var cTessefaktControllerSequences=class extends cTessefaktController{
	_oController;
	_oSequences={};
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
		for(var sKey in this._oSequences) this._oSequences[sKey].destructor();
		delete this._oSequences;
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
		if(target._oSequences[key]==undefined){
			return new cTessefaktSequenceTable({
				mdf:target._oMdf,
				controller:target
			});
		}
		return target._oSequences[key];
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
		if(target._oSequences[key]==undefined){
			this._oFormer={...target._oSequences};
			target._oSequences[key]=new cTessefaktSequenceTable({
				mdf:target._oMdf,
				controller:target
			});
			target._oSequences[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else if(target._oSequences.value!==value){
			this._oFormer={...target._oSequences};
			target._oSequences[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else{
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
		return key in target._oSequences;
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
		this._oFormer={...target._oSequences};
		target._oSequences[key].destructor();
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
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in values){
			if(this._oSequences[sKey]==undefined){
				this._oSequences[sKey]=new cTessefaktSequenceTable({
					mdf:this._oMdf,
					controller:this
				});
			}
			this._oSequences[sKey].parse(values[sKey]);
		}
		return true;
	}
	_toValue(){
		var oSequences={};
		for(var sKey in this._oSequences) oSequences[sKey]=this._oSequences[sKey].value;
		return oSequences;
	}
	_toFormerValue(){
		var oSequences={};
		for(var sKey in this._oFormer) oSequences[sKey]=this._oFormer[sKey].value;
		return oSequences;
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
			if(this._oSequences[sKey]==undefined){
				this._oSequences[sKey]=new cTessefaktSequenceTable({
					mdf:this._oMdf,
					controller:this
				});
			}
			this._oSequences[sKey]=objects[sKey];
		}
		return true;
	}
	_toObject(){
		return {...this._oSequences};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktControllerSequences({
			mdf:this._oMdf,
			controller:this._oController
		});
		oClone.import(this.export());
		return oClone;
	}
};