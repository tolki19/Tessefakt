var cTessefaktGadgetMultiselectable=class extends cTessefaktGadget{
	constructor(o){
		super(o);
		this.$change=this._change.bind(this);
		this._dElement.set('data-tessefakt-gadgets',(this._dElement.get('data-tessefakt-gadgets')??'').split(' ').concat(['selectable']).join(' ').trim());
		this._dElement.addEvent('click',this._click.bind(this));
		this._oTessefakt.mscript({script:this._oConfig['select-sequence'],water:this.water}).addEventListener('change',this.$change);
		this._display();
	}
	destructor(){
		this._oTessefakt.mscript({script:this._oConfig['select-sequence'],water:this.water}).removeEventListener('change',this.$change);
		super.destructor();
		delete this.$change;
	}
	_click(e){
		e.preventDefault();
		var oSequence=this._oTessefakt.mscript({script:this._oConfig['select-sequence'],water:this.water});
		var oValue=this._oTessefakt.mscript({script:this._oConfig.value,water:this.water});
		var i=oSequence.indexOf(oValue.value);
		if(e.ctrlKey){
			if(i==-1) oSequence.push(oValue.value);
			else oSequence.splice(i,1);
		}else{
			oSequence.splice(0,oSequence.length,oValue.value);
		}
	}
	_change(e){
		e.preventDefault();
		this._display();
	}
	_display(){
		var oSequence=this._oTessefakt.mscript({script:this._oConfig['select-sequence'],water:this.water});
		var oValue=this._oTessefakt.mscript({script:this._oConfig.value,water:this.water});
		if(oSequence.indexOf(oValue.value)==-1) this._dElement.set('data-tessefakt-select',false);
		else this._dElement.set('data-tessefakt-select',true);
	}
};
