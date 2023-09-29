var cTessefaktServiceCouriers=class extends cTessefaktService{
	_aCouriers=[];
	constructor({tessefakt,parent,config,events,delivery={}}){
		super({tessefakt,parent,config});
		for(var i=0;i<this._oConfig.length;++i){
			var oCouriers=new window['cTessefaktCourier'+this._oConfig[i].type.camelize()]({
				tessefakt:this._oMdf,
				config:this._oConfig[i],
				delivery:delivery[this._oConfig[i].name]
			});
			this._aCouriers[i]=oCouriers;
			this.bucket.couriers[this._oConfig[i].name]=oCouriers;
		}
	}
	destructor(){
		super.destructor();
		for(var i=0;i<this._aCouriers.length;++i){
			this._aCouriers[i].destructor();
			delete this._aCouriers[i];
		}
	}
};
