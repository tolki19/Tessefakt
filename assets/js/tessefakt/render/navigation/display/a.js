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
		this._dA=new Element('a',{
			events:this._oEvents,
			tabindex:'0'
		}).inject(this._oParent.inject);
console.debug(this._oParent.config);
		if(this._oParent.config.icon){
			this._oIcon=new cTessefaktIcon({
				tessefakt:this._oTessefakt,
				parent:this,
				config:this._oParent.config.icon
			});
		}
		if(this._oParent.config.caption){
			this._dSpan=new Element('span',{html:this._oParent.config.caption}).inject(this._dA);
		}
	}
	get inject(){
		return this._dA;
	}
}