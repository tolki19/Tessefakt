var cTessefaktRequest=class{
	_oTessefakt;
	_oRoot;
	_oEvents;
	_sUri;
	_sUrl;
	_oFlags;
	_oFormData;
	_sGetData;
	_oCredentials;
	_oXhr;
	_aXhrs=[];
	constructor({tessefakt,root,water,events,uri='',url='ajax.php',flags,get,post,credentials={}}){
		this._oTessefakt=tessefakt;
		this._oRoot=root;
		this._sUri=uri;
		this._sUrl=url;
		this._oEvents=(events??{});
		this._oFlags=(flags??{});
		var aGetData=[];
		for(var sKey in (get??{})) aGetData.push(sKey+'='+encodeURIComponent(get[sKey]));
		this._sGetData=(aGetData.length?'?':'')+aGetData.join('&');
		this._oFormData=new FormData();
		this._compileFormData({source:post,target:this._oFormData});
		this._oCredentials=credentials;
		this._send();
	}
	_send(){
		this._oXhr=new XMLHttpRequest();
		this._oXhr.open('post',this._sUri+this._sUrl+this._sGetData,true);
		this._oXhr.addEventListener('load',this._load.bind(this));
		this._oXhr.addEventListener('error',this._error.bind(this));
		this._oXhr.addEventListener('abort',this._abort.bind(this));
		this._oXhr.addEventListener('timeout',this._timeout.bind(this));
		this._oXhr.addEventListener('progress',this._progress.bind(this));
		this._oXhr.timeout=2000;
		this._oXhr.setRequestHeader('Accept','application/json');
		if((this._oCredentials?.uid??false)&&(this._oCredentials.password??false)) this._oXhr.setRequestHeader('Authorization','Basic:'+btoa(this._oCredentials.uid+':'+this._oCredentials.password));
		this._oXhr.send(this._oFormData);
		this._aXhrs.push(this._oXhr);
	}
	_compileFormData({target,source,name}){
		for(var sKey in (source??{})){
			var cycle_name=name?(name+'['+sKey+']'):sKey;
			if(source[sKey] instanceof Object){
				this._compileFormData({name:cycle_name,source:source[sKey],target:target});
			}else switch(typeof(source[sKey])){
					case 'object': target.append(cycle_name,'(object)'+source[sKey]); break;
					case 'boolean': target.append(cycle_name,'(bool)'+source[sKey]); break;
					case 'number': target.append(cycle_name,'(number)'+source[sKey]); break;
					case 'bigint': target.append(cycle_name,'(bigint)'+source[sKey]); break;
					case 'string': target.append(cycle_name,'(string)'+source[sKey]); break;
				}
		}
	}
	abort(){
		this._oXhr.abort();
	}
	pending(){
		return this._oXhr.readyState<4;
	}
	_load(e){
		switch(e.target.status){
			case 200:
				e.target.responseJson=JSON.parse(e.target.response);
				if(this._oEvents.load!=undefined) this._oEvents.load(e);
				break;
			default:
				if(this._oEvents.error!=undefined) this._oEvents.error(e);
				break;
		}
	}
	_error(e){
		console.debug(e);
		if(this._oEvents.error!=undefined) this._oEvents.error(e);
	}
	_abort(e){
		if(this._oEvents.abort!=undefined) this._oEvents.abort(e);
	}
	_timeout(e){
		if(this._oEvents.timeout!=undefined) this._oEvents.timeout(e);
		else this._send();
	}
	_progress(e){
		if(this._oEvents.progress!=undefined) this._oEvents.progress(e);
	}
};
