var cTessefaktCourierString=class extends cTessefaktCourier{
	_sValue;
	_sFormer;
	constructor({mdf,controller,courier,config,delivery}){
		super({mdf,controller,courier,config});
		this._sValue=delivery??this._oConfig.value?.toString()??undefined;
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this)
		});
	}
	destructor(){
		delete this._sValue;
		delete this._sFormer;
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
			case 'set': return target._oSet;
		}
		throw new Error('Key "'+key+'" not allowed');
	}
	_set(target,key,value){
		if(key.match(/^_.*$/)) throw new Error('Key "'+key+'" not allowed');
 		if(key!='value') throw new Error('Key "'+key+'" not allowed');
		if(value!==target._sValue){
			target._sFormer=this._sValue;
			target._sValue=value;
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
		}
		return true;
	}
	_fromValue(value){
		this._sValue=value;
		return true;
	}
	_toValue(){
		return this._sValue;
	}
	_toFormerValue(){
		return this._sFormer;
	}
	_fromObject(value){
		this._sValue=value;
		return true;
	}
	_toObject(){
		return this._sValue;
	}
	_toFormerObject(){
		return this._sFormer;
	}
	_clone(){
		var oClone=new cTessefaktCourierString({
			mdf:this._oMdf,
			set:this._oSet
		});
		oClone.import(this.export());
		return oClone;
	}
};