var cMdfRenderPagesMain=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dMain;
	_aSubjects=[];
	constructor({mdf,parent,config}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._dMain=new Element('main').inject(this._oParent.inject);
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i) this._aSubjects[i].subject.close();
		this._dMain.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._dMain;
		delete this._aSubjects;
	}
	openPage({app,index,events,delivery,page}){
		if(!this._oConfig.apps[app].entities[index]) throw new Error('Page "'+app+'"."'+index+'" not configured');
		var oSubject=new cMdfEntityPage({
			mdf:this._oMdf,
			parent:this,
			config:this._oConfig.apps[app].entities[index],
			events:events,
			delivery:delivery,
			page:page
		});
		this._aSubjects.push({sKey:{app,index},subject:oSubject});
		var aSubjects=[oSubject];
		this._oMdf.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).parse({app,index});
		while(aSubjects[0].page) aSubjects.unshift(aSubjects[0].page);
		for(var i=0;i<this._aSubjects.length;++i){
			var iKey=aSubjects.findIndex((value)=>value==this._aSubjects[i].subject);
			if(iKey!=-1) this._aSubjects[i].subject.order=aSubjects.length-1-iKey;
			else{
				this._aSubjects[i].subject.close();
				this._aSubjects.splice(i--,1);
			}
		}
		return oSubject;
	}
	closePage({page,autovalidate}){
		if(page.page) var aSubjects=[page.page];
		else var aSubjects=[];
		if(aSubjects.length) while(aSubjects[0].page) aSubjects.unshift(aSubjects[0].page);
		if(autovalidate){
			if(aSubjects.length) var bClose=true;
			else var bClose=false
		}else var bClose=true;
		if(bClose){
			page.close();
			this._aSubjects.splice(this._aSubjects.findIndex((value)=>value.subject==page),1);
			for(var i=0;i<this._aSubjects.length;++i){
				var iKey=aSubjects.findIndex((value)=>value==this._aSubjects[i].subject);
				if(iKey!=-1) this._aSubjects[i].subject.order=aSubjects.length-1-iKey;
				else{
					this._aSubjects[i].subject.close();
					this._aSubjects.splice(i--,1);
				}
			}
			if(aSubjects.length) this._oMdf.mscript({script:this._oConfig.construct.key,water:this.water}).value=this._aSubjects[this._aSubjects.findIndex((value)=>value.subject==aSubjects[0])].key;
			else this._oMdf.mscript({script:this._oConfig.construct.key,water:this.water}).value={app:undefined,index:undefined};
		}
	}
	refresh(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].subject.refresh();
		}
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dMain;
	}
	get water(){
		return this._oParent.water;
	}
};
