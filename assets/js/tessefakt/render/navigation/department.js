var cTessefaktRenderNavigationDepartment=class{
	_oTessefakt;
	_oParent;
	_oConfig;
	_sDescriptor;
	_aSubjects=[];
	constructor({tessefakt,parent,config,descriptor}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._sDescriptor=descriptor;
		this._dMenu=new Element('menu',{
			'data-tessefakt-role':'department'
		}).inject(this._oParent.inject);
		for(var i=0;i<this._oConfig.navigation.length;++i){
			switch(this._oConfig.navigation[i].type){
				case 'group':
					this._aSubjects.push(new cTessefaktRenderNavigationSubjectGroup({
							tessefakt:this._oTessefakt,
							parent:this,
							config:this._oConfig.navigation[i],
							descriptor:this._sDescriptor+'-'+i
						})
					);
					break;
				case 'sep':
					var dLi=new Element('li',{html:'<hr>'}).inject(this.inject);
					break;
				case 'action':
					this._aSubjects.push(new cTessefaktRenderNavigationSubjectAction({
							tessefakt:this._oTessefakt,
							parent:this,
							config:this._oConfig.navigation[i]
						})
					);
					break;
				case 'page':
					this._aSubjects.push(new cTessefaktRenderNavigationSubjectPage({
							tessefakt:this._oTessefakt,
							parent:this,
							config:this._oConfig.navigation[i]
						})
					);
					break;
				case 'dialog':
					this._aSubjects.push(new cTessefaktRenderNavigationSubjectDialog({
							tessefakt:this._oTessefakt,
							parent:this,
							config:this._oConfig.navigation[i]
						})
					);
					break;
			}
		}
	}
	destructor(){
		for(var i=0;i<this._aSubjects.length;++i) this._aSubjects[i].destructor();
		delete this._oTessefakt;
		delete this._oParent;
		delete this._oConfig;
		delete this._sDescriptor;
		delete this._aSubjects;
	}
	flag(key){
		var b=false;
		for(var i=0;i<this._aSubjects.length;++i) b|=this._aSubjects[i].flag(key);
		this._dMenu.set('data-tessefakt-state','active');
		return b;
	}
	unflag(key){
		var b=false;
		for(var i=0;i<this._aSubjects.length;++i) b|=this._aSubjects[i].unflag(key);
		this._dMenu.erase('data-tessefakt-state');
		return b;
	}
	get indice(){
		return this._oParent.indice;
	}
	get inject(){
		return this._dMenu;
	}
};