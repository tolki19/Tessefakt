var cMdfCollectionField=class extends cMdfCollection{
	_oSet;
	_mValue;
	_mFormer;
	constructor({mdf,set}){
		super();
		this._oMdf=mdf;
		this._oSet=set;
		return new Proxy(this,{
			get:this._get.bind(this),
			set:this._set.bind(this)
		});
	}
	destructor(){
		delete this._mFormer;
		delete this._mValue;
		delete this._oSet;
		super.destructor();
	}
	dispatchEvent(e){
		super.dispatchEvent(e);
		this._oSet.dispatchEvent(e);
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
		if(value!==target._mValue){
			target._mFormer=this._mValue;
			target._mValue=value;
			var e=new Event('change');
			Object.defineProperty(e,'target',{value:target,writable:false});
			target.dispatchEvent(e);
		}
		return true;
	}
	_fromValue(value){
		this._mValue=value;
		return true;
	}
	_toValue(){
		return this._mValue;
	}
	_toFormerValue(){
		return this._mFormer;
	}
	_fromObject(value){
		this._mValue=value;
		return true;
	}
	_toObject(){
		return this._mValue;
	}
	_toFormerObject(){
		return this._mFormer;
	}
	_clone(){
		var oClone=new cMdfCollectionField({
			mdf:this._oMdf,
			set:this._oSet
		});
		oClone.import(this.export());
		return oClone;
	}
};