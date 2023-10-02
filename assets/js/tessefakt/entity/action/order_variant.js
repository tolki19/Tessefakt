var cTessefaktEntityActionOrderVariant=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._display();
	}
	_display(){
		if(this._oConfig.action){
			this._dElement=new Element('a',{
				html:this._oConfig.caption,
				'data-tessefakt-gadgets':'verifiable',
				events:{
					click:this._click.bind(this),
					keydown:this._keydown.bind(this)
				},
				tabindex:'0'
			}).inject(this._oParent.inject);
		}else if(this._oConfig.key){
			this._dElement=new Element('a',{
				html:this._oConfig.caption,
				'data-tessefakt-gadgets':'verifiable',
				events:{
					click:this._click.bind(this),
					keydown:this._keydown.bind(this)
				},
				tabindex:'0'
			}).inject(this._oParent.inject);
		}else{
			this._dElement=new Element('span',{
				html:this._oConfig.caption,
				'data-tessefakt-gadgets':'verifiable'
			}).inject(this._oParent.inject);
		}
	}
	presentLoading(){}
	presentUpdate(){}
	destructor(){
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		this._dElement.dispose();
	}
	verify({verification}){
		if(!verification){
			if(this._oConfig.verification){
				var bVerification=this._oTessefakt.mscript({
					script:this._oConfig.verification,
					water:this.water
				});
			}else{
				var bVerification=true;
			}
		}else{
			var bVerification=false;
		}
		this._dElement.set('data-tessefakt-verification',bVerification?'verified':'rejected');
		return bVerification;
	}
	_click(e){
		switch(e.button){
			case 0: e.preventDefault(); this._commit(e); break;
		}
	}
	_keydown(e){
		switch(e.keyCode){
			case 32: case 13: e.preventDefault(); this._commit(e); break;
		}
	}
	_commit(e){
		if(this._oConfig.action){
			var oPost={};
			for(var i=0;i<(this._oConfig.action.post??[]).length;++i){
				oPost[this._oConfig.action.post[i].name]=this._oTessefakt.mscript({script:this._oConfig.action.post[i].field,water:this.water}).value;
			}
			this._oTessefakt.request({
				root:this._oRoot,
				get:this._oConfig.action.get??{},
				post:oPost,
				water:this.water,
				events:{
					load:this._load.bind(this)
				}
			});
		}else if(this._oConfig.key){
			var o={delivery:{},page:this._oParent._oParent._oParent};
			for(var i=0;i<this._oConfig.delivery.length;++i){
				o.delivery[this._oConfig.delivery[i].name]=this._oTessefakt.mscript({script:this._oConfig.delivery[i].field,water:this.water}).value;
			}
			this._oTessefakt.open({...this._oConfig.key,options:o});
		}
	}
	_load(e){
		if(e.target.responseJson.recommendation.indexOf('select')!=-1){
			var oSelectSequence=this._oTessefakt.mscript({script:this._oConfig['select-sequence'],water:this.water});
			oSelectSequence.splice(0,oSelectSequence.length,...e.target.responseJson.data.insert);
		}
		if(e.target.responseJson.recommendation.indexOf('refresh')!=-1){
			this._oTessefakt.refresh();
		}
		if(e.target.responseJson.recommendation.indexOf('return')!=-1){
			this._oTessefakt.close({page:this._oParent._oParent._oParent,autovalidate:true});
		}
	}
	get water(){
		return this._oParent.water;
	}
};
