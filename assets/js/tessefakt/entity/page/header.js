var cTessefaktEntityPageHeader=class  extends cTessefaktEntityHeader{
	_oMdf;
	_oParent;
	_oConfig;
	_dHeader;
	_dMenu;
	_aSubjects=[];
	constructor({tessefakt,parent,config,}){
		super();
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dHeader=new Element('header').inject(this._oParent.inject);
		this._dMenu=new Element('menu').inject(this._dHeader);
		for(var i=0;i<(this._oConfig.headers??[]).length;++i){
			this._aSubjects.push(new window['cTessefaktEntityAction'+this._oConfig.headers[i].type.camelize()]({
				tessefakt:this._oMdf,
				parent:this,
				config:this._oConfig.headers[i]
			}));
		}
	}
	presentLoading(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].presentLoading();
		}
	}
	presentUpdate(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].presentUpdate();
		}
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		this._dMenu.dispose();
		this._dHeader.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
	}
	get inject(){
		return this._dMenu;
	}
	refresh(){
		this._oParent.refresh();
	}
	get water(){
		return this._oParent.water;
	}
};
