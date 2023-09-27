var cTessefaktHTMLElementBlockquote=class extends cTessefaktElementBlock{
	_display(){
		super._display();
		if(this._oConfig.cite) this._dElement.set('cite',this._oConfig.cite);
	}
};
