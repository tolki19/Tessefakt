var cTessefaktElementFormPan=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dPan;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._display();
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		this._aSubjects=[];
		this._dPan.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dPan;
		delete this._aSubjects;
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
		}else{
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].presentUpdate();
			}
		}
	}
	_display(){
		this._dPan=new Element('div',{'data-tessefakt-control-role':'pan'}).inject(this._oParent.inject);
		if(!(this._oConfig.sequence&&this._oConfig.collection)) this._displayChildren({water:this.water});
	}
	_displayCycle(){
		this.bucket.data.sequence=this._oTessefakt.mscript({script:this._oConfig.sequence,water:this.water});
		this.bucket.data.collection=this._oTessefakt.mscript({script:this._oConfig.collection,water:this.water});
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
				if(this._oTessefakt.mscript({script:this._oConfig.index,water:oWater}).value==this._oTessefakt.mscript({script:this._oConfigkey,water:oWater}).value) this._displayChildren({water:oWater});
			}
		}
	}
	_displayChildren({water}){
		for(var i=0;i<(this._oConfig.contents??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.contents[i].name.camelize();
			this._aSubjects.push(new window[sObject]({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.contents[i],water:water}));
		}
	}
	_displayLoading({water}){
		for(var i=0;i<(this._oConfig.loading??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.loading[i].name.camelize();
			this._aSubjects.push(new window[sObject]({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.loading[i],water:water}));
		}
	}
	_displayEmpty({water}){
		for(var i=0;i<(this._oConfig.empty??[]).length;++i){
			var sObject='cTessefaktHTMLElement'+this._oConfig.empty[i].name.camelize();
			this._aSubjects.push(new window[sObject]({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.empty[i],water:water}));
		}
	}
	_change(e){}
	get water(){
		return this._oParent.water;
	}
	get bucket(){
		return this._oParent.bucket;
	}
	get inject(){
		return this._dPan;
	}
};
