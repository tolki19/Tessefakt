var cTessefaktHTMLElementPassword=class extends cTessefaktElementForm{
	_display(){
		super._display();
		this._dElement.set('type','password');
		if(this._oConfig.tabindex!=undefined) this._dElement.set('tabindex',this._oConfig.tabindex);
	}
};