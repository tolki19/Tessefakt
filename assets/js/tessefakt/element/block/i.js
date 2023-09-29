var cTessefaktHTMLElementI=class extends cTessefaktElementBlock{
	_display(){
		super._display();
		if(this._oConfig['control-role']) this._dElement.set('data-tessefakt-control-role',this._oConfig['control-role']);
	}
};
