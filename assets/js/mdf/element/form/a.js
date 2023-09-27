var cMdfHTMLElementA=class extends cMdfFormButton{
	_display(){
		super._display();
		if(this._oConfig.href??false) this._dElement.set('href',this._oConfig.href);
	}
};
