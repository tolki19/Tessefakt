<?php
namespace tessefakt\handlers;
class _handler{
	protected $_oTessefakt;
	protected $_oEnvironment;
	protected $_oOperations;
	protected $_fStart;
	protected $_bSuccess=null;
	protected $_aException=[];
	protected $_aRecommendation=[];
	protected $_aData=[];
	public function __construct(\tessefakt $tessefakt){
		$this->_fStart=microtime(true);
		$this->_oTessefakt=$tessefakt;
		$this->_oEvironment=new \tessefakt\environment($this->_oTessefakt);
		$this->_oOperations=new \tessefakt\operations($this->_oTessefakt);
	}
	public function handle():void{
		set_error_handler([$this,'__error']);
		set_exception_handler([$this,'__exception']);
	}
	public function reply(?int $status=200):void{
		restore_error_handler();
		restore_exception_handler();
		if(headers_sent()&&$status<500) throw new \Exception('Output from other source');
		if($this->_bSuccess===null||$status<200||$status>=300) $this->_bSuccess=false;
		$this->_reply($status);
	}
	public function __get(string $key):mixed{
		switch($key){
			case 'env': return $this->_oEnvironment;
			case 'operations': return $this->_oOperations;
			case 'success': return $this->_bSuccess;
			case 'exception': return $this->_aException;
			case 'recommendation': return $this->_aRecommendation;
			case 'data': return $this->_aData;
		}
	}
	public function __set(string $key,$value):void{
		switch($key){
			case 'success': 
				if(!is_bool($value)) throw new \Exception('Boolean needed',\E_USER_ERROR);
				$this->_bSuccess=$value;
				break;
			case 'exception': 
				if(!is_array($value)) throw new \Exception('Array needed',\E_USER_ERROR);
				$this->_aException[]=$value;
				break;
			case 'recommendation': 
				if(!is_string($value)) throw new \Exception('String needed',\E_USER_ERROR);
				$this->_aRecommendation[]=$value;
				break;
			case 'data': 
				if(!is_array($value)) throw new \Exception('Array needed',\E_USER_ERROR);
				foreach($value as $mKey=>$mValue){
					$this->_aData[$mKey]=$mValue;
				}
				break;
		}
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
			array_slice(debug_backtrace(),1)
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
