var cTessefaktRenderNavigationDisplayLabel=class extends cTessefaktRenderNavigationDisplay{
	__declare(){
		super.__declare();
		this._dLabel;
		this._dInput;
		this._oIcon;
		this._dSpan;
	}
	destructor(){
		this._oIcon.destructor();
		delete this._oIcon;
		this._dSpan.dispose();
		delete this._dSpan;
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
		this._dInput=new Element('input#'+this._oParent.descriptor,{type:'checkbox'}).inject(this._oParent.inject);
		this._dLabel=new Element('label',{
			for:this._oParent.descriptor,
			tabindex:'0'
		}).inject(this._oParent.inject);
		if(this._oConfig.icon){
			this._oIcon=new cTessefaktIcon({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oConfig.icon
			});
		}
		if(this._oConfig.caption){
			this._dSpan=new Element('span',{html:this._oConfig.caption}).inject(this._dLabel);
		}
	}
	get inject(){
		return this._dLabel;
	}
}