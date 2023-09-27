var cMdfHTMLElementFieldset=class extends cMdfElementBlock{
	_display(){
		super._display();
		this._dElement.set('data-tessefakt-role','fieldset');
	}
};