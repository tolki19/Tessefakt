var cMdfHTMLElementSelect=class extends cMdfElementForm{
	_display(){
		this._dSpan=new Element('span',{
			'data-mdf-role':'control',
			'data-mdf-control':this._oConfig.name
		}).inject(this._oParent.inject);
		this._oLabel=new cMdfElementSelectLabel({mdf:this._oMdf,parent:this,config:this._oConfig});
		this._oPan=new cMdfElementSelectPan({mdf:this._oMdf,parent:this,config:this._oConfig.pan});
		if(this._oConfig.desc) this.registerDescription(this._oConfig.desc,this);
	}
	destructor(){
		this._oLabel.destructor();
		this._oPan.destructor();
		super.destructor();
	}
	presentLoading(){
		super.presentLoading();
		this._oLabel.presentLoading();
		this._oPan.presentLoading();
	}
	presentUpdate(){
		super.presentUpdate();
		this._oLabel.presentUpdate();
		this._oPan.presentUpdate();
	}
	addFlag(flag,value){
		var sFlag=this._dSpan.get(flag);
		if(!sFlag) this._dSpan.set(flag,value);
		else{
			var aValues=sFlag.split(' ');
			if(aValues.indexOf(value)==-1){
				aValues.push(value);
				this._dSpan.set(flag,aValues.join(' '));
			}
		}
	}
	removeFlag(flag,value){
		var sFlag=this._dSpan.get(flag);
		if(!sFlag) this._dSpan.erase(flag);
		else{
			var aValues=sFlag.split(' ');
			var iIndex=aValues.indexOf(value);
			if(iIndex!=-1){
				aValues.splice(iIndex,1);
				if(aValues.length) this._dSpan.set(flag,aValues.join(' '));
				else this._dSpan.erase(flag);
			}
		}
	}
	toggleFlag(flag,value){
		var sFlag=this._dSpan.get(flag);
		if(!sFlag) this._dSpan.set(flag,value);
		else{
			var aValues=sFlag.split(' ');
			var iIndex=aValues.indexOf(value);
			if(iIndex!=-1){
				aValues.splice(iIndex,1);
				if(aValues.length) this._dSpan.set(flag,aValues.join(' '));
				else this._dSpan.erase(flag);
			}else{
				aValues.push(value);
				this._dSpan.set(flag,aValues.join(' '));
			}
		}
	}
	get inject(){
		return this._dSpan;
	}
};
