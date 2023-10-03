var cTessefaktRenderNavigationDisplay=class{
	constructor({tessefakt,parent,config,events}){
		this.__declare();
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oConfig=config;
		this._oEvents=events;
		this._display();
	}
	__declare(){
		this._oTessefakt;
		this._oParent;
		this._oConfig;
		this._oEvents;
		this._oIcon;
	}
	destructor(){
		this._oIcon?.destructor();
		delete this._oIcon;
		delete this._oEvents;
		delete this._oConfig;
		delete this._oParent;
		delete this._oTessefakt;
	}
	_display(){}
	get inject(){}
}