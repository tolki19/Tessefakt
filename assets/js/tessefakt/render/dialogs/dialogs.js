var cTessefaktRenderDialogs=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dPan;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dPan=new Element('div',{'data-tessefakt-role':'dialog-pan'}).inject(this._oParent.inject);
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i) this._aSubjects[i].close();
		this._dPan.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dPan;
		delete this._aSubjects;
	}
	openDialog({app,index,events,delivery}){
		if(!this._oConfig.apps[app].entities[index]) throw new Error('Dialog "'+app+'"."'+index+'" not configured');
		var oSubject=new cTessefaktEntityDialog({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig.apps[app].entities[index],
			events:events,
			delivery:delivery
		});
		this._aSubjects.push(oSubject);
		return oSubject;
	}
	closeDialog({dialog}){
		var i=this._aSubjects.indexOf(dialog);
		this._aSubjects[i].close();
		this._aSubjects.splice(i,1);
	}
	get inject(){
		return this._dPan;
	}
	get water(){
		return this._oParent.water;
	}
};
