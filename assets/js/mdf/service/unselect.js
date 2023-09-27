var cMdfServiceUnselect=class extends cMdfService{
	execute(){
		var oSelectSequence=this._oMdf.mscript({script:this._oConfig['select-sequence'],water:this.water});
		var oSequence=this._oMdf.mscript({script:this._oConfig['target-sequence'],water:this.water});
		for(var i=0;i<oSelectSequence.length;++i) if(oSequence.indexOf(oSelectSequence[i])==-1) oSelectSequence.splice(i--,1);
	}
};
