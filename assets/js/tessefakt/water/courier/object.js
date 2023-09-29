var cTessefaktCourierObject=class extends cTessefaktCourier{
	_oValues={};
	_oFormer;
	constructor({tessefakt,controller,courier,config,delivery={}}){
		super({tessefakt,controller,courier,config});
		if(this._oConfig.couriers){
			 for(var i=0;i<this._oConfig.couriers.length;++i){
				// this._oValues[this._oConfig.couriers[i].name]=new window['cTessefaktCourier'+this._oConfig.couriers[i].type.camelize()]({
				// 	tessefakt:this._oTessefakt,
				// 	courier:this,
				// 	config:this._oConfig.couriers[i]
				// });
				// this._oValues[this._oConfig.couriers[i].name].parse(delivery[this._oConfig.couriers[i].name]);
				this._oValues[this._oConfig.couriers[i].name]=delivery[this._oConfig.couriers[i].name];
			}
		}
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this),
			deleteProperty:this._del.bind(this),
			has:this._has.bind(this)
		});
	}
	destructor(){
		delete this._oFormer;
		delete this._oValues;
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
		return target._oValues[key];
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
		if(value instanceof cTessefaktCourier){
			target._oFormer={...target._oValues};
			for(var key in value) target._oValues[key].value=value[key];
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
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
			case 'courier':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._oValues;
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
		if(key in target._oValues){
			target._oFormer={...target._oValues};
			target._oValues[key].destructor();
			delete target._oValues[key];
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
		}
		return true;
	}
	_fromValue(values){
		this._oFormer={...this._oValues};
		this._oValues=values;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:this,writable:false});
		this.dispatchEvent(e);
	}
	_toValue(){
		var oValue={};
		for(var sKey in this._oValues) oValue[sKey]=this._oValues[sKey].value;
		return oValue;
	}
	_toFormerValue(){
		var oValue={};
		for(var sKey in this._oFormer) oValue[sKey]=this._oFormer[sKey].value;
		return oValue;
	}
	_fromObject(objects){
		this._oFormer={...this._oValues};
		this._oValues=objects;
		var e=new Event('change');
		Object.defineProperty(e,'target',{value:this,writable:false});
		this.dispatchEvent(e);
	}
	_toObject(){
		return this._oValues;
	}
	_toFormerObject(){
		return this._oFormer;
	}
	_clone(){
		var oClone=new cTessefaktCourierObject({
			tessefakt:this._oTessefakt,
			controller:this._oController,
			courier:this._oCourier,
			config:this._oConfig,
			delivery:this.value
		});
		return oClone;
	}
}