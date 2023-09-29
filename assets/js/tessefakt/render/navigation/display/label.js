var cTessefaktRenderNavigationDisplayLabel=class extends cTessefaktRenderNavigationDisplay{
	_dLabel;
	_dInput;
	_dI;
	_dSpan;
	destructor(){
		this._dSpan.dispose();
		delete this._dSpan;
		this._dI.dispose();
		delete this._dI;
		this._dInput.dispose();
		delete this._dInput;
		this._dLabel.dispose();
		delete this._dLabel;
		super.destructor();
	}
	check(value){
		this._dInput.checked=value;
		return value;
	}
	_display(){
		this._dInput=new Element('input#'+this._sDescriptor,{type:'checkbox'}).inject(this._oParent.inject);
		this._dLabel=new Element('label',{
			for:this._sDescriptor,
			tabindex:'0'
		}).inject(this._oParent.inject);
		if(this._oParent.config.icon){
			this._dI=new Element('i').inject(this._dLabel);
			this._dI.style.webkitMaskImage='url("'+this._oParent.config.icon+'")';
			this._dI.style.maskImage='url("'+this._oParent.config.icon+'")';
		}
		if(this._oParent.config.caption){
			this._dSpan=new Element('span',{html:this._oParent.config.caption}).inject(this._dLabel);
		}
	}
	get inject(){
		return this._dLabel;
	}
}