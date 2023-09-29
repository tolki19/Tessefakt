var cTessefaktRenderNavigationSubjectDialog=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_dA;
	_dI;
	_dSpan;
	constructor({tessefakt,parent,config}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		var dLi=new Element('li').inject(this._oParent.inject);
		this._dA=new Element('a',{
			events:{
				click:this._click.bind(this)
			},
			tabindex:'0'
		}).inject(dLi);
		if(this._oConfig.icon){
			this._dI=new Element('i').inject(this._dA);
			this._dI.style.webkitMaskImage='url("'+this._oConfig.icon+'")';
			this._dI.style.maskImage='url("'+this._oConfig.icon+'")';
		}
		if(this._oConfig.caption){
			this._dSpan=new Element('span',{html:this._oConfig.caption}).inject(this._dA);
		}
	}
	destructor(){
		if(this._dI) this._dI.dispose();
		if(this._dSpan) this._dSpan.dispose();
		this._dA.dispose();
		delete this._dLi;
		delete this._dA;
		delete this._dI;
		delete this._dSpan;
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._sDescriptor;
	}
	flag(key){
		if(key.app.value==this._oConfig.key.app&&key.index.value==this._oConfig.key.index){
			this._dA.set('data-tessefakt-state','active');
			return true;
		}
		return false;
	}
	unflag(key){
		if(key.app.formerValue==this._oConfig.key.app&&key.index.formerValue==this._oConfig.key.index){
			this._dA.erase('data-tessefakt-state');
			return true;
		}
		return false;
	}
	_click(e){
		e.preventDefault();
		this._oTessefakt.panic(this._oConfig.key);
	}
};