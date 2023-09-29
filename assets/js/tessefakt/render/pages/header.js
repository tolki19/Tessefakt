var cTessefaktRenderPagesHeader=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dHeader;
	_oAppsMenu;
	$change;
	constructor({tessefakt,parent,config}){
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dHeader=new Element('header').inject(this._oParent.inject);
		this._oAppsMenu=new cTessefaktRenderNavigationApps({
			tessefakt:this._oMdf,
			parent:this,
			config:this._oConfig.apps
		});
		this.$change=this._change.bind(this);
		this._oMdf.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).addEventListener('change',this.$change);
	}
	destructor(){
		this._oMdf.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).removeEventListener('change',this.$change);
		this._oAppsMenu.destructor();
		this._dHeader.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._dHeader;
		delete this._oAppsMenu;
		delete this.$change;
	}
	_change(e){
		var oKey=this._oMdf.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		});
		this._oAppsMenu.verifyDisplay({
			app:{
				value:oKey.value.app,
				formerValue:oKey.formerValue.app
			},
			index:{
				value:oKey.value.index,
				formerValue:oKey.formerValue.index
			}
		});
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dHeader;
	}
	get water(){
		return this._oParent.water;
	}
	set key(value){
		this._oMdf.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).parse(value);
	}
};