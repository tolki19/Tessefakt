var cMdfEntityActionOrder=class extends cMdfEntityAction{
	_aVariants=[];
	constructor({mdf,parent,config}){
		super({mdf:mdf,parent:parent,config:config});
		var aRods=[];
		for(var i=0;i<this._oConfig.variants.length;++i){
			this._aVariants.push(new cMdfEntityActionOrderVariant({mdf:mdf,parent:this,config:this._oConfig.variants[i]}));
			aRods=aRods.concat(this._oMdf.mscriptRods({script:this._oConfig.variants[i]}));
		}
		this._aRods=aRods.filter(function(v,k,r){
			l: for(var i=0;i<k;++i){
				if(v.length!=r[i].length) continue l;
				for(var j=0;j<v.length;++j) if(v[j]!=r[i][j]) continue l;
				return false;
			}
			return true;
		});
		this.$change=this._change.bind(this);
		for(var i=0;i<this._aRods.length;++i){
			this._oMdf.mscript({script:this._aRods[i],water:this.water}).addEventListener('change',this.$change);
		}
		this._verify();
	}
	destructor(){
		for(var i=0;i<this._aRods.length;++i){
			this._oMdf.mscript({script:this._aRods[i],water:this.water}).removeEventListener('change',this.$change);
		}
		super.destructor();
		for(var i=0;i<this._aVariants.length;++i){
			this._aVariants[i].destructor();
		}
		this._dLi.dispose();
		delete this.$change;
	}
	_change(e){
		this._verify();
	}
	_verify(){
		var bVerified=false;
		for(var i=0;i<this._aVariants.length;++i) bVerified|=this._aVariants[i].verify({verification:bVerified});
	}
};