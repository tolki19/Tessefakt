var cMdfHTMLElementMscript=class extends cMdfElementText{
	constructor({mdf,parent,config,water}){
		super({mdf,parent,config,water});
		this._oMdf.mscript({
			script:this._oConfig.script,
			water:this.water
		}).addEventListener('change',this._change.bind(this));
	}
	_display(){
		var mValue=this._oMdf.mscript({
			script:this._oConfig.script,
			water:this.water
		}).value;
		if(mValue===null){
			this._aSubjects.push((new Element('span',{'data-mdf-role':'null'})).inject(this._oParent.inject));
		}else{
			this._aSubjects.push(this._oParent.inject.appendChild(document.createTextNode(mValue)));
		}
	}
	presentLoading(){}
	presentUpdate(){
		for(var i=0;i<this._aSubjects.length;++i){
			this._aSubjects[i].parentNode.removeChild(this._aSubjects[i]);
		}
		this._aSubjects=[];
		this._display();
	}
	_change(e){
		this.presentUpdate();
	}
};