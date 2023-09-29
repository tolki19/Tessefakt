var cTessefaktElementFormLabel=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dElement;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dLabel=new Element('label',{
			'data-tessefakt-control-role':'label',
			'tabindex':this._oConfig.tabindex??0
		}).inject(this._oParent.inject);
		if(this._oConfig.caption) this._dCaption=new Element('span',{
				'data-tessefakt-control-role':'caption',
				'html':this._oConfig.caption
			}).inject(this._dLabel);
		this._oDisplay=new cTessefaktElementSelectDisplay({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.display});
	}
	destructor(){
		this._oDisplay.destructor();
	}
	presentLoading(){
		this._oDisplay.presentLoading();
	}
	presentUpdate(){
		this._oDisplay.presentUpdate();
	}
	get water(){
		return this._oParent.water;
	}
	get bucket(){
		return this._oParent.bucket;
	}
	get inject(){
		return this._dLabel;
	}
};
