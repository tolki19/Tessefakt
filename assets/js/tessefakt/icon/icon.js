var cTessefaktIcon=class{
    _oTessefakt;
    _oParent;
    _oConfig;
    constructor({tessefakt,parent,config}){
        this._oTessefakt=tessefakt;
        this._oParent=parent;
        this._oConfig=config;
        this._display();
    }
    destructor(){
        delete this._oConfig;
        delete this._oParent;
        delete this._oTessefakt;
    }
    _display(){
    }
}