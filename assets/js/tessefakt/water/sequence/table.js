var cTessefaktSequenceTable=class extends cTessefaktSequence{
	_oController;
	_aSequence=[];
	_aFormer;
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
		delete this._aFormer;
		for(var sKey in this._aSequence) this._aSequence[sKey].destructor();
		delete this._aSequence;
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
		return target._aSequence[key];
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
		target._aFormer=[...this._aSequence];
		target._aSequence[key]=value;
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
		return key in target._aSequence;
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
		target._aFormer=[...this._aSequence];
		delete target._aSequence[key];
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
	}
	_fromValue(values){
		this._aFormer=[...this._aSequence];
		this._aSequence=values;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:this,writable:false});
		this.dispatchEvent(e);
	}
	_toValue(){
		return [...this._aSequence];
	}
	_toFormerValue(){
		return [...this._aFormer];
	}
	_fromObject(objects){
		this._aFormer=[...this._aSequence];
		this._aSequence=objects;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
	}
	_toObject(){
		return this._aSequence;
	}
	_toFormerObject(){
		return this._aFormer;
	}
	_clone(){
		var oClone=new cTessefaktSequenceTable({
			tessefakt:this._oTessefakt,
			controller:this._oController
		});
		oClone.parse(this.value());
		return oClone;
	}
};