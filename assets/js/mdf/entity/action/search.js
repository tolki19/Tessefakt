var cMdfEntityActionSearch=class extends cMdfEntityAction{
	_display(){
		super._display();
		this._dSpan=new Element('span',{'data-tessefakt-role':'control','data-tessefakt-control':this._oConfig.type}).inject(this._dLi);
		this._dLabel=new Element('label',{'data-tessefakt-control-role':'label'}).inject(this._dSpan);
		this._dElement=new Element('input',{
			type:'search',
			'data-tessefakt-control-role':'display',
			events:{
				input:this._input.bind(this)
			},
			value:this._oMdf.mscript({script:this._oConfig.field,water:this.water}).value,
			autocapitalize:'off',
			autofill:'off',
			spellcheck:'off',
			tabindex:'0',
			placeholder:this._oConfig.placeholder??''
		}).inject(this._dLabel);
	}
	destructor(){
		super.destructor();
		this._dElement.dispose();
		this._dLabel.dispose();
		this._dSpan.dispose();
		delete this._oRequestTimeout;
		delete this._oRequestValue;
	}
	_input(e){
		e.preventDefault();
		if(this._oRequestValue==this.value) return;
		if(this._oRequestTimeout){
			clearTimeout(this._oRequestTimeout);
			this._oRequestTimeout=undefined;
		}
		this._oRequestTimeout=setTimeout(this._timeout.bind(this),500);
		this._oRequestValue=this.value;
	}
	_timeout(e){
		clearTimeout(this._oRequestTimeout);
		this._oMdf.mscript({script:this._oConfig.field,water:this.water}).value=this.value;
	}
	get value(){
		return this._dElement.value;
	}
};