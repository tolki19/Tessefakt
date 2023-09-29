var cTessefaktCourierArray=class extends cTessefaktCourier{
	_aValues=[];
	_aFormer;
	constructor({tessefakt,controller,courier,config,delivery}){
		super({tessefakt,controller,courier,config});
		if(delivery) this._aValues=[...delivery];
		else if(this._oConfig.value!=undefined) this._aValues=[...this._oConfig.value];
		else this._aValues=[];
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this),
			deleteProperty:this._del.bind(this),
			has:this._has.bind(this)
		});
	}
	destructor(){
		delete this._aFormer;
		delete this._aValues;
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
			case 'controller': return this._oController;
			case 'courier': return this._oCourier;
		}
		return target._aValue[key];
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
			case 'courier':
				throw new Error('Key "'+key+'" not allowed');
		}
		if(!(key in target._aValue)||target._aValue[key]!==value){
			target._aFormer=[...target._aValue];
			target._aValue[key]=value;
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
		}
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
			case 'courier':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._aValue;
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
			case 'courier':
				throw new Error('Key "'+key+'" not allowed');
		}
		if(key in target._aValue){
			target._aFormer=[...target._aValue];
			delete target._aValue[key];
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
		}
		return true;
	}
	_fromValue(values){
		this._aFormer=[...this._aValues];
		this._aValues=values;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
	}
	_toValue(){
		return [...this._aValues];
	}
	_toFormerValue(){
		return [...this._aFormer];
	}
	_fromObject(objects){
		this._aFormer=[...this._aValues];
		this._aValues=objects;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:target,writable:false});
		target.dispatchEvent(e);
		return true;
	}
	_toObject(){
		return this._aValues;
	}
	_toFormerObject(){
		return this._aFormer;
	}
	_clone(){
		var oClone=new cTessefaktCourierArray({
			tessefakt:this._oMdf,
			controller:this._oController,
			courier:this._oCourier,
			delivery:this.value()
		});
		return oClone;
	}
};