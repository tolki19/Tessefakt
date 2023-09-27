var cTessefaktElementSelectLabel=class extends cTessefaktElementFormLabel{
	constructor({mdf,parent,config}){
		super({mdf,parent,config});
		this._dLabel.addEvents({
			blur:this._blur.bind(this),
			click:this._click.bind(this)
		});
	}
	_blur(e){
		this._oParent.removeFlag('data-tessefakt-control-state','switch');
	}
	_click(e){
		this._oParent.toggleFlag('data-tessefakt-control-state','switch');
	}
};
