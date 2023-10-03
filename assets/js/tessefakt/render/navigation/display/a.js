var cTessefaktRenderNavigationDisplayA=class extends cTessefaktRenderNavigationDisplay{
	__declare(){
		super.__declare();
		this._dA;
		this._dSpan;
		this._oIcon;
	}
	destructor(){
		this._oIcon.destructor();
		delete this._oIcon;
		this._dSpan.dispose();
		delete this._dSpan;
		this._dA.dispose();
		delete this._dA;
		super.destructor();
	}
	flag(key){
		this._dA.set('data-tessefakt-state','active');
		return true;
	}
	unflag(key){
		this._dA.erase('data-tessefakt-state');
		return true;
	}
	_display(){
console.debug(this._oConfig);
		this._dA=new Element('a',{
			events:this._oEvents,
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
			this._dSpan=new Element('span',{html:this._oConfig.caption}).inject(this._dA);
		}
	}
	get inject(){
		return this._dA;
	}
}