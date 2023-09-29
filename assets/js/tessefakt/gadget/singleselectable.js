var cTessefaktGadgetSingleselectable=class extends cTessefaktGadget{
	constructor(o){
		super(o);
		this.$change=this._change.bind(this);
		this._dElement.set('data-tessefakt-gadgets',(this._dElement.get('data-tessefakt-gadgets')??'').split(' ').concat(['selectable']).join(' ').trim());
		this._dElement.addEvent('click',this._click.bind(this));
		this._oTessefakt.mscript({script:this._oConfig['select-index'],water:this.water}).addEventListener('change',this.$change);
		this._display();
	}
	destructor(){
		this._oTessefakt.mscript({script:this._oConfig['select-index'],water:this.water}).removeEventListener('change',this.$change);
		super.destructor();
		delete this.$change;
	}
	_click(e){
		e.preventDefault();
		var oIndex=this._oTessefakt.mscript({script:this._oConfig['select-index'],water:this.water});
		var oValue=this._oTessefakt.mscript({script:this._oConfig.value,water:this.water});
		oIndex.value=oValue.value;
	}
	_change(e){
		e.preventDefault();
		this._display();
	}
	_display(){
		var oIndex=this._oTessefakt.mscript({script:this._oConfig['select-index'],water:this.water});
		var oValue=this._oTessefakt.mscript({script:this._oConfig.value,water:this.water});
		if(oIndex.value==oValue.value) this._dElement.set('data-tessefakt-select',true);
		else this._dElement.set('data-tessefakt-select',false);
	}
};