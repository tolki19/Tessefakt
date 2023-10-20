<?php
namespace tessefakt\handlers;
class _handler{
	protected $_oTessefakt;
	protected $_fStart;
	protected $_bSuccess=null;
	protected $_aException=[];
	protected $_aRecommendation=[];
	protected $_aData=[];
	public function __construct(\tessefakt\tessefakt $tessefakt){
		$this->_fStart=microtime(true);
		$this->_oTessefakt=$tessefakt;
	}
	public function handle():void{}
	public function reply(?int $status=200){
		restore_error_handler();
		restore_exception_handler();
		if(headers_sent()&&$status<500) trigger_error('Output from other source',E_USER_ERROR);
		if($this->_bSuccess===null||$status<200||$status>=300) $this->_bSuccess=false;
	}
	public function __get(string $key){
		switch($key){
			case 'exception': return !!count($this->_aException);
		}
	}
	public function __set(string $key,$value){
		switch($key){
			case 'success': 
				if(!is_bool($value)) trigger_error('Boolean needed',\E_USER_ERROR);
				$this->_bSuccess=$value;
				return true;
			case 'exception': 
				if(!is_array($value)) trigger_error('Array needed',\E_USER_ERROR);
				$this->_aException[]=$value;
				return true;
			case 'recommendation': 
				if(!is_string($value)) trigger_error('String needed',\E_USER_ERROR);
				$this->_aRecommendation[]=$value;
				return true;
			case 'data': 
				if(!is_array($value)) trigger_error('Array needed',\E_USER_ERROR);
				foreach($value as $mKey=>$mValue){
					$this->_aData[$mKey]=$mValue;
					// if(!isset($this->_aData[$mKey])) $this->_aData[$mKey]=[$mValue];
					// elseif $this->_aData[$mKey]=$mValue;
				}
				return true;
		}
	}
	public function __exception(\Throwable $oException):bool{
		return $this->__fault(
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
