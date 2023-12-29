<?php
namespace tessefakt;
class handler{
	protected $_fStart;
	protected $_oTessefakt;
	protected $_oApps;
	public function __construct(\tessefakt $tessefakt){
		$this->_fStart=microtime(true);
		$this->_oTessefakt=$tessefakt;
	}
	public function handle():void{
		set_error_handler([$this,'__error']);
		set_exception_handler([$this,'__exception']);
		$this->_handle();
	}
	public function reply(?int $status=200):void{
		restore_error_handler();
		restore_exception_handler();
		$this->_reply($status);
	}
	public function stats(){
		return $this->_oApps->stats();
	}
	public function __get(string $key):mixed{
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'apps':
				if(!$this->_oApps) $this->_oApps=new \tessefakt\app_router($this->_oTessefakt,$this);
				return $this->_oApps;
			case 'setup': return $this->_oTessefakt->setup;
		}
		throw new \Exception('Unknown key');
	}
	public function __exception(\Throwable $oException):bool{
		return $this->_fault(
			-1,
			$oException->getMessage(),
			$oException->getFile(),
			$oException->getLine(),
			$oException->getTrace(),
			$oException->getPrevious()?->getMessage()
		);
	}
	public function __error($errno,$errstr,$errfile,$errline):bool{
		if(!(error_reporting()&$errno)) return false;
		$errstr=htmlspecialchars($errstr);
		return $this->_fault(
			$errno,
			$errstr,
			$errfile,
			$errline,
			array_slice(debug_backtrace(0),1)
		);
	}
	protected function _fault($code,$message,$file,$line,$trace,$previous_message=null):bool{
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
		$this->exception=[
			'title'=>$sTitle,
			'message'=>$message.' in '.$file.' on line '.$line.($previous_message?' (Previous: '.$previous_message.')':''),
			'trace'=>$trace,
			'php'=>phpversion()
		];
		if($code&error_reporting()) $this->reply(500);
		return true;
	}
}
