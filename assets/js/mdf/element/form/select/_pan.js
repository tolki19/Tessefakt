var cMdfElementSelectPan=class extends cMdfElementFormPan{
	_display(){
		if(this._oConfig.search) this._oConfig.contents.unshift({
				name: "input",
				value: this._oConfig.search.field,
				events: {
					focus: this._focus.bind(this),
					blur: this._blur.bind(this),
					keydown: this._keydown.bind(this)
				}
			});
		super._display();
		this._dPan.addEvents({
			mouseenter:this._enter.bind(this),
			mouseleave:this._leave.bind(this)
		});
	}
	_enter(e){
		if(e.target!=this._dPan) return;
		this._oParent.addFlag('data-mdf-control-state','pan');
	}
	_leave(e){
		if(e.target!=this._dPan) return;
		this._oParent.removeFlag('data-mdf-control-state','pan');
	}
	_focus(e){
		this._oParent.addFlag('data-mdf-control-state','search');
	}
	_blur(e){
		this._oParent.removeFlag('data-mdf-control-state','search');
	}
	_keydown(e){
		if(this._oKeyTimer) clearTimeout(this._oKeyTimer);
		this._oKeyTimer=setTimeout(()=>e.target.dispatchEvent(new Event('change')),200);
	}
};
