var cTessefaktEntityPageFooter=class extends cTessefaktEntityFooter{
	_oMdf;
	_oParent;
	_oConfig;
	_dFooter;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		super();
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dFooter=new Element('footer').inject(this._oParent.inject);
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
		this._dFooter.dispose();
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
