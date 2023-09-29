var cTessefaktRenderNavigationDisplayMenu=class extends cTessefaktRenderNavigationDisplay{
	_dDiv;
	_oMenu;
	destructor(){
		this._oMenu.destructor();
		delete this._oMenu;
		this._dDiv.dispose();
		delete this._dDiv;
		super.destructor();
	}
	_display(){
		this._dDiv=new Element('div').inject(this._dLi);
		this._oMenu=new cTessefaktRenderNavigationDepartment({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oParent.config,
			descriptor:this._OParent.descriptor
		});
	}
	flag(key){
		return this._oMenu.flag(key);
	}
	unflag(key){
		return this._oMenu.unflag(key);
	}
	get inject(){
		return this._dDiv;
	}
}