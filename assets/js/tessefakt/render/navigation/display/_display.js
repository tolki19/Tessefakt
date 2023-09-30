var cTessefaktRenderNavigationDisplay=class{
	constructor({tessefakt,parent,events}){
		this.__declare();
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oEvents=events;
		this._display();
	}
	__declare(){
		this._oTessefakt;
		this._oParent;
		this._oEvents;
		this._oIcon;
	}
	destructor(){
		this._oIcon?.destructor();
		delete this._oIcon;
		delete this._oEvents;
		delete this._oParent;
	}
	_display(){}
	get inject(){}
	get config(){
		return this._oParent.config;
	}
}