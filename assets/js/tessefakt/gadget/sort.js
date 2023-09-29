var cTessefaktGadgetSort=class extends cTessefaktGadget{
	constructor(o){
		super(o);
		this.$change=this._change.bind(this);
		this._dElement.set('data-tessefakt-gadgets',(this._dElement.get('data-tessefakt-gadgets')??'').split(' ').concat(['sortable']).join(' ').trim());
		this._dElement.addEvent('click',this._click.bind(this));
		this._oTessefakt.mscript({script:this._oConfig.field,water:this.water}).addEventListener('change',this.$change);
		this._display();
	}
	destructor(){
		this._oTessefakt.mscript({script:this._oConfig.field,water:this.water}).removeEventListener('change',this.$change);
		super.destructor();
		delete this.$change;
	}
	_click(e){
		e.preventDefault();
		var oField=this._oTessefakt.mscript({script:this._oConfig.field,water:this.water});
		var iToggle=this._oConfig.toggles.findIndex(v=>v.value===oField.value);
		if(iToggle>=0&&iToggle<this._oConfig.toggles.length-1) var sValue=this._oConfig.toggles[iToggle+1].value;
		else var sValue=this._oConfig.toggles[0].value;
		oField.value=sValue;
	}
	_change(e){
		e.preventDefault();
		this._display();
	}
	_display(){
		var oField=this._oTessefakt.mscript({script:this._oConfig.field,water:this.water});
		var iToggle=this._oConfig.toggles.findIndex(v=>v.value===oField.value);
		if(iToggle>=0) this._dElement.set('data-tessefakt-sort',this._oConfig.toggles[iToggle].sort);
		else this._dElement.erase('data-tessefakt-sort');
	}
};