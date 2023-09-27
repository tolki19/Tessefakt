var cMdfEntityDialogHeader=class extends cMdfEntityHeader{
	_oMdf;
	_oParent;
	_oConfig;
	_dHeader;
	_dMenu;
	_aSubjects=[];
	constructor({mdf,parent,config}){
		super();
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._dHeader=new Element('header').inject(this._oParent.inject);
		for(var i=0;i<this._oConfig.titles?.length;++i){
			var sObject='cMdfHTMLElement'+this._oConfig.titles[i].name.camelize();
			try{
				this._aSubjects.push(new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.titles[i],water:this.water}));
			}catch(ex){
				if(window[sObject]==undefined) throw new Error('DOM class "'+sObject+'" ("'+this._oConfig.titles[i].name+'") not defined');
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
		this._dHeader.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
	}
	refresh(){
		this._oParent.refresh();
	}
	get inject(){
		return this._dHeader;
	}
	get water(){
		return this._oParent.water;
	}
};
