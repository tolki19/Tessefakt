<?php
namespace tessefakt;
class tessefakt{
	protected $_oApps;
	protected $_oRequest;
	protected $_oOperations;
	protected $_oHandler;
	protected $_aSetup;
	public function __construct(){
		http_response_code(500);
		spl_autoload_register([$this,'__autoload']);
		$this->_oApps=new \tessefakt\app_router($this);
		$this->_oRequest=new \tessefakt\request($this);
		$this->_oOperations=new \tessefakt\operations($this);
		$this->_aSetup=$this->_setup();
		$this->_oHandler=new ('\\tessefakt\\handlers\\'.$this->_mode())($this);
		$this->_oHandler->handle();
		set_error_handler([$this,'__error']);
		set_exception_handler([$this,'__exception']);
		if(isset($_GET['action'])&&$_GET['action']==='bootstrap'){
			$this->apps->tessefakt->controllers->system->bootstrap();
			$this->reply();
		}elseif(!$this->apps->tessefakt->controllers->system->auth()){
			$this->reply(401);
		}elseif(isset($_GET['action'])&&$_GET['action']==='login'){
			$this->apps->tessefakt->controllers->system->login();
			$this->reply();
		}elseif(isset($_GET['action'])&&$_GET['action']==='logout'){
			$this->apps->tessefakt->controllers->system->logout();
			$this->reply();
		}elseif(isset($_GET['app'])&&isset($_GET['controller'])&&isset($_GET['method'])){
			$this->apps->{$_GET['app']}->controllers->{$_GET['controller']}->{$_GET['method']}();
			reply();
		}
		throw new \Exception('No query received');
	}
	protected function _mode():string{
		if(isset($this->setup['settings']['mode'])){
			if(array_search($this->setup['settings']['mode'],['json','html','plain'])!==false) return $this->setup['settings']['mode'];
		}elseif(preg_match('#application/json|text/html#is',$this->request->server->HTTP_ACCEPT,$aMatches)){
			switch($aMatches[0]){
				case 'application/json': return 'json';
				case 'text/html': return 'html';
			}
		}
		throw new \Exception('Mode not recognized');
	}
	protected function _decodeJson(string $path):array{
		try{
			$aJson=json_decode(file_get_contents($path),true,512,\JSON_THROW_ON_ERROR);
		}catch(\JsonException $oException){
			throw new \Exception('Bad JSON code in "'.$path.'"',\E_USER_ERROR,$oException);
		}
		return $aJson;
	}
	protected function _setup():array{
		$aJsonSetup=$this->_decodeJson(dirname(__DIR__).'/.php/setup.json');
		$aJsonConfig=$this->_decodeJson(dirname(__DIR__).'/.config.json');
		$aConfig=array_merge_deep($aJsonSetup,$aJsonConfig);
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			$aJson=$this->_decodeJson(dirname(__DIR__).DIRECTORY_SEPARATOR.$aSetting['config']);
			$aConfig=array_merge_deep(['apps'=>[$sApp=>$aJson]],$aConfig);
		}
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			if(isset($aSetting['dbs'])) $aConfig['apps'][$sApp]['dbs']=$aSetting['dbs'];
			if(isset($aSetting['hash'])) $aConfig['apps'][$sApp]['hash']=$aSetting['hash'];
		}
		return $aConfig;
	}
	public function __get(string $key):mixed{
		switch($key){
			case 'setup': return $this->_aSetup;
			case 'apps': return $this->_oApps;
			case 'request': return $this->_oRequest;
			case 'operations': return $this->_oOperations;
			case 'hash': return $this->_bHash;
			case 'handler': return $this->_oHandler;
		}
	}
	public function __autoload(string $class):void{
		if(preg_match('#^tessefakt(?:\\\\\w+)+$#i',$class,$aMatches)){
			include_once(__DIR__.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,array_slice(explode('\\',$class),1)).'.php');
		}
	}
	public function stats(){
		return $this->_oApps->stats();
	}
}