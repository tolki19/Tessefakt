var cTessefaktRenderPages=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dPan;
	_oHeader;
	_oMain;
	constructor({mdf,parent,config}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._dPan=new Element('div',{'data-tessefakt-role':'pages-pan'}).inject(this._oParent.inject);
		this._oHeader=new cTessefaktRenderPagesHeader({mdf:this._oMdf,parent:this,config:this._oConfig});
		this._oMain=new cTessefaktRenderPagesMain({mdf:this._oMdf,parent:this,config:this._oConfig});
	}
	destructor(){
		this._oHeader.destructor();
		this._oMain.destructor();
		this._dPan.dispose();
		delete this._oMdf;
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
