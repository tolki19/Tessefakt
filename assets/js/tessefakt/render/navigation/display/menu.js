var cTessefaktRenderNavigationDisplayMenu=class extends cTessefaktRenderNavigationDisplay{
	__declare(){
		super.__declare();
		this._dDiv;
		this._oMenu;
	}
	destructor(){
		this._oMenu.destructor();
		delete this._oMenu;
		this._dDiv.dispose();
		delete this._dDiv;
		super.destructor();
	}
	_display(){
		this._dDiv=new Element('div').inject(this._oParent.inject);
		this._oMenu=new cTessefaktRenderNavigationSubjectMenu({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oConfig,
			descriptor:this._oParent.descriptor
		});
	}
	flag(key){
		return this._oMenu.flag(key);
	}
	unflag(key){
		return this._oMenu.unflag(key);
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dDiv;
	}
}