var cMdfServiceRequest=class extends cMdfService{
	_oEvents;
	constructor({mdf,parent,config,events}){
		super({mdf,parent,config});
		this._oEvents=events;
	}
	destructor(){
		super.destructor();
		delete this._oEvents;
		this._oRequest.abort();
		delete this._oRequest;
	}
	execute(){
		if(this._oRequest) this._oRequest.abort();
		var oPost={};
		for(var i=0;i<this._oConfig.post.length;++i){
			if(this._oConfig.post[i].field) oPost[this._oConfig.post[i].name]=this._oMdf.mscript({script:this._oConfig.post[i].field,water:this.water}).value;
			else if(this._oConfig.post[i].value) oPost[this._oConfig.post[i].name]=this._oConfig.post[i].value;
		}
		this._oRequest=this._oMdf.request({
			root:this,
			get:this._oConfig.get,
			post:oPost,
			events:this._oEvents
		});
	}
	pending(){
		return this._oRequest.pending();
	}
};
