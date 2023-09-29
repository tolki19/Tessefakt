var cTessefaktEntityPageMain=class extends cTessefaktEntityMain{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dMain;
	_aSubjects=[];
	constructor({tessefakt,parent,config}){
		super();
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dMain=new Element('main').inject(this._oParent.inject);
		if(this._oConfig.unselect) this._oUnselect=new cTessefaktServiceUnselect({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.unselect});
		for(var i=0;i<(this._oConfig.gadgets??[]).length;++i){
			this._oGadgets[this._oConfig.gadgets[i].type]=new window['cTessefaktGadget'+this._oConfig.gadgets[i].type.camelize()]({tessefakt:this._oTessefakt,parent:this,config:this._oConfig.gadgets[i],element:this._dElement});
		}
		if(!(this._oConfig.sequence&&this._oConfig.collection)){
			this._displayChildren({
				water:this.water
			});
		}
	}
	_displayCycle(){
		this.bucket.data.sequence=this._oTessefakt.mscript({
			script:this._oConfig.sequence,
			water:this.water
		});
		this.bucket.data.collection=this._oTessefakt.mscript({
			script:this._oConfig.collection,
			water:this.water
		});
		if(!this.bucket.data.sequence.length){
			this._displayEmpty({
				water:this.water
			});
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
				this._displayChildren({
					water:oWater
				});
			}
			if(this._oUnselect){
				this._oUnselect.execute({
					bucket:oBucket
				});
			}
		}
	}
	_displayChildren({water}){
		for(var i=0;i<(this._oConfig.contents??[]).length;++i){
			this._aSubjects.push(new window['cTessefaktHTMLElement'+this._oConfig.contents[i].name.camelize()]({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.contents[i],
				water:water
			}));
		}
	}
	_displayLoading({water}){
		for(var i=0;i<(this._oConfig.loading??[]).length;++i){
			this._aSubjects.push(new window['cTessefaktHTMLElement'+this._oConfig.loading[i].name.camelize()]({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.loading[i],
				water:water
			}));
		}
	}
	_displayEmpty({water}){
		for(var i=0;i<(this._oConfig.empty??[]).length;++i){
			this._aSubjects.push(new window['cTessefaktHTMLElement'+this._oConfig.empty[i].name.camelize()]({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.empty[i],
				water:water
			}));
		}
	}
	presentLoading(){
		if(this._oConfig.loading){
			for(var i=0;i<this._aSubjects.length;++i){
				this._aSubjects[i].destructor();
			}
			this._aSubjects=[];
			this._displayLoading({
				water:this.water
			});
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
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].destructor();
		}
		if(this._oConfig.desc) this._oRoot.unregisterDescription(this._oConfig.desc,this);
		if(this._oRequest) this._oRequest.destructor();
		delete this._oRequest;
		if(this._oRequestChange) this._oRequestChange.destructor();
		delete this._oRequestChange;
		if(this._oUnselect) this._oUnselect.destructor();
		delete this._oUnselect;
		for(var k in this._oGadgets){
			this._oGadgets[k].destructor();
		}
		this._dMain.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dMain;
	}
	get inject(){
		return this._dMain;
	}
	get water(){
		return this._oParent.water;
	}
	get bucket(){
		return this._oParent.bucket;
	}
};
