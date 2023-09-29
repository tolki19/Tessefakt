var cTessefaktEntityDialogMain=class extends cTessefaktEntityMain{
	_oMdf;
	_oParent;
	_oConfig;
	_dMain;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		super();
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dMain=new Element('main').inject(this._oParent.inject);
		for(var i=0;i<this._oConfig.contents?.length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.contents[i].name.camelize();
			try{
				this._aSubjects.push(new window[sObject]({tessefakt:this._oMdf,parent:this,config:this._oConfig.contents[i],water:this.water}));
			}catch(ex){
				if(window[sObject]==undefined) throw new Error('DOM class "'+sObject+'" ("'+this._oConfig.contents[i].name+'") not defined');
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
		this._dMain.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
	}
	registerDescription(desc,obj){
		return this._oParent.registerDescription(desc,obj);
	}
	unregisterDescription(desc){
		return this._oParent.unregisterDescription(desc);
	}
	get inject(){
		return this._dMain;
	}
	get water(){
		return this._oParent.water;
	}
};
