var cTessefaktEntityPage=class extends cTessefaktEntity{
	_oTessefakt;
	_oParent;
	_oConfig;
	_oEvents;
	_oDelivery;
	_dFrame;
	_oHeader;
	_oMain;
	_oDescs={};
	_oWater;
	_oBucket;
	_oRequest;
	_oRequestChange;
	_oCourier;
	_oUnselect;
	_oPage;
	_iOrder;
	constructor({tessefakt,config,parent,events={},delivery={},page}){
		super();
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._oEvents=events;
		this._oDelivery=delivery;
		if(page) this._oPage=page;
		this._oWater=this._oParent.water.clone;
		if(this._oConfig.bucket) this._oBucket=this._oWater[this._oConfig.bucket];
		else this._oBucket=this._oWater;
		if(this._oConfig.couriers){
			this._oCourier=new cTessefaktServiceCouriers({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.couriers,
				delivery:this._oDelivery
			});
		}
		if(this._oConfig.request){
			this._oRequest=new cTessefaktServiceRequest({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.request,
				events:{
					load:this._loadRequest.bind(this),
					error:this._errorRequest.bind(this)
				}
			});
			if(this._oConfig.request.post){
				this._oRequestChange=new cTessefaktServiceRequestChange({
					tessefakt:this._oTessefakt,
					parent:this,
					config:this._oConfig.request,
					events:{
						change:this._change.bind(this)
					}
				});
			}
		}
		this._dFrame=new Element('div',{'data-tessefakt-role':'page'}).inject(this._oParent.inject);
		if(this._oConfig.ref) this._dFrame.set('data-tessefakt-ref',this._oConfig.ref);
		this._oHeader=new cTessefaktEntityPageHeader({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig
		});
		this._oMain=new cTessefaktEntityPageMain({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig
		});
		this._oFooter=new cTessefaktEntityPageFooter({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig
		});
		if(this._oRequest) this._request();
	}
	_request(){
		this._oRequest.execute();
		this._presentLoading();
	}
	_loadRequest(e){
		if(e.target.responseJson.data.sequences) this.bucket.data.sequences=e.target.responseJson.data.sequences;
		if(e.target.responseJson.data.collections) this.bucket.data.collections=e.target.responseJson.data.collections;
		this._presentUpdate();
	}
	_errorRequest(e){
console.debug(false);
	}
	_presentLoading(){
		this._oHeader.presentLoading();
		this._oMain.presentLoading();
	}
	_presentUpdate(){
		this._oHeader.presentUpdate();
		this._oMain.presentUpdate();
	}
	close(){
		if(this._oRequest) this._oRequest.destructor();
		delete this._oRequest;
		if(this._oRequestChange) this._oRequestChange.destructor();
		delete this._oRequestChange;
		if(this._oUnselect) this._oUnselect.destructor();
		delete this._oUnselect;
		this._oHeader.destructor();
		delete this._oHeader;
		this._oMain.destructor();
		delete this._oMain;
		this._oFooter.destructor();
		delete this._oFooter;
		this._dFrame.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._oEvents;
		delete this._oDelivery;
		delete this._oPage;
		if(this._oCourier) this._oCourier.destructor();
		delete this._oCourier;
	}
	_change(e){
		e.preventDefault();
		this._request();
	}
	registerDescription(desc,obj){
		this._oDesc[desc]=obj;
	}
	unregisterDescription(desc){
		delete this._oDesc[desc];
	}
	refresh(){
		this._request();
	}
	get page(){
		return this._oPage;
	}
	set order(value){
		this._iOrder=value;
		this._dFrame.set('data-tessefakt-visibility','open');
	}
	get inject(){
		return this._dFrame;
	}
	get bucket(){
		return this._oBucket;
	}
	get water(){
		return this._oWater;
	}
};