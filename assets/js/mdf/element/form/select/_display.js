var cTessefaktElementSelectDisplay=class extends cTessefaktElementFormDisplay{
	destructor(){
		super.destructor();
		this._oHandles.destructor();
		delete this._oHandles;
	}
	_display(){
		super._display();
		var oConfig={
			contents: [
				{
					name: "i",
					"control-role": "mark"
				}
			]
		};
		this._oHandles=new cTessefaktElementSelectHandles({mdf:this._oMdf,parent:this,config:oConfig});
	}
};
