var cTessefaktFormButton=class{
	_oMdf;
	_oParent;
	_oConfig;
	_oWater;
	_dLabel;
	_dElement;
	_oBucket;
	_oGadgets={};
	_oServices={};
	_aSubjects=[];
	_oRequest;
	_oRequestChange;
	_oCourier;
	_oUnselect;
	constructor({mdf,parent,config,water}){
		this._oMdf=mdf;
		this._oParent=parent;
		this._oConfig=config;
		this._oWater=water.clone;
		if(this._oConfig.bucket) this._oBucket=this.water[this._oConfig.bucket];
		else this._oBucket=this.water;
		if(this._oConfig.couriers) this._oCourier=new cTessefaktServiceCouriers({mdf:this._oMdf,parent:this,config:this._oConfig.couriers});
		if(this._oConfig.request){
			this._oRequest=new cTessefaktServiceRequest({mdf:this._oMdf,parent:this,config:this._oConfig.request,events:{load:this._loadRequest.bind(this),error:this._errorRequest.bind(this)}});
			if(this._oConfig.request.post) this._oRequestChange=new cTessefaktServiceRequestChange({mdf:this._oMdf,parent:this,config:this._oConfig.request,events:{change:this._change.bind(this)}});
		}
		this._display();
		if(this._oConfig.desc) this._oRoot.registerDescription(this._oConfig.desc,this);
		if(this._oConfig.unselect) this._oUnselect=new cTessefaktServiceUnselect({mdf:this._oMdf,parent:this,config:this._oConfig.unselect});
		for(var i=0;i<(this._oConfig.gadgets??[]).length;++i){
			var sObject='cTessefaktGadget'+this._oConfig.gadgets[i].type.camelize();
			try{
				this._oGadgets[this._oConfig.gadgets[i].type]=new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.gadgets[i],element:this._dElement});
			}catch(ex){
				if(window[sObject]==undefined) throw new Error('Gadget class "'+sObject+'" ("'+this._oConfig.gadgets[i].type+'") not defined');
				throw ex;
			}
		}
		switch(this._oConfig.action??false){
			case 'send': this._dElement.addEvent('click',this._send.bind(this)); break;
			case 'close': this._dElement.addEvent('click',this._close.bind(this)); break;
		}
		for(var i=0;i<(this._oConfig.contents??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.contents[i].name.camelize();
			this._aSubjects.push(new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.contents[i],water:this.water}));
		}
	}
	_display(){
		this._dSpan=new Element('span',{'data-tessefakt-role':'control','data-tessefakt-control':this._oConfig.name}).inject(this._oParent.inject);
		this._dLabel=new Element('label',{'data-tessefakt-control-role':'label'}).inject(this._dSpan);
		this._dElement=new Element(this._oConfig.name,{'data-tessefakt-control-role':'display'}).inject(this._dLabel);
		if(this._oConfig.role??false) this._dSpan.set('data-tessefakt-function',this._oConfig.role);
		if((this._oConfig.default??false)===true) this._dSpan.set('data-tessefakt-state','default');
	}
	_send(e){
		this._oParent.dispatch('send',e);
	}
	_close(e){
		this._oParent.dispatch('close',e);
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
		this._dElement.dispose();
		this._dLabel?.dispose();
		this._dSpan.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._oBucket;
		delete this._dElement;
		delete this._dLabel;
		delete this._dSpan;
		delete this._oGadgets;
		delete this._oServices;
		delete this._aSubjects;
		delete this._oRequest;
		delete this._oRequestChange;
		delete this._oCourier;
		delete this._oUnselect;
	}
	get value(){
		return this._dElement.value;
	}
	set states(aStates){
		var aCurrs=(this._dElement.get('data-tessefakt-state')??'').split(' '),aAdds=aStates.filter(v=>!aCurrs.includes(v)),aDels=aCurrs.filter(v=>!aStates.includes(v));
		this._dElement.set('data-tessefakt-state',aStates.join(' '));
	}
	get inject(){
		return this._dElement;
	}
};
