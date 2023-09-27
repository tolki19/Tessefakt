var cTessefaktElementForm=class extends cTessefaktElement{
	_oMdf;
	_oParent;
	_oConfig;
	_oWater;
	_oBucket;
	_dSpan;
	_oBucket;
	_dElement;
	_oGadgets={};
	_oServices={};
	_aSubjects=[];
	_oRequest;
	_oRequestChange;
	_oCourier;
	_oUnselect;
	constructor({mdf,parent,config,water}){
		super();
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
		if(this._oRequest) this._request();
		else if(!(this._oConfig.sequence&&this._oConfig.collection)) this._displayChildren({water:this.water});
	}
	_display(){
		this._dSpan=new Element('span',{'data-tessefakt-role':'control','data-tessefakt-control':this._oConfig.name}).inject(this._oParent.inject);
		this._dLabel=new Element('label',{'data-tessefakt-control-role':'label'}).inject(this._dSpan);
		if(this._oConfig.caption) this._dCaption=new Element('span',{'data-tessefakt-control-role':'caption','html':this._oConfig.caption}).inject(this._dLabel);
		this._dElement=new Element('input',{'data-tessefakt-control-role':'display'}).inject(this._dLabel);
		if((this._oConfig.autocomplete??true)===false) this._dElement.set('autocomplete','off');
		if(this._oConfig.desc) this.registerDescription(this._oConfig.desc,this);
		if(this._oConfig.events) this._dElement.addEvents(this._oConfig.events);
	}
	_request(){
		this._oRequest.execute();
		this.presentLoading();
	}
	_loadRequest(e){
		if(e.target.responseJson.data.sequences) this.bucket.data.sequences=e.target.responseJson.data.sequences;
		if(e.target.responseJson.data.collections) this.bucket.data.collections=e.target.responseJson.data.collections;
		this.presentUpdate();
	}
	_change(e){
		this._request();
	}
	_errorRequest(e){
console.debug(false);
	}
	_displayCycle(){
		this.bucket.data.sequence=this._oMdf.mscript({script:this._oConfig.sequence,water:this.water});
		this.bucket.data.collection=this._oMdf.mscript({script:this._oConfig.collection,water:this.water});
		if(this._oUnselect) this._oUnselect.execute({bucket:oBucket});
		if(!this.bucket.data.sequence.length){
			this._displayEmpty({water:this.water});
		}else{
			for(var i=0;i<this.bucket.data.sequence.length;++i){
				if(this._oConfig.bucket){
					var oWater=this.water.clone;
					oWater[this._oConfig.bucket]=oWater[this._oConfig.bucket].clone;
					oWater[this._oConfig.bucket].data=oWater[this._oConfig.bucket].data.clone;
					var oBucket=oWater[this._oConfig.bucket];
				}else{
					var oWater=this.water.clone;
					oWater[this._oConfig.bucket].data=oWater[this._oConfig.bucket].data.clone;
					var oBucket=oWater;
				}
				oBucket.data.set=oBucket.data.collection[this.bucket.data.sequence[i]];
				this._displayChildren({water:oWater});
			}
		}
	}
	_displayChildren({water}){
		for(var i=0;i<(this._oConfig.contents??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.contents[i].name.camelize();
			this._aSubjects.push(new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.contents[i],water:water}));
		}
	}
	_displayLoading({water}){
		for(var i=0;i<(this._oConfig.loading??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.loading[i].name.camelize();
			this._aSubjects.push(new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.loading[i],water:water}));
		}
	}
	_displayEmpty({water}){
		for(var i=0;i<(this._oConfig.empty??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.empty[i].name.camelize();
			this._aSubjects.push(new window[sObject]({mdf:this._oMdf,parent:this,config:this._oConfig.empty[i],water:water}));
		}
	}
	presentLoading(){
		if(this._oConfig.loading){
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].destructor();
			}
			this._aSubjects=[];
			this._displayLoading({water:this.water});
		}else{
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentLoading();
			}
		}
	}
	presentUpdate(){
		if(this._oConfig.sequence&&this._oConfig.collection){
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].destructor();
			}
			this._aSubjects=[];
			this._displayCycle();
		}else if(this._oRequest){
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].destructor();
			}
			this._aSubjects=[];
			this._displayChildren({water:this.water});
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentUpdate();
			}
		}else{
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentUpdate();
			}
		}
	}
	destructor(){
		if(this._oConfig.desc) this.unregisterDescription(this._oConfig.desc,this);
		this._dElement?.dispose();
		this._dCaption?.dispose();
		this._dLabel?.dispose();
		this._dSpan?.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._oWater;
		delete this._oBucket;
		delete this._dElement;
		delete this._dLabel;
		delete this._oGadgets;
		delete this._oServices;
		delete this._aSubjects;
		delete this._oRequest;
		delete this._oRequestChange;
		delete this._oCourier;
		delete this._oUnselect;
	}
	registerDescription(desc,obj){
		return this._oParent.registerDescription(desc,obj);
	}
	unregisterDescription(desc){
		return this._oParent.unregisterDescription(desc);
	}
	get value(){
		return this._dElement.value;
	}
	set states(aStates){
		var aCurrs=(this._dElement.get('data-tessefakt-state')??'').split(' '),aAdds=aStates.filter(v=>!aCurrs.includes(v)),aDels=aCurrs.filter(v=>!aStates.includes(v));
		this._dElement.set('data-tessefakt-state',aStates.join(' '));
	}
	get water(){
		return this._oWater;
	}
	get bucket(){
		return this._oBucket;
	}
	get inject(){
		return this._dElement;
	}
};
