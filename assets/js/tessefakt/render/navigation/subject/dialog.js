var cTessefaktRenderNavigationSubjectDialog=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dLi;
	_oA;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dLi=new Element('li').inject(this._oParent.inject);
		this._oA=new cTessefaktRenderNavigationDisplayA({
			tessefakt:this._oTessefakt,
			parent:this,
			events:{
				click:this._click.bind(this)
			}
		});
	}
	destructor(){
		this._oA.destructor;
		delete this._oA;
		this._dLi.dispose();
		delete this._dLi;
		delete this._sDescriptor;
		delete this._oConfig;
		delete this._oParent;
		delete this._oTessefakt;
	}
	flag(key){
		if(
			key.app.value==this._oConfig.key.app&&
			key.index.value==this._oConfig.key.index
		){
			return this._oA.flag(key);
		}
		return false;
	}
	unflag(key){
		if(
			key.app.formerValue==this._oConfig.key.app&&
			key.index.formerValue==this._oConfig.key.index
		){
			return this._oA.unflag(key);
		}
		return false;
	}
	_click(e){
		e.preventDefault();
		this._oTessefakt.panic(this._oConfig.key);
	}
	get config(){
		return this._oConfig;
	}
	get inject(){
		return this._dLi;
	}
}