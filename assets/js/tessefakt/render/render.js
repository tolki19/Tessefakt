var cTessefaktRender=class{
	_oMdf;
	_oConfig;
	_oDelivery;
	_oIndice={};
	_oPages;
	_oDialogs;
	_oWater;
	_oBucket;
	constructor({tessefakt,config,delivery={}}){
		this._oMdf=tessefakt;
		this._oConfig=config;
		this._oDelivery=delivery;
		for(var a=document.querySelectorAll('body>*'),i=0;i<a.length;++i) a[i].dispose();
		this._oWater=new cTessefaktControllerWater({
			tessefakt:this._oMdf
		});
		if(this._oConfig.construct.bucket) this._oBucket=this._oWater[this._oConfig.construct.bucket];
		else this._oBucket=this._oWater;
		if(this._oConfig.construct.couriers) this._oCourier=new cTessefaktServiceCouriers({
				tessefakt:this._oMdf,
				parent:this,
				config:this._oConfig.construct.couriers,
				delivery:this._oDelivery
			});
		this._oPages=new cTessefaktRenderPages({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig
		});
		this._oDialogs=new cTessefaktRenderDialogs({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig
		});
	}
	openPage({app,index,events,delivery,page}){
		return this._oPages.openPage({app,index,events,delivery,page});
	}
	closePage({page,autovalidate}){
		this._oPages.closePage({page:page,autovalidate});
	}
	openDialog({app,index,events,delivery}){
		return this._oDialogs.openDialog({app,index,events,delivery});
	}
	closeDialog({dialog}){
		this._oDialogs.closeDialog({dialog});
	}
	destructor(){
		this._oPages.destructor();
		this._oDialogs.destructor();
		delete this._oMdf;
		delete this._oConfig;
		delete this._oDelivery;
		delete this._oIndice;
		delete this._oPages;
		delete this._oDialogs;
		delete this._oWater;
		delete this._oBucket;
	}
	refresh(){
		this._oPages.refresh();
	}
	get indice(){
		return this._oIndice;
	}
	get inject(){
		return document.body;
	}
	get water(){
		return this._oWater;
	}
	get bucket(){
		return this._oBucket;
	}
};
