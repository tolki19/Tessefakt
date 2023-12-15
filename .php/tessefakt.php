<?php
include('.php/helper.php');
class tessefakt{
	protected $_oApps;
	protected $_oRequest;
	protected $_oOperations;
	protected $_oHandler;
	protected $_aSetup;
	protected $_sMode;
	public function __construct(){
		http_response_code(500);
		spl_autoload_register([$this,'__autoload']);
		$this->_oApps=new \tessefakt\app_router($this);
		$this->_oRequest=new \tessefakt\request($this);
		$this->_oOperations=new \tessefakt\operations($this);
		$this->_aSetup=$this->_setup();
		$this->_sMode=$this->_mode();
		$this->_oHandler=new ('\\tessefakt\\handlers\\'.$this->_sMode)($this);
		$this->_oHandler->handle();
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
		$aJsonConfigPrototype=$this->_decodeJson(dirname(__DIR__).'/.php/config.prototype.json');
		$aJsonSetup=$this->_decodeJson(dirname(__DIR__).'/.setup.json');
		$aSetup=array_merge_deep($aJsonConfigPrototype,$aJsonSetup);
		foreach($aSetup['settings']['apps'] as $sApp=>$aSetting){
			$aJsonConfigApp=$this->_decodeJson(dirname(__DIR__).DIRECTORY_SEPARATOR.$aSetting['config']);
			$aSetup=array_merge_deep(['apps'=>[$sApp=>$aJsonConfigApp]],$aSetup);
		}
		foreach($aSetup['settings']['apps'] as $sApp=>$aSetting){
			if(isset($aSetting['db'])) $aSetup['apps'][$sApp]['db']=$aSetting['db'];
			if(isset($aSetting['hash'])) $aSetup['apps'][$sApp]['hash']=$aSetting['hash'];
		}
		return $aSetup;
	}
	public function __get(string $key):mixed{
		switch($key){
			case 'setup': return $this->_aSetup;
			case 'mode': return $this->_sMode;
			case 'apps': return $this->_oApps;
			case 'request': return $this->_oRequest;
			case 'operations': return $this->_oOperations;
			case 'hash': return $this->_bHash;
			case 'handler': return $this->_oHandler;
		}
		throw new \Exception('Access violation');
	}
	public function __autoload(string $class):void{
		$aParts=explode('\\',$class);
		if(preg_match('#^tessefakt\\\\apps\\\\\w+$#',$class)){
			$aPath=array_merge(array_slice($aParts,1,2),['.php'],array_slice($aParts,3),array_slice($aParts,-1));
			include_once(compilepath(__DIR__.'/../'.implode('/',$aPath).'.php'));
		}elseif(preg_match('#^tessefakt\\\\apps#',$class)){
			$aPath=array_merge(array_slice($aParts,1,2),['.php'],array_slice($aParts,3));
			include_once(compilepath(__DIR__.'/../'.implode('/',$aPath).'.php'));
		}elseif(preg_match('#^tessefakt#',$class)){
			$aPath=array_slice($aParts,1);
			include_once(compilepath(__DIR__.'/'.implode('/',$aPath).'.php'));
		}
	}
	public function stats(){
		return $this->_oApps->stats();
	}
}