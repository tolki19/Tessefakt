var cTessefaktServiceRequestChange=class extends cTessefaktService{
	_oEvents;
	constructor({tessefakt,parent,config,events}){
		super({tessefakt,parent,config});
		this._oEvents=events;
		if(this._oConfig.post){
			for(var i=0;i<this._oConfig.post.length;++i){
				if(this._oConfig.post[i].field) this._oMdf.mscript({script:this._oConfig.post[i].field,water:this.water}).addEventListener('change',this._oEvents.change);
			}
		}
	}
	destructor(){
		super.destructor();
		delete this._oEvents;
	}
};
