var cMdfGadgetSingleselectable=class extends cMdfGadget{
	constructor(o){
		super(o);
		this.$change=this._change.bind(this);
		this._dElement.set('data-mdf-gadgets',(this._dElement.get('data-mdf-gadgets')??'').split(' ').concat(['selectable']).join(' ').trim());
		this._dElement.addEvent('click',this._click.bind(this));
		this._oMdf.mscript({script:this._oConfig['select-index'],water:this.water}).addEventListener('change',this.$change);
		this._display();
	}
	destructor(){
		this._oMdf.mscript({script:this._oConfig['select-index'],water:this.water}).removeEventListener('change',this.$change);
		super.destructor();
		delete this.$change;
	}
	_click(e){
		e.preventDefault();
		var oIndex=this._oMdf.mscript({script:this._oConfig['select-index'],water:this.water});
		var oValue=this._oMdf.mscript({script:this._oConfig.value,water:this.water});
		oIndex.value=oValue.value;
	}
	_change(e){
		e.preventDefault();
		this._display();
	}
	_display(){
		var oIndex=this._oMdf.mscript({script:this._oConfig['select-index'],water:this.water});
		var oValue=this._oMdf.mscript({script:this._oConfig.value,water:this.water});
		if(oIndex.value==oValue.value) this._dElement.set('data-mdf-select',true);
		else this._dElement.set('data-mdf-select',false);
	}
};