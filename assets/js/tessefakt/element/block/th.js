var cTessefaktHTMLElementTh=class extends cTessefaktElementBlock{
	_display(){
		super._display();
		if(this._oConfig.colspan) this._dElement.set('colspan',this._oConfig.colspan);
	}
};
