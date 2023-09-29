var cTessefaktRenderPages=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dPan;
	_oHeader;
	_oMain;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dPan=new Element('div',{'data-tessefakt-role':'pages-pan'}).inject(this._oParent.inject);
		this._oHeader=new cTessefaktRenderPagesHeader({tessefakt:this._oTessefakt,parent:this,config:this._oConfig});
		this._oMain=new cTessefaktRenderPagesMain({tessefakt:this._oTessefakt,parent:this,config:this._oConfig});
	}
	destructor(){
		this._oHeader.destructor();
		this._oMain.destructor();
		this._dPan.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dPan;
		delete this._oHeader;
		delete this._oMain;
	}
	openPage({app,index,events,delivery,page}){
		return this._oMain.openPage({app,index,events,delivery,page});
	}
	closePage({page,autovalidate}){
		this._oMain.closePage({page,autovalidate});
	}
	refresh(){
		this._oMain.refresh();
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dPan;
	}
	get water(){
		return this._oParent.water;
	}
};
