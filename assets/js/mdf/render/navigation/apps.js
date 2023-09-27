var cMdfRenderNavigationApps=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dMenu;
	_oApps={};
	constructor({mdf,parent,config}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._dMenu=new Element('menu',{
			'data-mdf-role':'appmenu'
		}).inject(this._oParent.inject);
		for(var key in this._oConfig){
			this._oApps[key]=new cMdfRenderNavigationApp({mdf:this._oMdf,parent:this,config:this._oConfig[key],descriptor:key});
		}
	}
	destructor(){
		for(var key in this._oApps) this._oApps[key].destructor();
		this._dMenu.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._dMenu;
		delete this._oApps;
	}
	verifyDisplay(key){
		if(key.app.formerValue) this._oApps[key.app.formerValue].unflag(key);
		if(key.app.value) this._oApps[key.app.value].flag(key);
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dMenu;
	}
	set key(value){
		this._oParent.key=value;
	}
};