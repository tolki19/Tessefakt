var cTessefaktRenderNavigationApp=class{
	_oMdf;
	_oParent;
	_oConfig;
	_sDescriptor;
	_dLi;
	_dA;
	_dI;
	_dSpan;
	_oSubjectDepartment;
	constructor({tessefakt,parent,config,descriptor}){
		this._oMdf=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._sDescriptor=descriptor;
		this._dLi=new Element('li').inject(this._oParent.inject);
		this._dA=new Element('a',{
			events:{
				click:this._click.bind(this)
			},
			tabindex:'0'
		}).inject(this._dLi);
		if(this._oConfig.navigation.icon){
			this._dI=new Element('i').inject(this._dA);
			this._dI.style.webkitMaskImage='url("'+this._oConfig.navigation.icon+'")';
			this._dI.style.maskImage='url("'+this._oConfig.navigation.icon+'")';
		}
		if(this._oConfig.navigation.caption){
			this._dSpan=new Element('span',{html:this._oConfig.navigation.caption}).inject(this._dA);
		}
		this._oSubjectDepartment=new cTessefaktRenderNavigationDepartment({
			tessefakt:this._oMdf,
			parent:this._oParent._oParent,
			config:this._oConfig.navigation,
			descriptor:this._sDescriptor
		});
	}
	destructor(){
		this._oSubjectDepartment.destructor();
		this._dLi.dispose();
		this._dA.dispose();
		this._dI?.dispose();
		this._dSpan.dispose();
		delete this._oMdf;
		delete this._oParent;
		delete this._oConfig;
		delete this._sDescriptor;
		delete this._dLi;
		delete this._dA;
		delete this._dI;
		delete this._dSpan;
		delete this._oSubjectDepartment;
	}
	flag(key){
		this._dA.set('data-tessefakt-state','active');
		this._oSubjectDepartment.flag(key);
	}
	unflag(key){
		this._dA.erase('data-tessefakt-state');
		this._oSubjectDepartment.unflag(key);
	}
	_click(e){
		this._oParent.key={app:this._sDescriptor,index:undefined};
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dMenu;
	}
};
