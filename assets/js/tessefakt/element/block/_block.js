var cTessefaktElementBlock=class extends cTessefaktElement{
	_oMdf;
	_oParent;
	_oConfig;
	_oWater;
	_oBucket;
	_dElement;
	_oGadgets={};
	_oServices={};
	_aSubjects=[];
	_oRequest;
	_oRequestChange;
	_oCourier;
	_oUnselect;
	constructor({tessefakt,parent,config,water}){
		super();
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._oWater=water.clone;
		if(this._oConfig.bucket) this._oBucket=this.water[this._oConfig.bucket];
		else this._oBucket=this.water;
		if(this._oConfig.couriers) this._oCourier=new cTessefaktServiceCouriers({tessefakt:this._oMdf,parent:this,config:this._oConfig.couriers});
		if(this._oConfig.request){
			this._oRequest=new cTessefaktServiceRequest({tessefakt:this._oMdf,parent:this,config:this._oConfig.request,events:{load:this._loadRequest.bind(this),error:this._errorRequest.bind(this)}});
			if(this._oConfig.request.post) this._oRequestChange=new cTessefaktServiceRequestChange({tessefakt:this._oMdf,parent:this,config:this._oConfig.request,events:{change:this._change.bind(this)}});
		}
		this._display();
		if(this._oConfig.desc) this._oRoot.registerDescription(this._oConfig.desc,this);
		if(this._oConfig.unselect) this._oUnselect=new cTessefaktServiceUnselect({tessefakt:this._oMdf,parent:this,config:this._oConfig.unselect});
		for(var i=0;i<(this._oConfig.gadgets??[]).length;++i){
			var sObject='cTessefaktGadget'+this._oConfig.gadgets[i].type.camelize();
			try{
				this._oGadgets[this._oConfig.gadgets[i].type]=new window[sObject]({tessefakt:this._oMdf,parent:this,config:this._oConfig.gadgets[i],element:this._dElement});
			}catch(ex){
				if(window[sObject]==undefined) throw new Error('Gadget class "'+sObject+'" ("'+this._oConfig.gadgets[i].type+'") not defined');
				throw ex;
			}
		}
		if(this._oRequest) this._request();
		else if(!(this._oConfig.sequence&&this._oConfig.collection)) this._displayChildren({water:this.water});
	}
	_display(){
		this._dElement=new Element(this._oConfig.name).inject(this._oParent.inject);
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
			this._aSubjects.push(new window[sObject]({tessefakt:this._oMdf,parent:this,config:this._oConfig.contents[i],water:water}));
		}
	}
	_displayLoading({water}){
		for(var i=0;i<(this._oConfig.loading??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.loading[i].name.camelize();
			this._aSubjects.push(new window[sObject]({tessefakt:this._oMdf,parent:this,config:this._oConfig.loading[i],water:water}));
		}
	}
	_displayEmpty({water}){
		for(var i=0;i<(this._oConfig.empty??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.empty[i].name.camelize();
			this._aSubjects.push(new window[sObject]({tessefakt:this._oMdf,parent:this,config:this._oConfig.empty[i],water:water}));
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
		}else{
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentUpdate();
			}
		}
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		if(this._oConfig.desc) this._oRoot.unregisterDescription(this._oConfig.desc,this);
		if(this._oRequest) this._oRequest.destructor();
		delete this._oRequest;
		if(this._oRequestChange) this._oRequestChange.destructor();
		delete this._oRequestChange;
		if(this._oCourier) this._oCourier.destructor();
		delete this._oCourier;
		if(this._oUnselect) this._oUnselect.destructor(); 
		delete this._oUnselect;
		for(var k in this._oGadgets){
			this._oGadgets[k].destructor();
		}
		this._dElement.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._oBucket;
		delete this._dElement;
		delete this._oGadgets;
		delete this._aSubjects;
	}
	registerDescription(desc,obj){
		return this._oParent.registerDescription(desc,obj);
	}
	unregisterDescription(desc){
		return this._oParent.unregisterDescription(desc);
	}
	get inject(){
		return this._dElement;
	}
	dispatch(descriptor,e){
		return this._oParend.dispatch(descriptor,e);
	}
	get water(){
		return this._oWater;
	}
	get bucket(){
		return this._oBucket;
	}
	get services(){
		return this._oServices;
	}
};