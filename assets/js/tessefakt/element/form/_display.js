var cTessefaktElementFormDisplay=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dElement;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this.$change=this._change.bind(this);
		this._display();
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		this._aSubjects=[];
		this._dElement.dispose();
		this._oMdf.mscript({script:this._oConfig.index,water:this.water}).removeEventListener('change',this.$change);
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._dElement;
		delete this._aSubjects;
	}
	presentLoading(){
		this._oHandles.presentLoading();
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
		this._oHandles.presentUpdate();
		if(this._oConfig.sequence&&this._oConfig.collection){
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].destructor();
			}
			this._aSubjects=[];
			this._displayCycle();
		}else{
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentUpdate();
			}
		}
	}
	_display(){
		this._dElement=new Element('span',{'data-tessefakt-control-role':'display'}).inject(this._oParent.inject);
		this._oMdf.mscript({script:this._oConfig.index,water:this.water}).addEventListener('change',this.$change);
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
				if(this._oMdf.mscript({script:this._oConfig.index,water:oWater}).value==this._oMdf.mscript({script:this._oConfig.key,water:oWater}).value) this._displayChildren({water:oWater});
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
	_change(e){
		this.presentUpdate();
	}
	get water(){
		return this._oParent.water;
	}
	get bucket(){
		return this._oParent.bucket;
	}
	get inject(){
		return this._dElement;
	}
};
