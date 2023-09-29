var cTessefaktEntityDialogFooter=class extends cTessefaktEntityFooter{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dFooter;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		super();
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dFooter=new Element('footer').inject(this._oParent.inject);
		for(var i=0;i<this._oConfig.buttons?.length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.buttons[i].name.camelize();
			try{
				this._aSubjects.push(new window[sObject]({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.buttons[i],water:this.water}));
			}catch(ex){
				if(window[sObject]==undefined) throw new Error('DOM class "'+sObject+'" ("'+this._oConfig.buttons[i].name+'") not defined');
				throw ex;
			}
		}
	}
	update(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].update();
		}
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		this._dFooter.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
	}
	refresh(){
		this._oParent.refresh();
	}
	dispatch(descriptor,e){
		return this._oParent.dispatch(descriptor,e);
	}
	get inject(){
		return this._dFooter;
	}
	get water(){
		return this._oParent.water;
	}
};
