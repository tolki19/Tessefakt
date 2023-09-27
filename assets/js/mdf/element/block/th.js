var cMdfHTMLElementTh=class extends cMdfElementBlock{
	_display(){
		super._display();
		if(this._oConfig.colspan) this._dElement.set('colspan',this._oConfig.colspan);
	}
};
