var cTessefaktRenderNavigationAppApp=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_sDescriptor;
	_dLi;
	_oA;
	_oMenu;
	constructor({tessefakt,parent,config,descriptor}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._sDescriptor=descriptor;
		this._dLi=new Element('li').inject(this._oParent.inject);
		this._oA=new cTessefaktRenderNavigationDisplayA({
			tessefakt:this._oTessefakt,
			parent:this,
			events:{
				click:this._click.bind(this)
			}
		});
		this._oMenu=new cTessefaktRenderNavigationSubjectMenu({
			tessefakt:this._oTessefakt,
			parent:this._oParent._oParent,
			config:this._oConfig.navigation,
			descriptor:this._sDescriptor
		});
	}
	destructor(){
		this._oA.destructor();
		delete this._oA;
		this._oMenu.destructor();
		delete this._oMenu;
		this._dLi.dispose();
		delete this._dLi;
		delete this._sDescriptor;
		delete this._oConfig;
		delete this._oParent;
		delete this._oTessefakt;
	}
	flag(key){
		this._oA.flag(key);
		this._oMenu.flag(key);
		return true;
	}
	unflag(key){
		this._oA.unflag(key);
		this._oMenu.unflag(key);
		return true;
	}
	_click(e){
		this._oParent.key={app:this._sDescriptor,index:undefined};
	}
	get config(){
		return this._oConfig;
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dLi;
	}
};
