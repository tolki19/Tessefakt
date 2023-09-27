var cTessefaktHTMLElementInput=class extends cTessefaktElementForm{
	_display(){
		super._display();
		if(this._oConfig.tabindex!=undefined) this._dElement.set('tabindex',this._oConfig.tabindex);
		if(this._oConfig.value){
			this._oMdf.mscript({
				script:this._oConfig.value,
				water:this.water
			}).addEventListener('change',this._change.bind(this));
			this._dElement.value=this._oMdf.mscript({
				script:this._oConfig.value,
				water:this.water
			}).value;
			this._dElement.addEvent('change',this._changeElement.bind(this));
		}
	}
	_change(e){
		if(this._oConfig.value){
			this._dElement.value=this._oMdf.mscript({script:this._oConfig.value,water:this.water}).value;
		}
	}
	_changeElement(e){
		if(this._oConfig.value){
			this._oMdf.mscript({script:this._oConfig.value,water:this.water}).value=this._dElement.value;
		}
	}
};
