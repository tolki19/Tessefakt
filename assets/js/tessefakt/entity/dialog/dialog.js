var cTessefaktEntityDialog=class extends cTessefaktEntity{
	_oMdf;
	_oConfig;
	_oParent;
	_oEvents;
	_oDelivery;
	_dFrame;
	_oHeader;
	_oMain;
	_oFooter;
	_oDescs={};
	_oWater;
	_oBucket;
	_oRequest;
	_oRequestChange;
	_oCouriers;
	_oUnselect;
	constructor({tessefakt,parent,config,events={},delivery={}}){
		super();
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._oEvents=events;
		this._oDelivery=delivery;
		this._oWater=this._oParent.water.clone;
		if(this._oConfig.bucket) this._oBucket=this._oWater[this._oConfig.bucket];
		else this._oBucket=this._oWater;
		if(this._oConfig.couriers) this._oCourier=new cTessefaktServiceCouriers({tessefakt:this._oMdf,parent:this,config:this._oConfig.couriers});
		if(this._oConfig.request){
			this._oRequest=new cTessefaktServiceRequest({tessefakt:this._oMdf,parent:this,config:this._oConfig.request,events:{load:this._loadRequest.bind(this),error:this._errorRequest.bind(this)}});
			if(this._oConfig.request.post) this._oRequestChange=new cTessefaktServiceRequestChange({tessefakt:this._oMdf,parent:this,config:this._oConfig.request,events:{change:this._change.bind(this)}});
		}
		this._dFrame=new Element('div',{'data-tessefakt-role':'dialog','data-tessefakt-state':'open'}).inject(this._oParent.inject);
		if(this._oConfig.ref) this._dFrame.set('data-tessefakt-ref',this._oConfig.ref);
		this._oHeader=new cTessefaktEntityDialogHeader({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig
		});
		this._oMain=new cTessefaktEntityDialogMain({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig
		});
		this._oFooter=new cTessefaktEntityDialogFooter({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig
		});
	}
	close(){
		if(this._oRequest) this._oRequest.destructor();
		delete this._oRequest;
		if(this._oRequestChange) this._oRequestChange.destructor();
		delete this._oRequestChange;
		if(this._oCourier) this._oCourier.destructor();
		delete this._oCourier;
		if(this._oUnselect) this._oUnselect.destructor();
		delete this._oUnselect;
		this._oHeader.destructor();
		delete this._oHeader;
		this._oMain.destructor();
		delete this._oMain;
		this._oFooter.destructor();
		delete this._oFooter;
		this._dFrame.dispose();
		delete this._oMdf;
		delete this._oConfig;
		delete this._oParent;
		delete this._oEvents;
		delete this._oDelivery;
	}
	describe(oMessages){
// maybe propagate things
		for(var i=0;i<oMessages.length;++i){
			for(var j=0;j<(oMessages[i].descs??[]).length;++j){
				this._oDescs[oMessages[i].descs[j]].states=[oMessages[i].type];
			}
		}
	}
	send(e){
		var oValues={};
		for(var sDesc in this._oDescs) oValues[sDesc]=this._oDescs[sDesc].value;
		e.form=oValues;
		(this._oEvents.send??function(){})(e);
	}
	registerDescription(desc,obj){
		this._oDescs[desc]=obj;
	}
	unregisterDescription(desc){
		delete this._oDescs[desc];
	}
	refresh(){
		this._request();
	}
	dispatch(descriptor,e){
		switch(descriptor){
			case 'close': this._oMdf.unpanic({dialog:this}); break;
			case 'send': this.send(e); break;
		}
	}
	get inject(){
		return this._dFrame;
	}
	get water(){
		return this._oWater;
	}
	get bucket(){
		return this._oBucket;
	}
};