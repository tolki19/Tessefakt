var cTessefaktIcon=class{
    constructor({tessefakt,parent,config}){
        this.__declare();
        this._oTessefakt=tessefakt;
        this._oParent=parent;
        this._oConfig=config;
        this._display();
    }
    __declare(){
        this._oTessefakt;
        this._oParent;
        this._oConfig;
        this._di;
    }
    destructor(){
        this._dI.dispose();
        delete this._dI;
        delete this._oConfig;
        delete this._oParent;
        delete this._oTessefakt;
    }
    _display(){
        switch(this._oConfig.type){
            case 'url':
    			this._dI=new Element('i').inject(this._oParent.inject);
	    		this._dI.style.webkitMaskImage='url("'+this._oConfig.href+'");';
			    this._dI.style.maskImage='url("'+this._oConfig.href+'");';
                break;
            case 'mso':
    			this._dI=new Element('i.mso',{html:this._oConfig.caption}).inject(this._oParent.inject);
                break;
        }
    }
}