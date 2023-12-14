<?php
namespace tessefakt;
class response{
	private $__oTessefakt;
	private $__fStart;
	private $__bSuccess=null;
	private $__aException=[];
	private $__aRecommendation=[];
	private $__aData=[];
	public function __construct(\tessefakt $tessefakt){
		$this->__fStart=microtime(true);
		$this->__oTessefakt=$tessefakt;
	}
	public function reply(?int $status=200){
		if(headers_sent()&&$status<500) trigger_error('Output from other source',E_USER_ERROR);
		if($this->__bSuccess===null||$status<200||$status>=300) $this->__bSuccess=false;
		if($this->__oTessefakt->load){
			$aMetrics=$this->__oTessefakt->stats();
			$iFlags=\JSON_THROW_ON_ERROR;
			if($this->tessefakt->config['settings']['dev']['state']) $iFlags|=\JSON_PRETTY_PRINT;
			\preg_match('#application\/json|\*\/\*#is',$this->tessefakt->request->header->Accept,$aMatches);
			$sMime=$aMatches[0];
		}else{
			$aMetrics=['db'=>['queries'=>0,'time'=>.0]];
			$iFlags=\JSON_THROW_ON_ERROR|\JSON_PRETTY_PRINT;
			$sMime='application/json';
		}
		$aMetrics=[
			'db-queries'=>$aMetrics['db']['queries'],
			'db-time'=>$aMetrics['db']['time'],
			'php-time'=>microtime(true)-$this->__fStart
		];
		switch($sMime){
			case 'application/json':
			case '*/*':
				http_response_code($status);
				header('Content-Type: application/json');
				echo json_encode([
						'success'=>!!$this->__bSuccess,
						'exception'=>$this->__aException,
						'recommendation'=>$this->__aRecommendation,
						'data'=>$this->__aData,
						'metrics'=>$aMetrics
					],$iFlags);
				break;
			default:
				trigger_error('Unable to respond in requested format ('.$this->tessefakt->request->header->Accept.')',\E_USER_ERROR);
				break;
		}
		restore_error_handler();
		restore_exception_handler();
		exit();
	}
	public function __get(string $key){
		switch($key){
			case 'tessefakt': return $this->__oTessefakt;
			case 'exception': return !!count($this->__aException);
		}
	}
	public function __set(string $key,$value){
		switch($key){
			case 'success': 
				if(!is_bool($value)) trigger_error('Boolean needed',\E_USER_ERROR);
				$this->__bSuccess=$value;
				return true;
			case 'exception': 
				if(!is_array($value)) trigger_error('Array needed',\E_USER_ERROR);
				$this->__aException[]=$value;
				return true;
			case 'recommendation': 
				if(!is_string($value)) trigger_error('String needed',\E_USER_ERROR);
				$this->__aRecommendation[]=$value;
				return true;
			case 'data': 
				if(!is_array($value)) trigger_error('Array needed',\E_USER_ERROR);
				$this->__aData=$value;
				return true;
		}
	}
}
