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
		this._oHandles=new cTessefaktElementSelectHandles({tessefakt:this._oTessefakt,parent:this,config:oConfig});
	}
};
