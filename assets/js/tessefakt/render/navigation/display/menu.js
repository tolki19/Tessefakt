var cTessefaktRenderNavigationDisplayMenu=class extends cTessefaktRenderNavigationDisplay{
	__declare(){
		super.__declare();
		this._dDiv;
		this._oDepartment;
	}
	destructor(){
		this._oDepartment.destructor();
		delete this._oDepartment;
		this._dDiv.dispose();
		delete this._dDiv;
		super.destructor();
	}
	_display(){
		this._dDiv=new Element('div').inject(this._oParent.inject);
		this._oDepartment=new cTessefaktRenderNavigationDepartment({
			tessefakt:this._oTessefakt,
			parent:this,
			config:this._oParent.config,
			descriptor:this._oParent.descriptor
		});
	}
	flag(key){
		return this._oDepartment.flag(key);
	}
	unflag(key){
		return this._oDepartment.unflag(key);
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dDiv;
	}
}