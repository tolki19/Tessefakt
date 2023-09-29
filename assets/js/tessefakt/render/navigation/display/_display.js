var cTessefaktRenderNavigationDisplay=class{
	_oTessefakt;
	_oParent;
	_oEvents;
	_oIcon;
	constructor({tessefakt,parent,events}){
		this._oTessefakt=tessefakt;
		this._oParent=parent;
		this._oEvents=events;
		this._display();
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