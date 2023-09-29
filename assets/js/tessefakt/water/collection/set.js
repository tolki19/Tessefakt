var cTessefaktCollectionSet=class extends cTessefaktCollection{
	_oTable;
	_oController;
	_oFields={};
	_oFormer;
	constructor({tessefakt,table,controller}){
		super();
		this._oMdf=tessefakt;
		this._oTable=table;
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
		for(var sKey in this._oFields) this._oFields[sKey].destructor();
		delete this._oFields;
		delete this._oController;
		delete this._oTable;
		super.destructor();
	}
	dispatchEvent(e){
		super.dispatchEvent(e);
		this._oTable?.dispatchEvent(e);
		this._oController?.dispatchEvent(e);
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
			case 'table': return target._oTable;
			case 'controller': return target._oController;
		}
		if(target._oFields[key]==undefined){
			target._oFormer={...this._oFields};
			target._oFields[key]=new cTessefaktCollectionField({
				tessefakt:target._oMdf,
				set:target
			});
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return target._oFields[key];
		}else{
			return target._oFields[key];
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
			case 'table':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		if(target._oFields[key]==undefined){
			target._oFormer={...this._oFields};
			target._oFields[key]=new cTessefaktCollectionField({
				tessefakt:target._oMdf,
				set:target
			});
			target._oFields[key].parse(value);
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
			return true;
		}else if(value!==target._oFields[key].value){
			target._oFormer={...this._oFields};
			target._oFields[key].parse(value);
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
			case 'table':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		return key in target._oFields;
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
			case 'table':
			case 'controller':
				throw new Error('Key "'+key+'" not allowed');
		}
		target._oFormer={...this._oFields};
		target._oFields[key].destructor();
		delete target._oFields[key];
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
				case 'table':
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in values){
			this._oFields[sKey]=new cTessefaktCollectionField({
				tessefakt:this._oMdf,
				set:this
			});
			this._oFields[sKey].parse(values[sKey]);
		}
		return true;
	}
	_toValue(){
		var oFields={};
		for(var sKey in this._oFields) oFields[sKey]=this._oFields[sKey].value;
		return oFields;
	}
	_toFormerValue(){
		var oFields={};
		for(var sKey in this._oFormer) oFields[sKey]=this._oFormer[sKey].value;
		return oFields;
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
				case 'table':
				case 'controller':
					throw new Error('Key "'+sKey+'" not allowed');
			}
		}
		for(var sKey in objects) this._oFields[sKey]=objects[sKey];
		return true;
	}
	_toObject(){
		return {...this._oFields};
	}
	_toFormerObject(){
		return {...this._oFormer};
	}
	_clone(){
		var oClone=new cTessefaktCollectionSet({
			tessefakt:this._oMdf,
			table:this._oTable
		});
		oClone.import(this.export());
		return oClone;
	}
};