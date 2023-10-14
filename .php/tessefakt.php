<?php
namespace tessefakt;
class tessefakt{
	private $__oApps;
	private $__oRequest;
	private $__oOperations;
	private $__oResponse;
	private $__aConfig;
	public function __construct(){
		http_response_code(500);
		spl_autoload_register([$this,'__autoload']);
		$this->__oApps=new \tessefakt\app_router($this);
		$this->__oRequest=new \tessefakt\request($this);
		$this->__oOperations=new \tessefakt\operations($this);
		$this->__oResponse=new \tessefakt\response($this);
		set_error_handler([$this,'__error']);
		set_exception_handler([$this,'__exception']);
		$this->__aConfig=$this->__setup();
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
	private function __decodeJson(string $path){
		try{
			$aJson=json_decode(file_get_contents($path),true,512,\JSON_THROW_ON_ERROR);
		}catch(\JsonException $oException){
			throw new \Exception('Bad JSON code in "'.$path.'"',\E_USER_ERROR,$oException);
		}
		return $aJson;
	}
	private function __setup(){
		$aJsonSetup=$this->__decodeJson(dirname(__DIR__).'/.php/setup.json');
		$aJsonConfig=$this->__decodeJson(dirname(__DIR__).'/.config.json');
		$aConfig=array_merge_deep($aJsonSetup,$aJsonConfig);
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			$aJson=$this->__decodeJson(dirname(__DIR__).DIRECTORY_SEPARATOR.$aSetting['config']);
			$aConfig=array_merge_deep(['apps'=>[$sApp=>$aJson]],$aConfig);
		}
		foreach($aConfig['settings']['apps'] as $sApp=>$aSetting){
			if(isset($aSetting['dbs'])) $aConfig['apps'][$sApp]['dbs']=$aSetting['dbs'];
			if(isset($aSetting['hash'])) $aConfig['apps'][$sApp]['hash']=$aSetting['hash'];
		}
		return $aConfig;
	}
	public function __get(string $key){
		switch($key){
			case 'config': return $this->__aConfig;
			case 'apps': return $this->__oApps;
			case 'request': return $this->__oRequest;
			case 'operations': return $this->__oOperations;
			case 'response': return $this->__oResponse;
			case 'hash': return $this->__bHash;
		}
	}
	public function __set(string $key,$value){}
	public function __call(string $key,array $args){
		switch($key){
			case 'reply': return call_user_func([$this->__oResponse,$key],...$args);
		}
	}
	public function __autoload($class){
		if(preg_match('#^tessefakt(?:\\\\\w+)+$#i',$class,$aMatches)){
			include_once(__DIR__.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,array_slice(explode('\\',$class),1)).'.php');
		}
	}
	public function __exception($oException){
		return $this->__fault(-1,$oException->getMessage(),$oException->getFile(),$oException->getLine(),$oException->getTrace(),$oException->getPrevious()?->getMessage());
	}
	public function __error($errno,$errstr,$errfile,$errline){
		if(!(error_reporting()&$errno)) return false;
		$errstr=htmlspecialchars($errstr);
		return $this->__fault($errno,$errstr,$errfile,$errline,array_slice(debug_backtrace(),1));
	}
	protected function __fault($code,$message,$file,$line,$trace,$previous_message=null){
		switch($code){
			case -1: $sTitle='Exception'; break;
			case \E_ERROR: case \E_CORE_ERROR: case \E_COMPILE_ERROR: case \E_USER_ERROR: $sTitle='Fatal Error'; break;
			case \E_PARSE: $sTitle='Parse Error'; break;
			case \E_WARNING: case \E_CORE_WARNING: case \E_COMPILE_WARNING: case \E_USER_WARNING: $sTitle='Warning'; break;
			case \E_NOTICE: case \E_USER_NOTICE: $sTitle='Notice'; break;
			case \E_STRICT: $sTitle='Strict';
			case \E_RECOVERABLE_ERROR: $sTitle='Recoverable';
			case \E_DEPRECATED: CASE \E_USER_DEPRECATED: $sTitle='Deprecated';
			case \E_ALL: $sTitle='General';
			default: $sTitle='Unknown error ('.$code.')'; break;
		}
		$this->response->exception=[
			'title'=>$sTitle,
			'message'=>$message.' in '.$file.' on line '.$line.($previous_message?' (Previous: '.$previous_message.')':''),
			'trace'=>$trace,
			'php'=>phpversion()
		];
		if($code&error_reporting()) $this->reply(500);
		return true;
	}
	public function stats(){
		return $this->__oApps->stats();
	}
}