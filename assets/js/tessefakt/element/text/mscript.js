var cTessefaktHTMLElementMscript=class extends cTessefaktElementText{
	constructor({tessefakt,parent,config,water}){
		super({tessefakt,parent,config,water});
		this._oTessefakt.mscript({
			script:this._oConfig.script,
			water:this.water
		}).addEventListener('change',this._change.bind(this));
	}
	_display(){
		var mValue=this._oTessefakt.mscript({
			script:this._oConfig.script,
			water:this.water
		}).value;
		if(mValue===null){
			this._aSubjects.push((new Element('span',{'data-tessefakt-role':'null'})).inject(this._oParent.inject));
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