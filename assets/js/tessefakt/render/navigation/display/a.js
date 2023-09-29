var cTessefaktRenderNavigationDisplayA=class extends cTessefaktRenderNavigationDisplay{
	_dA;
	_dSpan;
	_dI;
	destructor(){
		this._dSpan.dispose();
		delete this._dSpan;
		this._dI.dispose();
		delete this._dI;
		this._dA.dispose();
		delete this._dA;
		super.destructor();
	}
	flag(key){
		if(key.app.value==this._oParent.config.key.app&&key.index.value==this._oParent.config.key.index){
			this._dA.set('data-tessefakt-state','active');
			return true;
		}
		return false;
	}
	unflag(key){
		if(key.app.formerValue==this._oParent.config.key.app&&key.index.formerValue==this._oParent.config.key.index){
			this._dA.erase('data-tessefakt-state');
			return true;
		}
		return false;
	}
	_display(){
		this._dA=new Element('a',{
			events:this._oEvents,
			tabindex:'0'
		}).inject(ths._oParent.inject);
		if(this._oParent.config.icon){
			this._dI=new Element('i').inject(this._dA);
			this._dI.style.webkitMaskImage='url("'+this._oParent.config.icon+'")';
			this._dI.style.maskImage='url("'+this._oParent.config.icon+'")';
		}
		if(this._oParent.config.caption){
			this._dSpan=new Element('span',{html:this._oParent.config.caption}).inject(this._dA);
		}
	}
	get inject(){
		return this._dA;
	}
}