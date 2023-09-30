var cTessefaktRenderNavigationSubjectPage=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dLi;
	_oA;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		if(!this._oParent.indice[this._oConfig.key.index]) this._oParent.indice[this._oConfig.key.index]=[];
		this._oParent.indice[this._oConfig.key.index].push(this);
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
		return this._oA.flag(key);
	}
	unflag(key){
		return this._oA.unflag(key);
	}
	_click(e){
		e.preventDefault();
		this._oTessefakt.open(this._oConfig.key);
	}
	get config(){
		return this._oConfig;
	}
	get inject(){
		return this._dLi;
	}
}