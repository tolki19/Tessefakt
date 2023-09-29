var cTessefaktRenderNavigationSubjectAction=class{
	_oMdf;
	_oParent;
	_oConfig;
	_dA;
	_dI;
	_dSpan;
	constructor({tessefakt,parent,config}){
		this._oMdf=tessefakt;
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
		this._dA.dispose();
		if(this._dI) this._dI.dispose();
		if(this._dSpan) this._dSpan.dispose();
		delete this._dLi;
		delete this._dA;
		delete this._dI;
		delete this._dSpan;
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._sDescriptor;
	}
	flag(sKey){
		if(false) this._dA.set('data-tessefakt-state','active');
		return false;
	}
	unflag(sKey){
		if(false) this._dA.erase('data-tessefakt-state');
		return false;
	}
	_click(e){
		e.preventDefault();
		this._oMdf.logout();
	}
};
