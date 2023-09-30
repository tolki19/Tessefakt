var cTessefakt=class{
	_sUri;
	_oConfig;
	_oRender;
	_aRequests=[];
	_oCredentials={};
	_oLogin;
	_oRequests={};
	constructor({uri=''}){
		this._sUri=uri;
		this.request({
			root:this,
			get:{
				action:'bootstrap'
			},
			events:{
				load:this._loadBootstrap.bind(this),
				error:this._errorBootstrap.bind(this)
			}
		});
	}
	logout(){
		this.request({
			root:this,
			get:{
				action:'logout'
			},
			events:{
				load:this._loadLogout.bind(this),
				error:this._errorLogout.bind(this)
			}
		});
	}
	open({app,index,options}){
		var o={app,index};
		if(options){
			if(options.events) o.events=options.events;
			if(options.delivery) o.delivery=options.delivery;
			if(options.page) o.page=options.page;
		}
		return this._oRender.openPage(o);
	}
	close({page,autovalidate}){
		this._oRender.closePage({page,autovalidate});
	}
	panic({app,index,options}){
		var o={app,index};
		if(options){
			if(options.events) o.events=options.events;
			if(options.delivery) o.delivery=options.delivery;
		}
		return this._oRender.openDialog(o);
	}
	unpanic({dialog}){
		this._oRender.closeDialog({dialog});
	}
	refresh(){
		this._oRender.refresh();
	}
	request({root,get,post,water,events}){
		var oRequest=new cTessefaktRequest({tessefakt:this,root:root,uri:this._sUri,get:get,post:post,water:water,events:events,credentials:this._oCredentials});
		this._aRequests.push(oRequest);
		return oRequest;
	}
	_loadBootstrap(e){
		this._oConfig=e.target.responseJson.data.config;
		if(e.target.responseJson.data.config.settings.credentials!=undefined) this._oCredentials=e.target.responseJson.data.config.settings.credentials;
		this._oRender=new cTessefaktRender({tessefakt:this,config:this._oConfig});
		if(e.target.responseJson.recommendation.indexOf('login')!=-1){
			if((this._oCredentials?.uid??false)&&(this._oCredentials?.password??false)){
				this.request({
					root:this,
					get:{
						action:'login'
					},
					events:{
						load:this._loadLogin.bind(this),
						error:this._errorLogin.bind(this)
					}
				});
			}else{
				this._openLogin();
			}
		}
	}
	_errorBootstrap(e){
console.debug(false);
	}
	_commitLogin(e){
		this._oCredentials={
			uid:e.form['login-uid'],
			password:e.form['login-password']
		};
		this.request({
			root:this,
			get:{
				action:'login'
			},
			events:{
				load:this._loadLogin.bind(this),
				error:this._errorLogin.bind(this)
			}
		});
	}
	_loadLogin(e){
		if(this._oLogin){
			this.unpanic({dialog:this._oLogin});
			delete this._oLogin;
		}
		var o={delivery:{}};
		for(var i=0;i<(this._oConfig.settings.defaults.delivery??[]).length;++i){
			o.delivery[this._oConfig.settings.defaults.delivery[i].name]=this._oConfig.settings.defaults.delivery[i].value;
		}
		this.open({...this._oConfig.settings.defaults.key,options:o});
	}
	_openLogin(){
		this._oLogin=this.panic({
			app:'tessefakt',
			index:'login',
			options:{
				events:{
					send:this._commitLogin.bind(this)
				}
			}
		});
	}
	_errorLogin(e){
// console.debug(false);
		this._openLogin();
		// this._oLogin.describe([
			// {
				// type:'error',
				// message:'Ohoh.',
				// descs:['login-uid','login-password']
			// }
		// ]);
	}
	_loadLogout(e){
		delete this._oCredentials;
		this._oRender.destructor();
		this.request({
			root:this,
			get:{
				action:'bootstrap'
			},
			events:{
				load:this._loadBootstrap.bind(this),
				error:this._errorBootstrap.bind(this)
			}
		});
	}
	_errorLogout(e){
console.debug(false);
	}
	mscript({script,water}){
		switch(script.type){
			case 'rod':
				var r=water;
				for(var i=0;i<script.trace.length;++i) r=r[script.trace[i]];
				return r;
			case 'value':
				return script.value;
			case 'function':
				switch(script.function){
					case 'length': return this.mscript({script:script.array,water:water}).length;
				}
			case 'operation':
				switch(script.operator){
					case '>': return this.mscript({script:script.left,water:water})>this.mscript({script:script.right,water:water});
					case '>=': return this.mscript({script:script.left,water:water})>=this.mscript({script:script.right,water:water});
					case '==': return this.mscript({script:script.left,water:water})==this.mscript({script:script.right,water:water});
					case '!=': return this.mscript({script:script.left,water:water})!=this.mscript({script:script.right,water:water});
					case '<=': return this.mscript({script:script.left,water:water})<=this.mscript({script:script.right,water:water});
					case '<': return this.mscript({script:script.left,water:water})<this.mscript({script:script.right,water:water});
				}
		}
		throw new TypeError('Unknown mscript');
	}
	mscriptRods({script}){
		var r=[];
		if(script.type=='rod'){
			if((script.enum??true)===false) return false;
			return script;
		}
		for(var k in script) if(typeof script[k]=='object'){
				var v=this.mscriptRods({script:script[k]});
				if(v) r=r.concat(v);
			}
		return r.filter(function(v,k,r){
			l: for(var i=0;i<k;++i){
				if(v.length!=r[i].length) continue l;
				for(var j=0;j<v.length;++j) if(v[j]!=r[i][j]) continue l;
				return false;
			}
			return true;
		});
	}
};