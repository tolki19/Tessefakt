<?php
namespace tessefakt\handlers;
class _handler{
	protected $_oTessefakt;
	protected $_fStart;
	protected $_bSuccess=null;
	protected $_aException=[];
	protected $_aRecommendation=[];
	protected $_aData=[];
	public function _construct(\tessefakt\tessefakt $tessefakt){
		$this->_fStart=microtime(true);
		$this->_oTessefakt=$tessefakt;
	}
	public function reply(?int $status=200){
		if(headers_sent()&&$status<500) trigger_error('Output from other source',E_USER_ERROR);
		if($this->_bSuccess===null||$status<200||$status>=300) $this->_bSuccess=false;
		if($this->_oTessefakt->load){
			$aMetrics=$this->_oTessefakt->stats();
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
			'php-time'=>microtime(true)-$this->_fStart
		];
		switch($sMime){
			case 'application/json':
			case '*/*':
				http_response_code($status);
				header('Content-Type: application/json');
				echo json_encode([
						'success'=>!!$this->_bSuccess,
						'exception'=>$this->_aException,
						'recommendation'=>$this->_aRecommendation,
						'data'=>$this->_aData,
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
	public function _get(string $key){
		switch($key){
			case 'tessefakt': return $this->_oTessefakt;
			case 'exception': return !!count($this->_aException);
		}
	}
	public function _set(string $key,$value){
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
				$this->_aData=$value;
				return true;
		}
	}
}
