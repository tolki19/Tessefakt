var cTessefaktRenderPagesHeader=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dHeader;
	_oAppsMenu;
	$change;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._dHeader=new Element('header').inject(this._oParent.inject);
		this._oAppsMenu=new cTessefaktRenderNavigationAppMenu({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig.apps
		});
		this.$change=this._change.bind(this);
		this._oTessefakt.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).addEventListener('change',this.$change);
	}
	destructor(){
		this._oTessefakt.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).removeEventListener('change',this.$change);
		this._oAppsMenu.destructor();
		this._dHeader.dispose();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._dHeader;
		delete this._oAppsMenu;
		delete this.$change;
	}
	_change(e){
		var oKey=this._oTessefakt.mscript({
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
		this._oTessefakt.mscript({
			script:this._oConfig.construct.key,
			water:this.water
		}).parse(value);
	}
};